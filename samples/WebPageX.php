<?php
$message = "HelloWorld";
$cars = array("Saab", "Volvo", "BMW", "Toyota");
$peopleAge = array("Peter"=>32, "Stefan"=>20, "Claus"=>50);
$peopleProps = array("Peter"=>array(
        "age"=>32,"city"=>"Ulm"
    ), "Stefan"=>array( "age"=>20,
                        "city"=>"Ulm"), "Claus"=>array(
                        "age"=>50, "city"=>"Ulm"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $message; ?></title>
</head>
<body>
<?php echo $message; ?>
<br/>
<?php
var_dump($cars)
?>
<br/>
<?php
var_dump($peopleAge)
?>
<br/>
<pre>
<?php
print_r($peopleProps)
?>
</pre>
</body>
</html>