<?php
/**
 * Created by PhpStorm.
 * User: lauren
 * Date: 8/7/18
 * Time: 3:42 PM
 */

namespace App;


class ValidationMessages
{
    public static function createNewClass()
    {
        return [
            'className.required' => 'Class name is required.',
            'className.max' => 'Class name cannot be longer than 50 characters.',
            'classTargetGrade.required' => 'Target grade is required.',
            'classTargetGrade.numeric' => 'Target grade must be a number from 0 to 100.',
            'classTargetGrade.min' => 'Target grade must be a number from 0 to 100.',
            'classTargetGrade.max' => 'Target grade must be a number from 0 to 100.',
        ];
    }
    public static function createNewSection()
    {
        return [
            'sectionName.required' => 'Section name is required.',
            'sectionName.max' => 'Section name cannot be longer than 50 characters.',
            'sectionWeight.required' => 'Section weight is required.',
            'sectionWeight.numeric' => 'Section weight must be a number from 0 to 100.',
            'sectionWeight.min' => 'Section weight must be a number from 0 to 100.',
            'sectionWeight.max' => 'Section weight must be a number from 0 to 100.',
        ];
    }
    public static function createNewAssignment()
    {
        return [
            'assignmentName.required' => 'Assignment name is required.',
            'assignmentName.max' => 'Assignment name cannot be longer than 50 characters.',
            'sectionID.required' => 'Section is required',
            'maxScore.required' => 'Max score is required.',
            'maxScore.numeric' => 'Max score must be a number from 0 to 100.',
            'maxScore.min' => 'Max score must be a number from 0 to 100.',
            'maxScore.max' => 'Max score must be a number from 0 to 100.',
            'achievedScore.required' => 'Achieved score is required.',
            'achievedScore.numeric' => 'Achieved score must be a number from 0 to 100.',
            'achievedScore.min' => 'Achieved score must be a number from 0 to 100.',
            'achievedScore.max' => 'Achieved score must be a number from 0 to 100.',
        ];
    }
    public static function updateClass()
    {
        return [
            'className.required' => 'Class name is required.',
            'className.max' => 'Class name cannot be longer than 50 characters.',
            'classTargetGrade.required' => 'Target grade is required.',
            'classTargetGrade.numeric' => 'Target grade must be a number from 0 to 100.',
            'classTargetGrade.min' => 'Target grade must be a number from 0 to 100.',
            'classTargetGrade.max' => 'Target grade must be a number from 0 to 100.',
        ];
    }
    public static function updateAssignment()
    {
        return [
            'assignmentName.required' => 'Assignment name is required.',
            'assignmentName.max' => 'Assignment name cannot be longer than 50 characters.',
            'maxScore.required' => 'Max score is required.',
            'maxScore.numeric' => 'Max score must be a number from 0 to 100.',
            'maxScore.min' => 'Max score must be a number from 0 to 100.',
            'maxScore.max' => 'Max score must be a number from 0 to 100.',
            'achievedScore.required' => 'Achieved score is required.',
            'achievedScore.numeric' => 'Achieved score must be a number from 0 to 100.',
            'achievedScore.min' => 'Achieved score must be a number from 0 to 100.',
            'achievedScore.max' => 'Achieved score must be a number from 0 to 100.',
        ];
    }
}