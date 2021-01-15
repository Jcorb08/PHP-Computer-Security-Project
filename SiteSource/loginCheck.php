<?php
// login check 198735
include_once '../src/Functions.php';
require_once '../src/vendor/autoload.php';
$google2fa = new PragmaRX\Google2FAQRCode\Google2FA();
checkreCaptcha();

//server and db connectioon values
list($conn,$table) = getConnection(2);

// values come from user entry in webform
$email = filterData($_POST['txtEmail']);
$password = filterData($_POST['txtPass']);
$secret = filterData($_POST['txtSecret']);

//query
$query = "SELECT customerEmailAddress, customerPass, secretKey FROM " . $table;
$result = $conn->query($query);

//flag type variable - boolean to see if we find user
$userFound = 0;

if ($result->num_rows > 0) {

    while ($userRow = $result->fetch_assoc()) {

        if ($userRow['customerEmailAddress'] == $email) {
            $userFound = 1;
            // verifies password is same as hash
            if (password_verify($password, $userRow['customerPass'])) {
                
                if ($google2fa->verifyKey($userRow['secretKey'],$secret)){
                    echo "Hi " . $username . "!";
                    echo "<br/> Welcome to our website!";
                }
                else {
                    echo "Wrong PIN";
                }                
            } else {                
                echo "Wrong password";
            }
        }
    }
}

if ($userFound == 0) {
    echo "This user was not found in our Database";
}
