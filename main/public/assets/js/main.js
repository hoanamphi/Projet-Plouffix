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
            return;
        }
    }

    $(".formNum > form").submit(function (event) {
        event.preventDefault();
        var num = inputFormatisation(event, $(this).children("#search").val());
        console.log("using fetchJson");
        fetchJSON("Look/"+num).then(function(jsonData){
            makeArray(jsonData, 20);
            drawArray("body > .container");
        });
        console.log("submit");
    });

});