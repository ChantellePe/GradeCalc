<?php

ini_set('display_errors', TRUE);
//header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

global $finalMark;
global $grade;
global $finalString;
global $grade;
validate();



function validate() {
    $error = array();
    if (!isset($_GET)) {
        $error["error"] = "Method must be GET";
    }
    if (empty($_GET["quizzes"]) || empty($_GET["assignment1"]) || empty($_GET["assignment2"]) || empty($_GET["assignment3"]) || empty($_GET["exam"])) {
        $error[]= "Please enter a value in every field";
    }
    if (((int)($_GET["quizzes"]) > 60 || !is_numeric(($_GET["quizzes"])) || ((int)($_GET["quizzes"])) < 0)){
        $error[] ="Please enter a valid quiz mark";
    }
    if (((int)($_GET["assignment1"]) > 100 || !is_numeric(($_GET["assignment1"])) || ((int)($_GET["assignment1"])) < 0)) {
        $error[] = "Please enter a valid assignment 1 mark";
    }
    if (((int)($_GET["assignment2"]) > 100 || !is_numeric(($_GET["assignment2"])) || ((int)($_GET["assignment2"])) < 0)) {
        $error[] =  "Please enter a valid assignment 2 mark";
    }
    if (((int)($_GET["assignment3"]) > 100 || !is_numeric(($_GET["assignment3"])) || ((int)($_GET["assignment3"])) < 0)) {
        $error[] =  "Please enter a valid assignment 3 mark";
    }
    if (((int)($_GET["exam"]) > 100 || !is_numeric(($_GET["exam"])) || ((int)($_GET["exam"])) < 0)) {
        $error[] =  "Please enter a valid exam mark";
    }
    if (count($error) != 0) {
        print(json_encode($error));
    } else {
        calculate();
    }
}



function calculate() {
    global $finalMark;
        if (!isset($_GET)) {
            $finalMark = null;
        } else if (!empty($_GET)) {
            $quizzes = $_GET["quizzes"];
            $ass1 = $_GET["assignment1"];
            $ass2 = $_GET["assignment2"];
            $ass3 = $_GET["assignment3"];
            $exam = $_GET["exam"];
            $quizScaled = ((int)$quizzes / 60) * 10;
            $ass1Scaled = ((int)$ass1 / 100) * 10;
            $ass2Scaled = ((int)$ass2 / 100) * 15;
            $ass3Scaled = ((int)$ass3 / 100) * 15;
            $examScaled = ((int)$exam / 100) * 50;
            $finalMark = $quizScaled + $ass1Scaled + $ass2Scaled + $ass3Scaled + $examScaled;
            $finalMark = number_format($finalMark, 1);
            global $finalString;
            $finalString = "Your final mark is " . $finalMark."%";
            global $grade;
            if ($finalMark >= 85) {
                $grade = "You have achieved a High Distinction";
            } else if ($finalMark >= 75) {
                $grade = "You have achieved a Distinction";
            } else if ($finalMark >= 65) {
                $grade = " You have achieved a Credit";
            } else if ($finalMark >= 50) {
                $grade = "You have achieved a Pass";
            } else {
                $grade = "Sorry you Failed";

            }

        }

    $data = array("mark" => $finalMark, "grade" => $grade);
    print(json_encode($data));
}
