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

    var tab;
    var pageNum = 0;
    var currPage = 0;
    var numDisplay = 20;
    var displayArray;

    function makeArray(data, elem) {
        for(i =0; i < data.length; i++)
        displayArray = data;
        console.log(displayArray);

        pageNum = displayArray.length/numDisplay;
    }

    function incPage() {
        if (currPage + 1 < pageNum) {
            currPage ++;
        }
        console.log(currPage);
    }

    function decPage() {
        if (currPage - 1 > 0) {
            currPage --;
        }
        console.log(currPage);
    }

    function drawArray(elem) {

        drawNav($(elem).closest("div"));

        tab = document.createElement("table");

        var head = document.createElement("tr");
        head.innerHTML = "<th>Nombre</th> <th>Table</th> <th>Signification</th>";
        tab.appendChild(head);

        for (var i = currPage; i < currPage+numDisplay; i++) {
            var tr = document.createElement("tr");
            tr.innerHTML += "<td>"+displayArray[i][0]+"</td>";
            tr.innerHTML += "<td>"+displayArray[i][1]+"</td>";
            tr.innerHTML += "<td>"+displayArray[i][2]+"</td>";
            tab.appendChild(tr);
        }
        $(elem).append(tab);
    }

    function drawNav(elem) {
        next = document.createElement("button");
        prev = document.createElement("button");

        prev.innerText = "<";
        next.innerText = ">";

        prev.addEventListener("mousedown", decPage());
        next.addEventListener("mousedown", incPage());

        $(elem).append(prev);
        $(elem).append(next);

    }

});