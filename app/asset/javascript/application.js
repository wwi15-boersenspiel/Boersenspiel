/**
 * Created by lucas on 07.12.2016.
 */


checkPageStauts()

function checkPageStauts() {
    if (document.readyState != "complete") {
        myFunction()
    } else {
        checkPageStauts()
    }
}


function myFunction() {
     setTimeout(showPage, 1000);
}

function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("myDiv").style.display = "block";
}


