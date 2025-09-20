<?php
// الاتصال بقاعدة البيانات
include 'config.php';

// التحقق من إرسال المعرف
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $studentId = intval($_POST['id']);

    // استعلام لجلب بيانات الطالب
    $sql = "SELECT * FROM students WHERE s_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentId);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $student = $result->fetch_assoc();
            // إرسال البيانات كـ JSON
            header('Content-Type: application/json');
            echo json_encode($student);
        } else {
            // إذا لم يتم العثور على الطالب
            echo json_encode(['error' => 'Student not found.']);
        }
    } else {
        // إذا فشل الاستعلام
        echo json_encode(['error' => 'Error executing query.']);
    }

    $stmt->close();
} else {
    // إذا لم يتم إرسال معرف الطالب
    echo json_encode(['error' => 'number not provid.']);
}

$conn->close();
?>
