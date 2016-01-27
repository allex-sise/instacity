<?php
if (!empty($_GET['location'])){
    $maps_url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($_GET['location']);
    $maps_json = file_get_contents($maps_url);
    $maps_array = json_decode($maps_json,true);
    $lat = $maps_array['results']['0']['geometry']['location']['lat'];
    $lng = $maps_array['results']['0']['geometry']['location']['lng'];
    $timestamp = time();
    //var_dump($timestamp);
    $instagram_url = 'https://api.instagram.com/v1/media/search?lat='.$lat.'&lng='.$lng.'&access_token=1716833421.1677ed0.3838856823c04fa78d741ef681ccc152'.'&max_timestamp=';//.$timestamp;
    $instagram_json = file_get_contents($instagram_url);
    $instagram_array = json_decode($instagram_json,true);
    
}
/**
 * @allex 
 * @copyright 2015
 */
?>



<html lang="en">
<head>
    
    <meta charset="utf-8"/>
    <title>InstaCity</title>
    <script>
    function setCookie(cname,cvalue,exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires=" + d.toGMTString();
        document.cookie = cname+"="+cvalue+"; "+expires;
    }
    
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return ""; 
    }
    
    function checkCookie() {
         var index;
         var test = 'mangalia';
         var text = "<ul>";
        var fruits = ["Banana", "Orange", "Apple", "Mango"];
        var user=getCookie("username");
        if (user != "") {
           for (index = 0; index < fruits.length; index++) {
             text += "<li>" + fruits[index] + "</li>";
             }
            text += "</ul>";
            document.getElementById("demo").innerHTML = text;
        } 
        else {
           var javascriptvar = document.getElementById('location').value;
           user = javascriptvar;//verifica locatia
           
        }
           //arata locatia -> echo location;
         if (user == test) {
               setCookie("username", user, 30);
               
           }
        
        
    }
    

function myFunction() {
    var index;
    var text = "<ul>";
    var fruits = ["Banana", "Orange", "Apple", "Mango"];
    for (index = 0; index < fruits.length; index++) {
        text += "<li>" + fruits[index] + "</li>";
    }
    text += "</ul>";
    document.getElementById("demo").innerHTML = text;
    $("#buton").onclick(function(){
        var text = $("#textarea").text();
        $("#ul_tau").append("<li>" + text + "</li>");
    });
}
</script>
    
    
</head>
<body onload="checkCookie()"> 
<p id="demo"></p>
<form action="">
    <br><br><br>
    <div style="height:233px;margin-top:89px">
    <center><h1>InstaCity:</h1>
    <input type="text" name="location"/>
    <br><br>
    <button id="buton" type="submit">submit</button>
    
    <br/><br/>
    <?php
    if(!empty($instagram_array)){
    foreach ($instagram_array['data'] as $image){
        echo '<img src="'
        .$image['images']['low_resolution']['url'].'" 
        alt=""/>';
    }
    }
    else
    {
        echo "*type desired city and get latest instagram photos from location";
    }
    ?>
    </center>
</form>


    
</body>
</html>