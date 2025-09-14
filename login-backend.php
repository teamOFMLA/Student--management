<?php
error_reporting(0);
session_start();
$response = array();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(404);
    die(json_encode(['status' => 'error', 'message' => 'Invalid request method']));
}

if (!isset($_POST['email']) || !isset($_POST['password'])) {
    die(json_encode(['status' => 'error', 'message' => 'Both fields are required']));
}

include("assets/config.php");

if (!$conn) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection error']));
}

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$sql = "SELECT id, role, password_hash FROM users WHERE email=?";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die(json_encode(['status' => 'error', 'message' => 'Error preparing statement']));
}

mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if ($row ) {
    $_SESSION['uid'] = $row['id'];
    $response = ['status' => 'success', 'role' => $row['role']];
} else {
    $response = ['status' => 'error', 'message' => 'Invalid email or password!'];
}

mysqli_stmt_close($stmt);
echo json_encode($response);
?>
