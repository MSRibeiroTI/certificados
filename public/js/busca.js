function search(str) {
    if (str.length == 0) {
        document.getElementById("tb").innerHTML = "";
        document.getElementById("tb").style.border = "0px";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tb").innerHTML = this.responseText;
                document.getElementById("tb").style.border = "1px solid #A5ACB2";
            }
        };
        xmlhttp.open("GET", "/certificados/app/Views/aluno_search.php?q=" + str, true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlhttp.send();
    }
}

function searchCert(str) {
    if (str.length == 0) {
        document.getElementById("tb").innerHTML = "";
        document.getElementById("tb").style.border = "0px";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tb").innerHTML = this.responseText;
                document.getElementById("tb").style.border = "1px solid #A5ACB2";
            }
        };
        xmlhttp.open("GET", "/certificados/app/Views/cert_Search.php?q=" + str, true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlhttp.send();
    }
}

