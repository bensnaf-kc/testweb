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
        xhttp.send();
    }
    </script>

</body>
</html>