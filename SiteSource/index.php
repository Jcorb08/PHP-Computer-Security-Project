<!DOCTYPE html>
<!<!-- index 198735 -->
<?php
    include '../src/Functions.php';
    headerCSP();
?>
<html>
    <head>
        <meta charset="UTF-8">            
        <title>Pizza Restaurant</title>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body>
        <h1>Pizza Restaurant</h1>
        <?php                                
        
            if (isset($_POST['form1'])){
                include '../src/loginForm.php';
            }
            else if (isset($_POST['form2'])){
                include '../src/registerationForm.php';
            }
            else if (isset($_POST['form3'])){
                include '../src/updatePasswordForm.php';
            }
            else {
                
                echo "<form method = 'post'>";              
                echo "<input type='submit' name='form1' class='button' value='Login'/>  ";
                echo "<input type='submit' name='form2' class='button' value='Register'/> ";
                echo "<input type='submit' name='form3' class='button' value='Update Password'/>";
                echo "</form>";                                
            }          
            
        ?>
    </body>
</html>
