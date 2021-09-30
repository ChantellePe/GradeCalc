<?php

ini_set('display_errors', TRUE);
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

global $finalMark;
global $grade;
global $finalString;

global $error;
global $grade;
$error = null;
calculate();



function validate()
{
    global $error;
    $error = null;
    if (!isset($_POST)) {
        $error = null;
        return false;
    } else if (empty($_POST["quizzes"]) || empty($_POST["assignment1"]) || empty($_POST["assignment2"]) || empty($_POST["assignment3"]) || empty($_POST["exam"])) {
        $error = "Please enter a value in every field";
        return false;
    } else if (((int)($_POST["quizzes"]) > 60 || !is_numeric(($_POST["quizzes"])) || ((int)($_POST["quizzes"])) < 0)){
        $error = "Please enter a valid quiz mark";
        return false;
    } else if (((int)($_POST["assignment1"]) > 100 || !is_numeric(($_POST["assignment1"])) || ((int)($_POST["assignment1"])) < 0)) {
        $error = "Please enter a valid assignment 1 mark";
        return false;
    } else if (((int)($_POST["assignment2"]) > 100 || !is_numeric(($_POST["assignment2"])) || ((int)($_POST["assignment2"])) < 0)) {
        $error = "Please enter a valid assignment 1 mark";
        return false;
    } else {
        return true;

    }
}


function calculate() {
    global $finalMark;
    if (validate()) {
        if (!isset($_POST)) {
            $finalMark = null;
        } else if (!empty($_POST)) {
            $quizzes = $_POST["quizzes"];
            $ass1 = $_POST["assignment1"];
            $ass2 = $_POST["assignment2"];
            $ass3 = $_POST["assignment3"];
            $exam = $_POST["exam"];
            $quizScaled = ((int)$quizzes / 60) * 10;
            $ass1Scaled = ((int)$ass1 / 100) * 10;
            $ass2Scaled = ((int)$ass2 / 100) * 15;
            $ass3Scaled = ((int)$ass3 / 100) * 15;
            $examScaled = ((int)$exam / 100) * 50;
            $finalMark = $quizScaled + $ass1Scaled + $ass2Scaled + $ass3Scaled + $examScaled;
            $finalMark = number_format($finalMark, 1);
            global $finalString;
            $finalString ="Your final mark is ". $finalMark;
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
        print(json_encode($finalMark));
        print(json_encode($grade));
    }
}
