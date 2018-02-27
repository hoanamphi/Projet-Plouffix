$(document).ready(function() {
    console.log("ready");
    function inputFormatisation(event, num) {
        var reGex = /^(\d?(,|\.))?(\d{6,41})$/;
        if (reGex.exec(num)) {
            num = num.replace(/0?(\.|,)/,'');
            return num
        } else {
            event.preventDefault();
            $.flash("Erreur, l'entrée est invalide", "String");
            return false;
        }
    }

    $(".formNum > form").submit(function (event) {
        var num = inputFormatisation(event, $(this).children("#search").val());
        $.ajax({
            url: "/Look/"+num,
            type: "GET",
            success: function (rawdata) {
                console.log(rawdata);
            }
        });
    });
});