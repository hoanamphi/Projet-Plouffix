var pageNum = 0;
var currPage = 0;
var numDisplay = 0;
var displayArray;
var url;
var tr;
var tab;
var tdNum;
var tdTab;
var tdDef;

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
    head.innerHTML = "<th>Number</th> <th>Table</th> <th>Signification</th>";
    tab.appendChild(head);

    if ((currPage + 1 >= pageNum) && !(displayArray.length / numDisplay) % 1 === 0) {
        for (var i = 0; i < displayArray.length % numDisplay; i++) {
            tr = document.createElement("tr");

            tdNum = document.createElement("td");
            tdTab = document.createElement("td");
            tdDef = document.createElement("td");

            tdNum.innerText  = displayArray[i + (currPage * numDisplay)][0];

            url = document.createElement("a");
            url.setAttribute("href", "http://oeis.org/search?q=" + displayArray[i + (currPage * numDisplay)][1]);
            url.innerText = displayArray[i + (currPage * numDisplay)][1];
            tdTab.append(url);

            tdDef.innerText = displayArray[i + (currPage * numDisplay)][2];

            tr.append(tdNum);
            tr.append(tdTab);
            tr.append(tdDef);

            tab.appendChild(tr);
        }
    } else {
        for (var i = 0; i < numDisplay; i++) {
            tr = document.createElement("tr");

            tdNum = document.createElement("td");
            tdTab = document.createElement("td");
            tdDef = document.createElement("td");

            tdNum.innerText  = displayArray[i + (currPage * numDisplay)][0];

            url = document.createElement("a");
            url.setAttribute("href", "http://oeis.org/search?q=" + displayArray[i + (currPage * numDisplay)][1]);
            url.innerText = displayArray[i + (currPage * numDisplay)][1];
            tdTab.append(url);

            tdDef.innerText = displayArray[i + (currPage * numDisplay)][2];

            tr.append(tdNum);
            tr.append(tdTab);
            tr.append(tdDef);

            tab.appendChild(tr);
        }
    }
    manageButtons();
}

function drawNav(elem) {
    div = document.createElement("div");
    next = document.createElement("button");
    page = document.createElement("input");
    pageMax = document.createElement("span");
    prev = document.createElement("button");

    div.className = "nav";
    prev.innerText = "<";
    page.setAttribute("type", "number");
    next.innerText = ">";

    prev.addEventListener("click", decPage);
    page.addEventListener("keydown", function (event) {
        if(event.keyCode === 13) {
            goToPage($(page).val());
        }
    });
    next.addEventListener("click", incPage);

    div.append(prev);
    div.append(page);
    div.append(pageMax);
    div.appendChild(next);

    $(elem).append(div);
}

function makeArray(data, num) {
    displayArray = data;

    pageNum = 0;
    currPage = 0;
    numDisplay = num;

    pageNum = displayArray.length/numDisplay;
}

function incPage() {
    if (currPage + 1 <= pageNum) {
        currPage += 1;
        loadPage();
    }
}

function decPage() {
    if (currPage - 1 >= 0) {
        currPage--;
        loadPage();
    }
}

function goToPage(idx) {
    if (idx > 0 && idx <= Math.ceil(pageNum)) {
        currPage = idx-1;
        loadPage();
    } else {
        $.flash("No more values", "failure");
    }
}

function manageButtons(){
    var nav = $(".nav").children();

    nav.eq(0).prop('disabled', currPage === 0);
    nav.eq(1).val(currPage+1);
    nav.eq(2).text("/" +Math.ceil(pageNum));
    nav.eq(3).prop('disabled', currPage + 1 >= pageNum);

}