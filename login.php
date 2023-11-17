<?php
$uname = $_POST['uname'];
$upswd = $_POST['upswd'];

if (!empty($uname) || !empty($upswd)) {
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "tamilhacks";

    // Create connection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
    } else {
        $SELECT = "SELECT uname1, upswd1 FROM register WHERE uname1 = ? AND upswd1 = ?";
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("ss", $uname, $upswd);
        $stmt->execute();
        $stmt->bind_result($uname, $upswd);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        // Checking if the user exists with the provided credentials
        if ($rnum == 1) {
            // Redirect to another page upon successful login
            header("Location: welcome.php"); // Replace "welcome.php" with your desired page
            exit();
        } else {
            echo "Invalid username or password";
        }

        $stmt->close();
        $conn->close();
    }
} else {
    echo "Username and password are required";
}
?>

