<html>
<body>
<?php

//connecting to server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rental_company";
//create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// check conncetion
if($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected Successfully <br>";


//is_available for car depended on if active rental or scheduled rental is out for car


$sql = "UPDATE car 
        inner join dailyrental on car.Vehical_Id = dailyrental.Vehical_Id
        SET Is_Available = 1
        where dailyrental.Is_Active = 0 and dailyrental.Is_Scheduled = 0;";

$result = $conn->query($sql);

$sql = "UPDATE car 
        inner join dailyrental on car.Vehical_Id = dailyrental.Vehical_Id
        SET Is_Available = 0
        where dailyrental.Is_Active = 1 and dailyrental.Is_Scheduled = 0;";

$result = $conn->query($sql);

$sql = "UPDATE car 
        inner join dailyrental on car.Vehical_Id = dailyrental.Vehical_Id
        SET Is_Available = 0
        where dailyrental.Is_Active = 0 and dailyrental.Is_Scheduled = 1;";

$result = $conn->query($sql);

$sql = "UPDATE car 
        inner join dailyrental on car.Vehical_Id = dailyrental.Vehical_Id
        SET Is_Available = 0
        where dailyrental.Is_Active = 1 and dailyrental.Is_Scheduled = 1;";

$result = $conn->query($sql);


$sql = "UPDATE car 
        inner join weeklyrental on car.Vehical_Id = weeklyrental.Vehical_Id
        SET Is_Available = 0
        where weeklyrental.Is_Active = 1 and weeklyrental.Is_Scheduled = 1;";

$result = $conn->query($sql);

$sql = "UPDATE car 
        inner join weeklyrental on car.Vehical_Id = weeklyrental.Vehical_Id
        SET Is_Available = 0
        where weeklyrental.Is_Active = 0 and weeklyrental.Is_Scheduled = 1;";

$result = $conn->query($sql);

$sql = "UPDATE car 
        inner join weeklyrental on car.Vehical_Id = weeklyrental.Vehical_Id
        SET Is_Available = 0
        where weeklyrental.Is_Active = 1 and weeklyrental.Is_Scheduled = 0;";

$result = $conn->query($sql);


$sql = "UPDATE car 
        inner join weeklyrental on car.Vehical_Id = weeklyrental.Vehical_Id
        SET Is_Available = 1
        where weeklyrental.Is_Active = 0 and weeklyrental.Is_Scheduled = 0;";

$result = $conn->query($sql);

//end of statments for is_available


//updating amount due for dailyrental table
$sql = "UPDATE dailyrental
        inner join car on dailyrental.Vehical_Id = car.Vehical_ID
        SET Amount_Due = car.Daily_Rate * dailyrental.No_of_Days;";
$result = $conn->query($sql);

//updating amount due for weekly table
$sql = "UPDATE weeklyrental
        inner join car on weeklyrental.Vehical_Id = car.Vehical_ID
        SET Amount_Due = car.Weekly_Rate * weeklyrental.No_of_Weeks;";
$result = $conn->query($sql);




//showing results for customer table
echo "Showing database results <br>";
echo "-----------------------------<br>";
$sql = "select Id_Number,F_Initial,Last_Name,Phone from customer";
$result = $conn -> query($sql);

if($result)
{
    echo "Customer Table Results <br>";
    while($row = $result -> fetch_assoc())
    {
        echo "<br> | Id Number: " . $row["Id_Number"]. " | Name: " .$row["F_Initial"]. ", " .$row["Last_Name"]." | Phone Number: ".$row["Phone"] ." | <br>";
    }
}
else
{
    echo "0 results";
}



//showing results for car table
$sql = "select Vehical_Id,Type,Model,Year,Daily_Rate,Weekly_Rate,Is_Available from car";
$result = $conn->query($sql);
echo "<br><br><br>";

if($result)
{
    echo "<br>Car Table Results <br>";
    while($row = $result -> fetch_assoc())
    {
        echo "<br> | Vehical Id: " . $row["Vehical_Id"]. " | Type: " .$row["Type"]. " | Model: " .$row["Model"]." | Year: ".$row["Year"] ." | Daily Rate: $" .$row["Daily_Rate"]
        ." | Weekly Rate: $".$row["Weekly_Rate"] . " | Is Available: " .$row["Is_Available"] ." |<br>";
    }
}
else
{
    echo "0 results";
}

//showing results for Daily rental table 
$sql = "select Id_Number,Vehical_Id,Is_Active,Is_Scheduled,No_of_Days,Start_Date,Amount_Due from dailyrental";
$result = $conn->query($sql);
echo "<br><br><br>";

if($result)
{
    echo "<br>Daily Rental Table Results <br>";
    while($row = $result -> fetch_assoc())
    {
        echo "<br> | Id Number: " . $row["Id_Number"]. " | Vehical Id: " .$row["Vehical_Id"]. " | Is Active: " .$row["Is_Active"]." | Is Scheduled: ".$row["Is_Scheduled"] ." | No_of_Days: " .$row["No_of_Days"]
        ." | Start_Date: $".$row["Start_Date"] . " | Amount_Due: $" .$row["Amount_Due"] ." |<br>";
    }
}
else
{
    echo "0 results";
}

//showing resutls for weeklyrental table
$sql = "select Id_Number,Vehical_Id,Is_Active,Is_Scheduled,No_of_Weeks,Start_Date,Amount_Due from weeklyrental";
$result = $conn->query($sql);
echo "<br><br><br>";

if($result)
{
    echo "<br>Weekly Rental Table Results <br>";
    while($row = $result -> fetch_assoc())
    {
        echo "<br> | Id Number: " . $row["Id_Number"]. " | Vehical Id: " .$row["Vehical_Id"]. " | Is Active: " .$row["Is_Active"]." | Is Scheduled: ".$row["Is_Scheduled"] ." | No_of_Weeks: " .$row["No_of_Weeks"]
        ." | Start_Date: ".$row["Start_Date"] . " | Amount_Due: $" .$row["Amount_Due"] ." |<br>";
    }
}
else
{
    echo "0 results";
}





?>
</body>
</html>
