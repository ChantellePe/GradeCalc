$(function() {
    $("#calcGrades").on("click", validate);
    $("#grades input[type=reset]").on("click", resetPage);
    $("input").on("click", removeError)
});

function validate(e){
    e.preventDefault();
    let quizMark = $("#quizzes").val();
    let ass1 = $("input[name=assignment1]").val();
    let ass2 = $("input[name=assignment2]").val();
    let ass3 = $("input[name=assignment3]").val();
    let exam = $("input[name=exam]").val();

    if (isNaN(quizMark) || quizMark === null || quizMark === "") {
        addError("You must enter a number in quizzes");
    } else if (quizMark > 60) {
        addError("Quiz score must be under 60");
    } else if (isNaN(ass1) || ass1 === null || ass1 === "") {
        addError("You must enter a number in Assignment 1");
    } else if (ass1 > 100) {
        addError("Assignment 1 grade is out of 100");
    } else if (isNaN(ass2) || ass2 === null || ass2 === "") {
        addError("You must enter a number in Assignment 2");
    } else if (ass2 > 100) {
        addError("Assignment 2 grade is out of 100");
    } else if (isNaN(ass3) || ass3 === null || ass3 === "") {
        addError("You must enter a number in Assignment 3");
    } else if (ass3 > 100) {
        addError("Assignment 3 grade is out of 100");
    } else if (isNaN(exam) || exam == null || exam === "") {
        addError("You must enter a number in Exam");
    } else if (exam > 100) {
        addError("Exam grade is out of 100");
    } else {
       // removeError();
       displayFinalGrades();
    }
}

function addError(message){
    e.preventDefault();
    $("#error").html(message);

}

function removeError(e){
    e.preventDefault();
    $("#error").html("");
}

function displayFinalGrades() {
    let quizMark = $("#quizzes").val();
    let ass1 = $("input[name=assignment1]").val();
    let ass2 = $("input[name=assignment2]").val();
    let ass3 = $("input[name=assignment3]").val();
    let exam = $("input[name=exam]").val();
    let form = {"quizzes": quizMark, "assignment1": ass1, "assignment2": ass2, "assignment3": ass3, "exam": exam}
    $.get("http://localhost/GradeCalculatorFinal/PHP/calculate.php", form, function(data) {
            let newData = JSON.parse(data)
            console.log(newData);
            $("#resultMark").html("Your final mark is " + newData["mark"])
            $("#resultGrade").html(newData["grade"])
            $("#description").slideUp(400);
            if (newData["grade"] === "You have achieved a High Distinction") {
                setInterval(setInterval(() => {
                    let $omg1 = $("#omg1");
                    let $omg2 = $("#omg2");
                    $omg2.removeClass("hidden");
                    $omg1.removeClass("hidden");
                    $("#poll").css("display", "none")
                    $omg1.fadeIn();
                    $omg1.fadeOut();
                    $omg2.fadeIn();
                    $omg2.fadeOut();
                }, 750));

            }
        });

}
function resetPage() {
    location.reload();
}

