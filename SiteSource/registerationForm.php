<?php
// registeration form
// 198735

include_once "../src/Functions.php";
session_start();

echo "<form action='registeration.php' method='POST'>";
echo "<pre>"; 
echo "Name:         ";
echo "    <input name='txtName' type='text'/>";
echo "<br/>";

echo "Email:        ";
echo "    <input name='txtEmail' type='email'/>";
echo "<br/>";

echo "Password:     ";
echo "    <input name='txtPassword' type='password'/>";
echo "<br/>";

echo "Date of Birth:";
echo "    <input name='txtDOB' type='date'/>";
echo "<br/>";

echo "Address:      ";
echo "    <input name='txtAddress' type='text'/>";
echo "<br/>";

echo "<br/><div class='g-recaptcha' data-sitekey='6LdDDQUaAAAAAHnV7gyHJ_3LCiTzRbe56XDEU8E6'></div>";
echo "<input type='hidden' name='token' value='<?php echo tokenGen(); ?>'/>";

echo "<br/>"; 
echo "<input type='submit' name='register' value='Register'>  ";
echo "<input type='reset'>";

echo "</pre>";
echo "</form>";
    




