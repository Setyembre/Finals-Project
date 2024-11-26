<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 3</title>
</head>
<body> 
<?php
 echo file_get_contents('Text.txt');
 echo "<br>";
 echo file_put_contents('Text.txt','Hi, this is a test file and we are from group 5 from BSIT3F');
 echo '<br>';
 echo file_exists('Text.txt');
 echo '<br>';
 print_r(file('Text.txt',));
?>


</body>
</html>