<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$username = $_POST['txtUser'];
$password = $_POST['txtPass'];

if ($username == 'joe')
{
    if ($password == 'pass')
    {
        echo "Hi " . $username . "";
        echo "</br> welcome to this terrible website";
    }
    else 
    {
        echo "Wrong Password!";
    }
}
else
{
    echo "Sorry you are not a registered user";
}


