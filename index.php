
<html>
<title>Travel With Us- Stav&Liza</title>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

<style>
    a:link, a:visited {
        background-color:#8793ff;
        color: black;
        padding: 10px 15px;
        text-align: center;
        text-decoration: none;
        display:inline-block;
    }
    body
    {
        background:#d5daff ;
    }

    .travel-image {
        background-image: url("background.jpeg");
        background-color: #cccccc;
        height: 550px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;

    }
    .info-text {
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color:black;
        font-size:30px ;
        font-weight: bold;
    }


    a:hover, a:active {
        background-color:cadetblue;
    }

    table {
        width: 100%;

    }
    p1{
        padding: 30px;
    font-weight: bold;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }



</style>
</head>
<div class="travel-image" alt="travel" aria-label=="HIKER!!!">
    <div class="info-text" >


<h1 style="text-align:center">Welcome To Our Traveling site
    <img  src="Hiking.png" alt="travel" width="40" height="40" ></h1>

<p1 style="text-align:center">This website will give information about treks and hikers</p1>

    </div>
</div>

<p style="text-align:center"><a href="UploadData.php" >Click here to load a files</a></p>
<p style="text-align:center"><a href="NewTraveler.php">Click here to add a new traveler</a></p>
<p style="text-align:center"><a href="StoryMap.php">Click here to watch traveler map</a></p>

<table style= "width:80%" align="center" border="1">
    <tr>
        <th>Needed Status</th></tr>
</table>
    <table style="width:80% " align="center" border="1">
    <tr>
        <th align="center">Most Traveled Trek</th>
        <th>Most Experienced Traveler</th>
        <th>Special Traveler</th>
    </tr>

    <?php
    // Connecting to the database
    $server = "tcp:techniondbcourse01.database.windows.net,1433";
    $user = "titelbaum";
    $pass = "Qwerty12!";
    $database = "titelbaum";
    $c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
    sqlsrv_configure('WarningsReturnAsErrors', 0);
    $conn = sqlsrv_connect($server, $c);
    if($conn === false)
    {
        echo "error";
        die(print_r(sqlsrv_errors(), true));
    }
    session_start();

    $current_id = 1;
    $sql = "SELECT trekName FROM MostTraveledTrek";
    $result = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    echo "<tr><td>".$row['trekName']."</td>";
    $sql = "SELECT fullName FROM MostTravelerName";
    $result = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    echo "<td>".$row['fullName']."</td>";
    $sql = "SELECT fullName FROM SpecialTraveler";
    $result = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    echo "<td>".$row['fullName']."</td></tr>";



    // while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
   // {
       // $sum = ($row["home_goals"] + $row["away_goals"]);
     //   echo "<tr><td>".$row['hikerID']."</td>".
        //    "<td>".$row['Home']."</td>".
          //  "<td>".$row['Away']."</td>".
         //   "<td>".$row['result']."</td>".
         //   "<td>".$row['season']."</td>".
          //  "<td>".$row['notes']."</td>".
           // "<td>$sum</td></tr>";
      //  $current_id++;
    //}
   // $_SESSION['current_id'] = $current_id;

   ?>
</table>
<br>
<br>

</body>
</html>