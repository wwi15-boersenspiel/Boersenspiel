/**
 * Created by lucas on 08.12.2016.
 */
function showUser(str) {
    if (str == "") {
        document.getElementById("user").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("user").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST","http://localhost/user/ajaxShow/"+str,false);
        var params = "user="+str;
        xmlhttp.send(params);
    }
}