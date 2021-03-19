<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload = "loadContent()">
    <h3>Add ID & NAME :</h3>
    <input type="text" id="new_id"><input type="text" id="new_name">
    <button onclick="add_data()">Add</button>
    <hr>

    <div id="out"></div>
    <script>
    function loadContent(){
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            console.log(this.readyState+", "+this.status);
            if(this.readyState==4 && this.status==200){
                console.log(this.responseText);
                data = JSON.parse(this.responseText);
                console.log(data.length);
                create_table(data);
            }
        }
        xhttp.open("GET","02 rest.php",true);
        xhttp.send();
    }
    
    
    /*
    function loadDoc(){
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){ // การแจ้งสถานะว่าเว็บเราถึงขั้นตอนไหนแล้ว
            console.log(this.readyState);
            if(this.readyState==4 && this.status == 200){
            console.log(this.responseText);
            data = JSON.parse(this.responseText);
            m = document.getElementById("out");
            text="<table border='1'>";
            for(i=0;i<data.length;i++){
                text+="<tr>";
                for(key in data[i]){
                text+="<td>"+data[i][key]+"</td>";
                }
                text+="</tr>";
            }
            text+="</table>";
            m.innerHTML += text;
            //console.log(data);
            }
        }
        xhttp.open("GET","rest.php",true);
        xhttp.send();
    }*/

    function add_data(){
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200){
                console.log(this.responseText);
                // alert(this.responseText);
            }
        }
        new_id = document.getElementById("new_id").value;
        new_name = document.getElementById("new_name").value;
        xhttp.open("POST","02 rest.php",true);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send("new_id="+new_id+"&new_name="+new_name);
    }
 
    function create_table(data){
        out = document.getElementById("out");
        out.innerHTML = "";
        text = "<table border='1'>";
        for(i=0;i<data.length;i++){
            for(inf in data[i]){
                text += "<td>"+data[i][inf]+"</td>";
            }
            text += "<td><button onclick='del_data("+i+")'>Delete</button></td>";
            text="<tr>"+text+"</tr>";
        }
        out.innerHTML = text + "</table>";
    }
    function del_data(row){
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200){
                console.log(this.responseText);
                //alert(this.responseText);
                var x = this.id;
                x.del_data();
            }
        }
        xhttp.open("POST","02 rest.php",true);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send("delete="+row);
    }
    </script>
</body>

</html>
