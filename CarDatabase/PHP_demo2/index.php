
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


//testing button
if(array_key_exists('CustomerList', $_POST)) {
    CustomerList();
}
else if(array_key_exists('AvailableCars', $_POST)) {
    AvailableCars();
}

if (array_key_exists('DailyRentedCars', $_POST)) {
    DailyRentedCars();
}

if (array_key_exists('WeeklyRentedCars', $_POST)) {
    WeeklyRentedCars();
}


function CustomerList() 
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rental_company";
    $conn = new mysqli($servername, $username, $password, $dbname);
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
}

function AvailableCars() 
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rental_company";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "select Vehical_Id,Type,Model,Year,Daily_Rate,Weekly_Rate,Is_Available from car
            where Is_Available = 1";
    $result = $conn -> query($sql);

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



}
function DailyRentedCars() 
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rental_company";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "select car.Vehical_Id,Type,Model,Year,Daily_Rate,Weekly_Rate,Is_Available,customer.ID_Number,customer.Last_Name,customer.Phone 
            from car
            inner join dailyrental
                on dailyrental.Vehical_Id = car.Vehical_Id
                    inner join customer
                        on customer.Id_Number = dailyrental.Id_Number
            where car.Is_Available = 0";
    $result = $conn -> query($sql);
    if($result)
    {
        echo "<br>Daily Rented Cars Results <br>";
        while($row = $result -> fetch_assoc())
        {
            echo "<br> | Vehical Id: " . $row["Vehical_Id"]. " | Type: " .$row["Type"]. " | Model: " .$row["Model"]." | Year: ".$row["Year"] ." | Daily Rate: $" .$row["Daily_Rate"]
            ." | Weekly Rate: $".$row["Weekly_Rate"] . " | Is Available: " .$row["Is_Available"] ."| **Customer Info, ID Number: ".$row["ID_Number"] ." | Last Name: ". $row["Last_Name"]
            ." | Phone: ".$row["Phone"] ."|<br>";
        }
    }
    else
    {
    echo "0 results";
    }

}


function WeeklyRentedCars() 
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rental_company";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "select car.Vehical_Id,Type,Model,Year,Daily_Rate,Weekly_Rate,Is_Available,customer.ID_Number,customer.Last_Name,customer.Phone 
            from car
            inner join weeklyrental
                on weeklyrental.Vehical_Id = car.Vehical_Id
                    inner join customer
                        on customer.Id_Number = weeklyrental.Id_Number
            where car.Is_Available = 0";
    $result = $conn -> query($sql);
    if($result)
    {
        echo "<br>Weekly Rented Cars Results <br>";
        while($row = $result -> fetch_assoc())
        {
            echo "<br> | Vehical Id: " . $row["Vehical_Id"]. " | Type: " .$row["Type"]. " | Model: " .$row["Model"]." | Year: ".$row["Year"] ." | Daily Rate: $" .$row["Daily_Rate"]
            ." | Weekly Rate: $".$row["Weekly_Rate"] . " | Is Available: " .$row["Is_Available"] ."| **Customer Info, ID Number: ".$row["ID_Number"] ." | Last Name: ". $row["Last_Name"]
            ." | Phone: ".$row["Phone"] ."|<br>";
        }
    }
    else
    {
    echo "0 results";
    }

}



?>

<form method="post">
<input type="submit" name="CustomerList"
        class="button" value="Customer List" />
 
<input type="submit" name="AvailableCars"
        class="button" value="Available Cars" />

<input type="submit" name="DailyRentedCars"
        class="button" value="Daily Rented Cars" />

<input type="submit" name="WeeklyRentedCars"
        class="button" value="Weekly Rented Cars" />


</form>