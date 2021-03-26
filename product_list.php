<?php
    session_start();
    $_SESSION['cus_id']=1234;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload="load_Doc()">
<center><div id="out"></div><div id="out2"></div></center>
    <script>
    let cus_id = 1234;
    let arr;
    let label = ["product_id","รหัสสินค้า","ชื่อสินค้า","brand","หน่วยนับ","ราคา","จำนวนสินค้า"];
    function load_Doc(){
        let out = document.getElementById("out");
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState==4 && this.status==200) {
                arr = JSON.parse(this.responseText);
                text = "<table border='1'>";
                for(i=0; i<label.length-1; i++) {
                    text +="<th>"+label[i]+"</th>";
                }
                text = "<tr>" + text + "</tr>";
                for(i=0;i<arr.length;i++){
                    for(j=0;j<arr[i].length-1;j++){
                        text += "<td>" + arr[i][j]+"</td>";
                    }
                    text += "<td>"+"<button onclick='sel_product("+i+")'>< ShopShock ></button>"+"</td>";
                    text = "<tr>"+ text + "</tr>";
                }
                text += "</table>";
                out.innerHTML = text;
            }
        }
        xhttp.open("GET","product_rest.php",true);
        xhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        xhttp.send("pid="+arr[idx][0]+"&code="+arr[idx][1]+"&qty="+qty.value+"&cus_id");
    }

    function sel_product(idx){
        let out = document.getElementById("out2");
        text = "<table border='1'>";
            for(i=0; i<label.length-1; i++) {
                text +="<tr><th>"+label[i]+"</th>";
                text += "<td>"+arr[idx][i]+"</td></tr>";
            }
            text +="<tr><th>"+label[6]+"</th>";
            text += "<td><input type='number' min='1' max='"+arr[idx][6]+"'></td></tr>";
            text += "<tr><td colspan=2><button onclick='open_po("+idx+")'>Add to Cart</button><input type='reset'></td></tr>"
            text += "</tabel>";
            out.innerHTML = text;
    }

    function open_po(idx){
        qty = document.getElementById("n_"+idx);
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200){
                alert(this.responseText);
            }
        }
        xhttp.open("POST","product_rest.php",true);
        xhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        xhttp.send("pid"+arr[idx][0]+"&qty="+qty.value+"&price="+arr[idx][5]+"&cus_id="+cus_id);
    }
    </script>

</body>
</html>