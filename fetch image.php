<html>
<body>
<?php
$username = "root";
$password = "PIYUSH";
$database = "site";
$mysqli = new mysqli("localhost", $username, $password, $database);

$query = "SELECT * FROM users";
echo "<b> <center>Database Output</center> </b> <br> <br>";

if ($result = $mysqli->query($query)) {

    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $username = $row["username"];
        $password = $row["password"];
        $created_at = $row["created_at"];

        echo $id.'<br />';
        echo $username.'<br />';
        echo $password.'<br />';
        echo $created_at.'<br /><hr>';
    }

/*freeresultset*/
$result->free();
}
?>
</body>
</html>