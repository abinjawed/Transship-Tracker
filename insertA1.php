<?php
header( "refresh:1;url=zoneA1.html" );
$todaysdate = $_POST['todaysdate'];
$containerid = $_POST['containerid'];
$plusorminus = $_POST['plusorminus'];

//form validator to ensure fields are not empty
if (!empty($todaysdate) || !empty($containerid) || !empty($plusorminus)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "estimate";

//establish a connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if (mysqli_connect_error()) {
         die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
        }  else {
        $INSERT = "INSERT Into zoneA1 (todaysdate, containerid, plusorminus) values (?, ?, ?)";

//prepare statement
    $stmt = $conn->prepare($INSERT);
    $stmt->bind_param("ssi", $todaysdate, $containerid, $plusorminus);
    $stmt->execute();
    echo "New record added";
    //echo '<p><a href="javascript:history.go ( -1); Location.reload ()" title="Return to the previous page">&laquo; Go back</a></p>';
    exit;

    }
    $stmt->close();
    $conn->close();

} else {
  echo "Please fill out all fields";
  die();
}

?>
