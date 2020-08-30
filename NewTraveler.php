
<html>
<title>New Traveler</title>
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
<h1> <img  src="Hiking.png" alt="travel" width="40" height="40" > Hello, you can insert a new traveler to the Data Base </h1>
<hr><br>
<form action="NewTraveler.php" method="POST">

    ID*:<input  type="text" name="ID" required="required" ><br>
    Full Name:<input  type="text" name="FullName" ><br>
    Country:<input  type="text" name="Country"><br>
    Fitness:<input align="center" type="range" name="Fitness" min="0" max="100" step="1" ><br>
    Smoker:
    <br>
    <input type="radio" name="result" value="No" checked="checked"> No<br>
    <input type="radio" name="result" value="Yes">Yes<br>

    <br><br>
    <input  name="submit"  type="submit" value ="Add traveler"><br><br>


</form>
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
//require('index.php');

if(isset($_POST['submit'])){
    $sql="SELECT * FROM Hiker";
    $result= sqlsrv_query($conn,$sql,array(),array("Scrollable"=>'static'));
    $current_id=1;
    if ($result and sqlsrv_has_rows($result)){
        $current_id = sqlsrv_num_rows($result) + 1;

    }
    //  $ID=$_POST['ID'];
    //echo "$ID";
    //$sql = "INSERT INTO Hiker (ID, fullName, originCountry,Smoker, Fitness) VALUES (207383,'momo','israel','No',5)";
    $sql = "INSERT INTO Hiker (ID, fullName, originCountry,Smoker, Fitness) VALUES (".$_POST['ID'].",'".addslashes($_POST['FullName'])."', '".addslashes($_POST['Country'])."', '".addslashes($_POST['result'])."', ".$_POST['Fitness'].")";
    //echo ".$_POST['ID'].";
    //$ID = check_input($_POST['ID'],"You Must Enter your ID!");
    $result = sqlsrv_query($conn,$sql);
    if(!$result)
        echo "FAIL TO ADD";
    else{
        $current_id++;
        // echo "$current_id";

    }
}
?>
<p style="text-align:center"><a href="index.php">Click here to return to home page</a></p>
</body>
</html>