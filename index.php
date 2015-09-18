<!doctype html>
<html lang="en">
  <head>
      <title>Current Observation</title>
      <link rel="stylesheet" href="css/main.css" />
  </head>
    <body>
        <?php
            $curl = curl_init("http://api.weather.com/v2/aggregate/v2loc;v2obs;v2fcstdaily3;v2fcsthourly6;v2astro?geocode=40.69,-73.99&format=json&language=en-US&R2.units=e&R3.units=e&R4.units=e&R5.units=e&R5.days=2&apiKey=tsybhwupcwn4mw55m77euxh6r5pe639b");
            curl_setopt($curl, CURLOPT_TIMEOUT, 5);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($curl);
            curl_close($curl);
            $json = json_decode($data); // not adding TRUE, returns an object. so use '->' notation
        ?>
        <div id="main">
            <?php 
                printf("<div>%s, %s</div>", $json->result[0]->result->addresses[0]->locality, $json->result[0]->result->addresses[0]->admin_district);
                printf("<img src='https://api.wunderground.com/i/c/api/icon-" . $json->result[1]->result->observation->wx_icon . ".svg'/>");
                printf("<ul><li>Temp&nbsp;%s&nbsp;&deg;F</li>" , $json->result[1]->result->observation->temp);
                printf("<li>Humidity&nbsp;%s&#37;</li>" , $json->result[1]->result->observation->rh);
                printf("<li>Pressure&nbsp;%sin</li></ul>", $json->result[1]->result->observation->pressure);
            ?>
        </div>
    </body>
</html>
