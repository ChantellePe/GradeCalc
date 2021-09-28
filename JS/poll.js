window.onload = function() {
    $("#pollButton").on("click", submit_poll);
};


    function submit_poll(e) {
        e.preventDefault();
        const $vote = $('form input[type=radio]:checked').val();
        console.log($vote);
        let button = $("#pollButton");
        console.log($vote);
        $.ajax({
            url: "http://localhost/GradeCalculator%20Final/recordPoll.php",
            method: 'POST',
            data: {"poll": $vote},
            success: function (data) {
                console.log("worked"+ data);
                $("#thanks").removeClass("hidden");
                $("#poll>legend").addClass("hidden");
                button.removeClass("button");
                button.addClass("hidden");
                $("h3:not(#thanks)").addClass("hidden");
                $("#poll>fieldset").addClass("hidden");
            },
            error: function (jsXHR) {
                let $e = JSON.parse(jsXHR.responseText);
                console.log("Status code: " + $e.error);
                console.log("Error message: " + $e.message);
            }
        });
    }
