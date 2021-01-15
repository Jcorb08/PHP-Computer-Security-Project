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

// values come from user entry in webform
$username = $_POST['txtUser'];
$password = $_POST['txtPass'];

//query
$userQuery = "SELECT * FROM SystemUser";
$userResult = $connect->query($userQuery);

//flag type variable - boolean to see if we find user
$userFound = 0;

if ($userResult->num_rows > 0){
    
    while($userRow = $userResult->fetch_assoc()){
        
        if($userRow['Username'] == $username){
            
            $userFound = 1;
            
            if($userRow['Password'] == $password){
                
                echo "Hi " .$username. "!";
                echo "<br/> Welcome to our website!";
            }
            else{
                
                echo "Wrong password";
            }          
        }
    }
}

if ($userFound == 0){
    
    echo "This user was not found in our Database";
}
