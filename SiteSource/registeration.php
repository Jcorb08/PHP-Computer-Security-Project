<!DOCTYPE html>
<!-- registration webpage 198735 -->
<?php
    include '../src/Functions.php';
    headerCSP();
    session_start();
    tokenCheck();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pizza Restaurant</title>
    </head>
    <body>
        <h1>Pizza Restaurant</h1>
        <?php
        // put your code here
            include "../src/registerationCheck.php";
        ?>
    </body>
</html>
