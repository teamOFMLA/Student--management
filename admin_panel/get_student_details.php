<?php
include 'config.php';

// التحقق من وجود ID الطالب في الرابط
if (isset($_GET['s_num'])) {
    $studentnum = $_GET['s_num'];
    
    // استعلام لاسترجاع بيانات الطالب بناءً على ID
    $sql = "SELECT * FROM students WHERE s_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentnum);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // إذا كانت هناك بيانات للطالب
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        echo json_encode($student); // إرجاع البيانات بتنسيق JSON
    } else {
        echo json_encode(["status" => "error", "message" => "Student not found"]);
    }
    
    $stmt->close();
} else {
    $conn->close();
    echo json_encode(["status" => "error", "message" => "Student ID not provided"]);
}


?>
