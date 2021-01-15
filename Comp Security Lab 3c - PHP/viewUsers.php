<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//server and db connectioon values
$servername = "localhost";
$rootUser = "root";
$db = "SecureLogin";
$password = "root";

//create connection
$connect = new mysqli($servername, $rootUser, $password, $db);
//check connection
if ($connect->connect_error){
    die("Connection Failed! -> " . $connect->connect_error);
}

// selecting from table not database
$userQuery = "SELECT * FROM SystemUser";
$userResult = $connect->query($userQuery);

echo "<h1> Registered Users details stored in text form </h1>";
echo "<h2> DON'T DO THIS IN REAL LIFE - HANGING CAR KEYS OUTSIDE YOUR HOUSE DOOR</h2>";

echo "<table border='1'>";

if ($userResult->num_rows > 0){
    
    echo "<tr>";
    echo "<td> ID </td>";
    echo "<td> Username </td>";
    echo "<td> Password </td>";
    echo "<td> Forename </td>";
    echo "<td> Surname </td>";
    echo "<td> Email </td>";
    echo "</tr>";
    
    while($userRow = $userResult->fetch_assoc()){
        echo "<tr>";
        echo "<td>" .$userRow['ID'] . "</td>";
        echo "<td>" .$userRow['Username'] . "</td>";
        echo "<td>" .$userRow['Password'] . "</td>";
        echo "<td>" .$userRow['Forename'] . "</td>";
        echo "<td>" .$userRow['Surname'] . "</td>";
        echo "<td>" .$userRow['Email'] . "</td>";
        echo "</tr>";
    }
}
echo "</table>";