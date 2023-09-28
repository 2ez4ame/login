<?php
session_start();
include('dbconn.php');

// Get the username and password from the POST data
$user = $_POST['username'];
$pass = $_POST['pass'];

// Use prepared statements to prevent SQL injection
$sql = "SELECT * FROM users WHERE username = ? AND userpass = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $user, $pass);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if a row with matching username and password exists
if ($row = mysqli_fetch_assoc($result)) {
    $_SESSION['login_user'] = $user;
    // Redirect to a welcome page or display a success message
    header("location: welcome.php");
    exit(); // Terminate script execution after redirection
} else {
    // If no matching user is found, display an error message and redirect back to the login page
    ?>
    <script type="text/javascript">alert("Incorrect username or password");</script>
    <?php
   // header("location: index.php");
    exit(); // Terminate script execution after redirection
}
?>
