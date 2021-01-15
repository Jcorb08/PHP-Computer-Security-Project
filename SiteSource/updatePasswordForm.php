<?php
//updatepasswordform 198735
include_once "../src/Functions.php";
session_start();

echo "<form action='updatePassword.php' method='POST'>";
echo "<pre>";
echo "Name:          ";
// name here corosponds to checks input
echo "<input name='txtName' type='text' />";
echo "<br/>Email:         ";
// name here corosponds to checks input
echo "<input name='txtEmail' type='email' />";
echo "<br/>Password:      ";
// name here corosponds to checks input
echo "<input name='txtPass' type='password' />";
echo "<br/>New Password:  ";
// name here corosponds to checks input
echo "<input name='txtNewPass' type='password' />";

echo "<br/>PIN:           ";
echo "<input name='txtSecret' type='text' />";

echo "<br/><div class='g-recaptcha' data-sitekey='6LdDDQUaAAAAAHnV7gyHJ_3LCiTzRbe56XDEU8E6'></div>";
echo "<input type='hidden' name='token' value='<?php echo tokenGen(); ?>'/>";

echo "<br/><input type='submit' name ='update' class='button'  value='Update Password'>  ";
echo "<input type='reset'>";
echo "</pre>";
echo "</form>";

