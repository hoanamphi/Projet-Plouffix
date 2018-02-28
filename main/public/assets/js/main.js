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
        event.preventDefault();
        var num = inputFormatisation(event, $(this).children("#search").val());
        console.log("using fetchJson");
        fetchJSON("Look/"+num).then(function(jsonData){
            makeArray(jsonData);
            drawArray("body > .container")
        });
        console.log("submit");
    });

    var pageNum = 0;
    var currPage = 0;
    var numDisplay = 20;
    var displayArray = new Array();

    function makeArray(data) {
        for(i =0; i < data.length; i++)
        displayArray.push([data[i][0]], [data[i][1]], [data[i][2]]);
        console.log(displayArray);
        pageNum = displayArray.length/numDisplay;
    }

    function addPage(idx) {
        if (pageNum += idx < pageNum) {
            pageNum += idx;
            currPage += idx;
        }
        loadPage();
    }

    function decPage(idx) {
        if (pageNum -= idx > 0) {
            pageNum -= idx;
            currPage -= idx;
        }
        loadPage();
    }

    function drawArray(elem) {
        var tab = document.createElement("table");
        $(elem).append(tab);

        for (var i = currPage; i < currPage+numDisplay*3+1; i++) {
            var tr = document.createElement("tr");
            tr.innerHTML += "<td>"+displayArray[i]+"</td>";
            i++;
            tr.innerHTML += "<td>"+displayArray[i]+"</td>";
            i++;
            tr.innerHTML += "<td>"+displayArray[i]+"</td>";
            tab.appendChild(tr);
        }

    }

});