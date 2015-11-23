<?php
if (!empty($_GET['location'])){
    $maps_url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($_GET['location']);
    $maps_json = file_get_contents($maps_url);
    $maps_array = json_decode($maps_json,true);
    $lat = $maps_array['results']['0']['geometry']['location']['lat'];
    $lng = $maps_array['results']['0']['geometry']['location']['lng'];
    
    
    $timestamp = time();
    
    
    $ip     = $_SERVER['REMOTE_ADDR']; // means we got user's IP address 
    var_dump('ip: ',$ip);
    $json   = file_get_contents( 'http://smart-ip.net/geoip-json/' . $ip); // this one service we gonna use to obtain timezone by IP
    // maybe it's good to add some checks (if/else you've got an answer and if json could be decoded, etc.)
    $ipData = json_decode( $json, true);
    
    if ($ipData['timezone']) {
            $tz = new DateTimeZone( $ipData['timezone']);
            var_dump($tz);
            $now = new DateTime( 'now', $tz); // DateTime object corellated to user's timezone
            var_dump($now);
        } 
    else {
          var_dump('PULA');
        }
        
    $returnType = 'php';
    $timezone = 'Bucharest';
    $requestUri = sprintf('http://www.convert-unix-time.com/api?timestamp=%s&timezone=%s&returnType=%s',
    $timestamp, $timezone, $returnType);

    $response = file_get_contents($requestUri);
    $result = unserialize($response);
    var_dump($result);
    
    $instagram_url = 'https://api.instagram.com/v1/media/search?lat='.$lat.'&lng='.$lng.'&access_token=1716833421.1677ed0.3838856823c04fa78d741ef681ccc152'.'&max_timestamp='.$timestamp;
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
    <title>geogram</title>
</head>
<body>
<form action="">
    <input type="text" name="location"/>
    <button type="submit">submit</button>
    <br/>
    <?php
    if(!empty($instagram_array)){
    foreach ($instagram_array['data'] as $image){
        echo '<img src="'
        .$image['images']['low_resolution']['url'].'" 
        alt=""/>';
    }
    }
    ?>
</form>

</body>
</html>