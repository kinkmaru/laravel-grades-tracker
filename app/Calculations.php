<?php
/**
 * Created by PhpStorm.
 * User: Kai
 * Date: 2/17/18
 * Time: 10:01 PM
 */

namespace App\Http;


class Calculations
{
    public static function calcSectionActual($total, $actual, $evaluation)
    {
        $totalSum = 0;
        $actualSum = 0;
        $eval = $evaluation[0];
        
        foreach($total as $value)
        {
            $totalSum = $totalSum + $value;
        }
        foreach($actual as $value)
        {
            $actualSum = $actualSum + $value;
        }

        if($totalSum <= 0)
            $result = 0;
        else
            $result = round(($totalSum / $actualSum) * $eval,2);

        return $result;
    }
    public static function calculateGrade($maxScore, $achievedScore)
    {
        $result = ($achievedScore / $maxScore) * 100;
        return round($result, 2);
    }
    public static function calculateWeightedGrade($grade, $assignmentWeight)
    {
        $result = (($grade / 100) * $assignmentWeight);
        return round($result, 2);
    }
}