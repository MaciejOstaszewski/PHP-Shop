$(document).ready(function() {
	$("#formTowary").validate({
		messages: {
			name: {
          required: 'Podaj treść posta',
			},
		}
	});
});
// function showType(str) {
//     if (str == "") {
//         document.getElementById("typ").innerHTML = "";
//         return;
//     } else {
//         if (window.XMLHttpRequest) {
//             // code for IE7+, Firefox, Chrome, Opera, Safari
//             xmlhttp = new XMLHttpRequest();
//         } else {
//             // code for IE6, IE5
//             xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//         }
//         xmlhttp.onreadystatechange = function() {
//             if (this.readyState == 4 && this.status == 200) {
//                 document.getElementById("typ").innerHTML = this.responseText;
//             }
//         };
//         xmlhttp.open("GET","services/getTyp.php?id_kategorii="+str,true);
//         xmlhttp.send();
//     }
// }
function showType(str) {
    if (str.length == 0) {
        document.getElementById("typ").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("typ").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","services/getTyp.php?id_kategorii="+str,true);
        xmlhttp.send();
    }
}
function showType2(str) {
    if (str.length == 0) {
        document.getElementById("typ2").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("typ2").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","services/getTyp.php?search=1&id_kategorii="+str,true);
        xmlhttp.send();
    }
}
