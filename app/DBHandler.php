<?php
/**
 * Created by PhpStorm.
 * User: Kai
 * Date: 2/04/18
 * Time: 5:23 PM
 */

namespace App;
use App\Http\Classes;
use App\Http\Assignment;
use App\Http\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Calculations;

class DBHandler
{
    public static function insertClass(Request $request)
    {
        $newClass = new Classes();
        $newClass->name = $request->className;
        $newClass->target_grade = $request->classTargetGrade;
        $newClass->actual_grade = 0;
        $newClass->save();

        return $newClass->id;
    }
    public static function insertSections(Request $request, $id)
    {
        if($request->sectionName != null && $request->sectionWeight != null)
        {
            $newSection = new Section();
            $newSection->name = $request->sectionName;
            $newSection->section_weight = $request->sectionWeight;
            $newSection->current_progress = 0;
            $newSection->classes_id = $id;
            $newSection->save();

            return $newSection->id;
        }
        return 0;

    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public static function insertAssignment(Request $request, $id)
    {
        $newAssignment = new Assignment();
        $calculations = new Calculations();

        // set variables for assignment
        $max = $request->maxScore;
        $achieved = $request->achievedScore;
        $grade = $calculations->calculateGrade($max, $achieved);

        // create new assignment
        $newAssignment->name = $request->assignmentName;
        $newAssignment->max_score = $max;
        $newAssignment->achieved_score = $achieved;
        $newAssignment->section_id = $id;
        $newAssignment->grade = $grade;
        $newAssignment->assignment_weight = 0;
        $newAssignment->weighted_grade = 0;
        $newAssignment->save();


        // update the every assignment with new weighted grades
        $returnID = self::updateAssignmentsWeights($id);

        return $returnID;
    }
    public static function getAllGoals()
    {
        $class = Classes::all();
        return $class;
    }
    public static function getSectionsByGoalID($class_id)
    {
        $class = Classes::find($class_id);
        $sections = $class->sections;

        return $sections;
    }
    public static function getAssignmentsBySectionID($section_id)
    {
        $section = Section::find($section_id);
        $assignments = $section->assignments;
        return $assignments;
    }
    public static function updateClass($class)
    {
        $classToUpdate = Classes::find($class->id);

        $classToUpdate->name = $class->className;
        $classToUpdate->target_grade = $class->classTargetGrade;

        $classToUpdate->save();
    }
    public static function updateAssignment($assignment)
    {
        $calculations = new Calculations();

        $updateAssignment = Assignment::find($assignment->id);
        $name = $assignment->assignmentName;
        $max = $assignment->maxScore;
        $achieved = $assignment->achievedScore;
        $weight = $updateAssignment->assignment_weight;
        $grade = $calculations->calculateGrade($max, $achieved);
        $weightedGrade = $calculations->calculateWeightedGrade($grade, $weight);

        $section = Section::find($updateAssignment->section_id);
        $sectionProgress = $section->current_progress;
        $sectionProgress = $sectionProgress - $updateAssignment->weighted_grade + $weightedGrade;
        $classID = $section->classes_id;

        $class = Classes::find($classID);
        $classActual = $class->actual_grade;
        $classActual = $classActual - $section->current_progress + $sectionProgress;

        $updateAssignment->name = $name;
        $updateAssignment->max_score = $max;
        $updateAssignment->achieved_score = $achieved;
        $updateAssignment->grade = $grade;
        $updateAssignment->weighted_grade = $weightedGrade;
        $section->current_progress = $sectionProgress;
        $class->actual_grade = $classActual;

        $updateAssignment->save();
        $section->save();
        $class->save();

        return $classID;
    }
    public static function updateAssignmentsWeights($section_id)
    {
        $section = Section::find($section_id);
        $assignments = $section->assignments;
        $totalAssignments = $assignments->count();
        $tallyWeightedGrades = 0;

        if($totalAssignments != 0)
        {
            $sectionWeight = $section->section_weight;
            $assignmentWeight = $sectionWeight / $totalAssignments;

            foreach($assignments as $assignment)
            {
                $grade = $assignment->grade;
                $weightedGrade = Calculations::calculateWeightedGrade($grade, $assignmentWeight);
                $tallyWeightedGrades = $tallyWeightedGrades + $weightedGrade;

                $assignment->assignment_weight = $assignmentWeight;
                $assignment->weighted_grade = $weightedGrade;
                $assignment->save();
            }
        }

        $class = Classes::find($section->classes_id);
        $classActual = $class->actual_grade;
        $classActual -= $section->current_progress;

        $section->current_progress = $tallyWeightedGrades;
        $section->save();

        // logic failure on deletion of an assignment with only 1 section
        $classActual += $tallyWeightedGrades;
        $class->actual_grade = $classActual;
        $class->save();

        return $section->classes_id;
    }
    public static function deleteClassByID($goal_id)
    {
        $goal = Classes::find($goal_id);
        $goal->delete();
    }
    public static function deleteAssignmentByID($assignment_id)
    {
        $assignment = Assignment::find($assignment_id);
        $assignment->delete();

        // update the weight values and weighted grade values of assignments
        self::updateAssignmentsWeights($assignment->section_id);
    }
    public static function deleteSectionByID($section_id)
    {
        $section = Section::find($section_id);
        $class = Classes::find($section->classes_id);
        $class->actual_grade -= $section->current_progress;

        $section->delete();
        $class->save();

        return $class->id;
    }
}