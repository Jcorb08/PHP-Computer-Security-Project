<?php
//registerationCheck 198735
include_once '../src/Functions.php';
require_once '../src/vendor/autoload.php';
$google2fa = new PragmaRX\Google2FAQRCode\Google2FA();
checkreCaptcha();

list($conn,$table) = getConnection(1);

//Values from form
$name= filterData($_POST['txtName']);
$email = filterData($_POST['txtEmail']); 
$dob = filterData($_POST['txtDOB']);
$address = filterData($_POST['txtAddress']);
//hashes and salts password with automatic random salt using default php crypt -> blowfish
$password = password_hash(filterData($_POST['txtPassword']), PASSWORD_BCRYPT); 

$key = $google2fa->generateSecretKey();

//  INSERT query   , check hash variable in the Values statement 
$query = "INSERT INTO ". $table 
        . " (customerName, customerPass, customerEmailAddress, dateOfBirth, Address, secretKey) "
        . "VALUES(?,?,?,?,?,?)";

if (!$statement = $conn->prepare($query)){
    
    echo "prepare not successful";
    die("</br> " . $conn->errno . " : " . $conn->error);

}
if(!$statement->bind_param("ssssss", $name, $password, $email, $dob, $address, $key)){
    echo "bind para not successful";
    die("</br> " . $statement->errno . " : " . $statement->error);

}
if(!$statement->execute()){
    echo "execution not successful";
    die("</br> " . $statement->errno . " : " . $statement->error);
}
$statement->close();
echo "Successful! Scan QRCode for two factor authentication: <br/>";
$Url = $google2fa->getQRCodeInline(
       'Computer Security Pizza',
        $email,
        $key           
);
echo $Url;
    



