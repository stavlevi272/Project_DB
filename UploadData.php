<html name="name1">
<title>Data Upload</title>
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
<h1> <img  src="Hiking.png" alt="travel" width="40" height="40" > Load Data</h1>
<h3>Press on the relevant button in order to load data of a specific file </h3>
<hr>


<br>
    <h3>Hikers Data</h3>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">

        <input name="csv1" type="file" id="csv1" />
        <input type="submit" name="submit1" value="submit" />

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
    if ($conn === false) {
        echo "error";
        die(print_r(sqlsrv_errors(), true));
    }


    if (isset($_POST["submit1"]))
    {
        $sql="SELECT * FROM Hiker";
        $result= sqlsrv_query($conn,$sql,array(),array("Scrollable"=>'static'));
        $current_id1=0;
        $all_1=-1;
      //  if ($result and sqlsrv_has_rows($result)){
       //     $current_id1 = sqlsrv_num_rows($result) + 1;
      //  }
        $file = $_FILES[csv1][tmp_name];

        if (($handle = fopen($file, "r")) !== FALSE)
        {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
        {

                $all_1++;
                //   $sql="INSERT INTO Trek (trekName,length,LAT,LONG) VALUES ('momo', 12,5,5)";
                $sql="INSERT INTO Hiker(ID, fullName, originCountry, Smoker, Fitness) VALUES
(".addslashes($data[0]).",'".addslashes($data[1])."','".addslashes($data[2])."','".addslashes($data[3])."', ".addslashes($data[4]).")";

                if(sqlsrv_query($conn, $sql))
                {
                    $current_id1 = $current_id1+1;
                }
            }

        }
        echo "<script type='text/javascript'>alert('rows added:.$current_id1. from:.$all_1. successfully' )</script>";

        fclose($handle);
    }


    ?>


    <br>
    <h3>Treks Data</h3>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">

        <input name="csv2" type="file" id="csv2" />
        <input type="submit" name="submit2" value="submit" />

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
    if ($conn === false) {
        echo "error";
        die(print_r(sqlsrv_errors(), true));
    }

    if (isset($_POST["submit2"]))
    {
        $sql="SELECT * FROM Trek";
        $result= sqlsrv_query($conn,$sql,array(),array("Scrollable"=>'static'));
        $current_id2=0;
        $all_2=-1;
        $file = $_FILES[csv2][tmp_name];

        if (($handle = fopen($file, "r")) !== FALSE)
        {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
            {

                    $all_2++;
                //   $sql="INSERT INTO Trek (trekName,length,LAT,LONG) VALUES ('momo', 12,5,5)";
                $sql="INSERT INTO Trek (trekName, length, LAT, LONG) VALUES
('".addslashes($data[0])."',".addslashes($data[1]).",".addslashes($data[2]).",".addslashes($data[3])." )";

                if(sqlsrv_query($conn, $sql))
                {
                    $current_id2 = $current_id2+1;
                }
            }
        }
        echo "<script type='text/javascript'>alert('rows added:.$current_id2. from:.$all_2. successfully' )</script>";
        fclose($handle);
    }

    ?>


    <br>
    <h3>Treks in countries Data</h3>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">

        <input name="csv3" type="file" id="csv3" />
        <input type="submit" name="submit3" value="submit" />

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
    if ($conn === false) {
        echo "error";
        die(print_r(sqlsrv_errors(), true));
    }

    if (isset($_POST["submit3"]))
    {
        $sql="SELECT * FROM TrekInCountry";
        $result= sqlsrv_query($conn,$sql,array(),array("Scrollable"=>'static'));
        $current_id3=0;
        $all_3=-1;
        $file = $_FILES[csv3][tmp_name];

        if (($handle = fopen($file, "r")) !== FALSE)
        {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
            {


                $all_3++;
                $sql="INSERT INTO TrekInCountry (countryName, trekName) VALUES
('".addslashes($data[0])."','".addslashes($data[1])."')";

                if(sqlsrv_query($conn, $sql))
                {
                    $current_id3 = $current_id3+1;
                }
            }
        }
        echo "<script type='text/javascript'>alert('rows added:.$current_id3. from:.$all_3. successfully' )</script>";

        fclose($handle);

    }

    ?>


    <br>
    <h3>Hikers in Trek Data</h3>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">

        <input name="csv4" type="file" id="csv4" />
        <input type="submit" name="submit4" value="submit" />

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
    if ($conn === false) {
        echo "error";
        die(print_r(sqlsrv_errors(), true));
    }

    if (isset($_POST["submit4"]))
    {
        $sql="SELECT * FROM HikerInTrek";
        $result= sqlsrv_query($conn,$sql,array(),array("Scrollable"=>'static'));
        $current_id4=0;
        $all_4=-1;
        $file = $_FILES[csv4][tmp_name];

        if (($handle = fopen($file, "r")) !== FALSE)
        {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
            {

//
                $all_4++;
                $sql="INSERT INTO HikerInTrek (hikerID, trekName, startDate) VALUES
(".addslashes($data[0]).",'".addslashes($data[1])."','".addslashes($data[2])."')";
                // $sql="INSERT INTO HikerInTrek (hikerID, trekName, startDate) VALUES (183342345,'Roopkund','2005-01-09')";

                if(sqlsrv_query($conn, $sql))
                {
                    $current_id4 = $current_id4+1;
                }
            }

        }
        echo "<script type='text/javascript'>alert('rows added:.$current_id4. from:.$all_4. successfully' )</script>";

        fclose($handle);

    }

    ?>



    <p style="text-align:center"><a href="index.php">Click here to return to home page</a></p>

</body>
</html>