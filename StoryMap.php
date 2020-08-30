<html>
<title>Travel Story Map</title>
<body style="background-color:#d5daff; text-align:center">
<style>
    a:hover{
        color:hotpink

    }
    hr {
        display: block;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        margin-left: auto;
        margin-right: auto;
        border-style: inset;
        border-width: 1px;
    }
</style>
<br>
<h1> <img  src="Hiking.png" alt="travel" width="40" height="40" >Traveler's Story Map </h1>
<hr>
<h3>Please Choose Insert an ID you'd like to explore </h3>
<form action="StoryMap.php" method="POST">

    ID*:<input  type="text" name="ID" required="required" ><br>
    <input  name="submit"  type="submit" value ="Search"><br>


</form>

<?php

$server = "tcp:techniondbcourse01.database.windows.net,1433";
$user = "titelbaum";
$pass = "Qwerty12!";
$database = "titelbaum";

if (isset($_POST["submit"]))
{

    $c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
    sqlsrv_configure('WarningsReturnAsErrors', 0);
    $conn = sqlsrv_connect($server, $c);
    if ($conn === false) {
        echo "error";
        die(print_r(sqlsrv_errors(), true));
    }

    $ID = $_POST['ID'];

    $sql = "SELECT * FROM Hiker WHERE ID = " . ($ID);
    $result = sqlsrv_query($conn, $sql, array(), array("Scrollable" => 'static'));
    if ($result) {
        $rows = sqlsrv_num_rows($result);
        if ($rows === 0) {
            echo '<div class="alert">';
            echo '<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
            echo " please try again,the hiker " . ($ID) ;echo"doesn't exsits!" ;
            echo '</div>';
        }
        else {
            $sql = "SELECT T.trekName, LAT, LONG FROM HikerInTrek INNER JOIN Trek T on HikerInTrek.trekName = T.trekName WHERE hikerID = " . ($ID) . "ORDER BY startDate ASC";
            $sqlsrv = sqlsrv_query($conn, $sql);
            if ($sqlsrv === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            echo "<script type='text/javascript'>
                            var map;
                            function GetMap()
                            {
                                map = new Microsoft.Maps.Map('#myMap', {});";
            $count = 0;
            while ($row = sqlsrv_fetch_array($sqlsrv, SQLSRV_FETCH_ASSOC)) {
                $count = $count + 1;
                $TrekName = $row['trekName'];
                $Lat = $row['LAT'];
                $Long = $row['LONG'];

                if ($count == 1) {

                    echo "
                                
                                map.setView({
                                mapTypeId: Microsoft.Maps.MapTypeId.aerial,
                                center: new Microsoft.Maps.Location(" . floatval($Lat) . "," . floatval($Long) . "),
                                zoom: 1
                                });";
                }

                echo "    
                    var center = new Microsoft.Maps.Location(" . ($Lat) . "," . ($Long) . ");
                    var pin = new Microsoft.Maps.Pushpin(center, {
                        title: '" . addslashes($TrekName) . "',
                        text:'" . ($count) . "'
                    });
                    map.entities.push(pin);
                ";
            }
            if ($count == 0) {
                echo "
                                
                                map.setView({
                                mapTypeId: Microsoft.Maps.MapTypeId.aerial,
                                zoom: 1
                                });";
            }

            echo " }
                </script>
                <script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AvJZzTmbwvMGXaZRbr3HrfyHDxYBVVFpkxnqpzkFg6d1P8lTk6vOAEnsYqSUYJB7'></script>
            <div id=\"mapContainer\" class=\"standardMap\" style=\"width:50%;heigh t:50%\">
            <div id=\"myMap\"></div></div>
            ";

        }
    }
}
?>

</div>
<p style="text-align:center"><a href="index.php">Click here to return to home page</a></p>
</body>
</html>