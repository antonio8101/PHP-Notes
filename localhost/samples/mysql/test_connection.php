<html lang="en">
<head>
	<title>Test PHP</title>
</head>
<body>
    <h3>PHP Test Page</h3>
    <?php echo "Hello PHP"; ?>
<?php
// Create connection
$conn = new mysqli('localhost', 'root', 'root');

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
</body>
</html>

