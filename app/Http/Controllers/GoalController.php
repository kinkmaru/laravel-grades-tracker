<?php

namespace App\Http\Controllers;

use App\DBHandler;
use Illuminate\Support\Facades\Validator;;
use App\ValidationMessages;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class GoalController extends BaseController
{
    public function __construct()
    {
    }
    public function getAllClasses()
    {
        $classes = DBHandler::getAllGoals();
        $results = [];
        foreach($classes as $class)
        {
            $results[$class->id] = $class;
        }

        return response()->json($results);
    }
    public function createNewClass(Request $request)
    {
        if($request->isMethod('post'))
        {
            $messages = ValidationMessages::createNewClass();

            $validator = Validator::make($request->all(),[
                'className' => 'required|max:50',
                'classTargetGrade' => 'required|numeric|min:0|max:100'
            ], $messages);
            if($validator->fails())
            {
                return response()->json($validator->messages());
            }
            else
            {
                DBHandler::insertClass($request);
                return 'OK';
            }
        }
    }
    public function createNewSection(Request $request, $id)
    {
        if($request->isMethod('post'))
        {
            $messages = ValidationMessages::createNewSection();

            $validator = Validator::make($request->all(),[
                'sectionName' => 'required|max:50',
                'sectionWeight' => 'required|numeric|min:0|max:100'
            ], $messages);
            if($validator->fails())
            {
                return response()->json($validator->messages());
            }
            else
            {
                DBHandler::insertSections($request, $id);
                return 'OK';
            }
        }
    }
    public function createNewAssignment(Request $request, $id)
    {
        if($request->isMethod('post'))
        {
            $messages = ValidationMessages::createNewAssignment();

            $validator = Validator::make($request->all(),[
                'assignmentName' => 'required|max:50',
                'sectionID' => 'required',
                'maxScore' => 'required|numeric|min:0|max:100',
                'achievedScore' => 'required|numeric|min:0|max:100'
            ], $messages);

            if($validator->fails())
            {
                return response()->json($validator->messages());
            }
            else
            {
                DBHandler::insertAssignment($request, $id);
                return 'OK';
            }
        }
    }
    public function updateClass(Request $request, $id)
    {
        if($request->isMethod('patch'))
        {
            $messages = ValidationMessages::updateClass();

            $validator = Validator::make($request->all(),[
                'className' => 'required|max:50',
                'classTargetGrade' => 'required|numeric|min:0|max:100'
            ], $messages);

            if($validator->fails())
            {
                return response()->json($validator->messages());
            }
            else
            {
                DBHandler::updateClass($request, $id);
                return 'OK';
            }
        }
    }
    public function updateAssignment(Request $request)
    {
        if($request->isMethod('patch'))
        {
            $messages = ValidationMessages::updateAssignment();

            $validator = Validator::make($request->all(),[
                'assignmentName' => 'required|max:50',
                'maxScore' => 'required|numeric|min:0|max:100',
                'achievedScore' => 'required|numeric|min:0|max:100'
            ], $messages);

            if($validator->fails())
            {
                return response()->json($validator->messages());
            }
            else
            {
                DBHandler::updateAssignment($request);
                return 'OK';
            }
        }
    }
    public function getDetailsByID($id)
    {
        $sections = DBHandler::getSectionsByGoalID($id);
        $results = [];
        foreach($sections as $section)
        {
            $assignments = DBHandler::getAssignmentsBySectionID($section->id);

            $results[$section->id]['assignment'] = $assignments;
            $results[$section->id]['section'] = $section;
        }

        return response()->json($results);
    }
    public function deleteClass($id)
    {
        DBHandler::deleteClassByID($id);

        return  DBHandler::getAllGoals();
    }
    public function deleteAssignment($id)
    {
        DBHandler::deleteAssignmentByID($id);
    }
    public function deleteSection($id)
    {
        $classID = DBHandler::deleteSectionByID($id);
        return self::getDetailsByID($classID);
    }
}