<?php
//updatepasswordcheck 198735
include_once '../src/Functions.php';
require_once '../src/vendor/autoload.php';
$google2fa = new PragmaRX\Google2FAQRCode\Google2FA();
checkreCaptcha();
//server and db connectioon values
list($conn,$table) = getConnection(3);
// values come from user entry in webform
$name = filterData($_POST['txtName']);
$email = filterData($_POST['txtEmail']);
$password = filterData($_POST['txtPass']);
$newpassword = password_hash(filterData($_POST['txtNewPass']), PASSWORD_BCRYPT);
$secret = filterData($_POST['txtSecret']);

//query
$passQuery = "SELECT customerEmailAddress, customerPass, secretKey FROM " . $table;
$result = $conn->query($passQuery);
//flag type variable - boolean to see if we find user
$userFound = 0;
if ($result->num_rows > 0) {

    while ($userRow = $result->fetch_assoc()) {

        if ($userRow['customerEmailAddress'] == $email) {
            $userFound = 1;
            // verifies password is same as hash
            if (password_verify($password, $userRow['customerPass'])) {
                
                if ($google2fa->verifyKey($userRow['secretKey'],$secret)){
                
                    $result->close();
                    $query = "UPDATE " . $table . " SET customerPass =? "
                     . "WHERE customerName =? AND customerEmailAddress =?";

                    if (!$statement = $conn->prepare($query)){

                        echo "prepare not successful";
                        echo "</br> " . $conn->errno . " : " . $conn->error;
                    }
                    if(!$statement->bind_param("sss", $newpassword, $name, $email)){
                        echo "bind para not successful";
                        echo "</br> " . $statement->errno . " : " . $statement->error;
                    }
                    if(!$statement->execute()){
                        echo "execution not successful";
                        echo "</br> " . $statement->errno . " : " . $statement->error;
                    } else {
                        echo "Update Password Successful";
                    }
                    $statement->close();              
                } else {
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