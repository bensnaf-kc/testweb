<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body onload ="loadDoc()">
  <div id="out"></div>
    <script>
    function loadDoc(){
      let xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(){
        console.log(this.readyState);
        if(this.readyState==4 && this.status==200){
          console.log(this.responseText);
          my = JSON.parse(this.responseText);
          m = document.getElementById("out");
          text = "<table border='1'>";
          for(i=0; i<my.length; i++){
            text += "<tr>";
            for(key in my[i]){
              text += "<td>" + my[i][key]+"</td>";
            }
            text += "</tr>";
          }
          text += "</table>";
        m.innerHTML += text;
        }
      }
      xhttp.open("GET","02 rest.php",true);
      xhttp.send();
    }
    </script>
  </body>
</html>
