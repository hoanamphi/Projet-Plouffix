$(document).ready(function() {

    function inputFormatisation(event, num) {
        var reGex = /^(\d?(,|\.))?(\d{6,41})$/;
        if (reGex.exec(num)) {
            num = num.replace(/0?(\.|,)/,'');
            return num
        } else {
           throw "Entrée non valide";
        }
    }

    $(".formNum > form").submit(function (event) {
        event.preventDefault();
        try {
            var num = inputFormatisation(event, $(this).children("#search").val());
        } catch (error) {
            $.flash(error, "failure");
            return;
        }

        fetchJSON("Look/"+num).then(function(jsonData){
            if(jsonData['error']) {
                $.flash(jsonData['error']['msg'], "failure");
                return;
            }
            makeArray(jsonData, 20);
            drawArray("body > .container");
        }).catch(function (error) {
            $.flash(error, "failure");
            return;
        });

    });

});