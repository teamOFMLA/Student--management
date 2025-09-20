<?php
include 'config.php';

if (isset($_POST['student_id'])) {
    $id = intval($_POST['student_id']);
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        echo "<p>الاسم (ع): {$student['full_name_arabic']}</p>";
        echo "<p>الاسم (E): {$student['full_name_english']}</p>";
        echo "<p>العنوان: {$student['address']}</p>";
        // أضف المزيد من الحقول حسب الحاجة...
    } else {
        echo "<p>الطالب غير موجود.</p>";
    }
} else {
    echo "<p>لم يتم توفير معرف الطالب.</p>";
}
?>
