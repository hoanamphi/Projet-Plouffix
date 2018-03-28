$(document).ready(function() {

    function inputFormatisation(num) {
        var reGex = /^(\d?(,|\.))?(\d{6,41})$/;
        if (reGex.exec(num)) {
            num = num.replace(/0?(\.|,)/,'');
            return num;
        } else {
           throw "Invalid entry";
        }
    }

    $(".formNum > form").submit(function (event) {
        event.preventDefault();
        try {
            var num = inputFormatisation($(this).children(".search").val());
        } catch (error) {
            $.flash(error, "failure");
            return;
        }

        $.ajax({
            type: "GET",
            url: "Look/"+num,
            dataType: "json"
        }).done(function(jsonData) {
            if(jsonData['error']) {
                $.flash(jsonData['error']['msg'], "failure");
                return;
            }
            makeArray(jsonData, 20);
            drawArray("body > .container");
        }).fail(function (err) {
            $.flash(err, "failure");
            return;
        });

    });

    $(document).ajaxStart(function() {
        $(".loader").addClass("loading");
        div = document.createElement("div");
        div.className = "cover";
        $("body").prepend(div);
    });

    $(document).ajaxStop(function() {
        $(".loader").removeClass("loading");
        $(".cover").remove();
    });

});