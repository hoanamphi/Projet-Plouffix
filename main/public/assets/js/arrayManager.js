var tab;
var pageNum = 0;
var currPage = 0;
var numDisplay = 0;
var displayArray;
var isInt;

function drawArray(elem) {

    if ($(".container > table").length == 0) {
        drawNav($(elem).closest("div"));
    } else {
        $(".container > table").remove();
    }

    tab = document.createElement("table");
    loadPage();
    $(elem).append(tab);
}

function loadPage() {
    $(tab).empty();

    var head = document.createElement("tr");
    head.innerHTML = "<th>Nombre</th> <th>Table</th> <th>Signification</th>";
    tab.appendChild(head);
    if((currPage + 1 >= pageNum) &&!isInt){
        for (var i = 0; i < displayArray.length % numDisplay; i++) {
            var tr = document.createElement("tr");
            tr.innerHTML += "<td>"+displayArray[i+(currPage*numDisplay)][0]+"</td>";
            tr.innerHTML += "<td>"+displayArray[i+(currPage*numDisplay)][1]+"</td>";
            tr.innerHTML += "<td>"+displayArray[i+(currPage*numDisplay)][2]+"</td>";
            tab.appendChild(tr);
        }
    } else {
        for (var i = 0; i < numDisplay; i++) {
            var tr = document.createElement("tr");
            tr.innerHTML += "<td>"+displayArray[i+(currPage*numDisplay)][0]+"</td>";
            tr.innerHTML += "<td>"+displayArray[i+(currPage*numDisplay)][1]+"</td>";
            tr.innerHTML += "<td>"+displayArray[i+(currPage*numDisplay)][2]+"</td>";
            tab.appendChild(tr);
        }
    }

    manageButtons();
}

function drawNav(elem) {
    next = document.createElement("button");
    prev = document.createElement("button");
    page = document.createElement("span");
    pageMax = document.createElement("span");

    prev.innerText = "<";
    next.innerText = ">";

    prev.addEventListener("click", decPage);
    next.addEventListener("click", incPage);

    $(elem).append(prev);
    $(elem).append(page);
    $(elem).append(pageMax);
    $(elem).append(next);
}

function makeArray(data, num) {
    for(i =0; i < data.length; i++)
        displayArray = data;
    console.log(displayArray);

    pageNum = 0;
    currPage = 0;
    numDisplay = num;

    pageNum = displayArray.length/numDisplay;
    isInt = (displayArray.length/numDisplay) % 1 === 0;
}

function incPage() {
    if (currPage + 1 <= pageNum) {
        currPage += 1;
        loadPage();
    }
    console.log(currPage);
}

function decPage() {
    if (currPage - 1 >= 0) {
        currPage--;
        loadPage();
    }
    console.log(currPage);
}

function manageButtons(){
    var prev = document.querySelector("button:nth-child(1)");
    var next = document.querySelector("button:nth-child(4)");
    var page = document.querySelector("span:nth-child(2)");
    var pageMax = document.querySelector("span:nth-child(3)");

    prev.disabled = (currPage == 0);
    next.disabled = (currPage + 1 >= pageNum);
    page.innerHTML = ""+(currPage+1);
    pageMax.innerHTML = " / "+Math.ceil(pageNum);
}