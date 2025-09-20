<?php
// إعدادات الاتصال بقاعدة البيانات
include 'config.php';

// قراءة بيانات POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['studentId'])) {
    $studentId = $_POST['studentId']; // الحصول على ID الطالب
    $full_name_arabic = $_POST['full_name_arabic'];
    $full_name_english = $_POST['full_name_english'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $current_country = $_POST['current_country'];
    $current_city = $_POST['current_city'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $whatsapp_number = $_POST['whatsapp_number'];
    $education_level = $_POST['education_level'];
    $english_experience = $_POST['english_experience'];
    $preferred_study_time = $_POST['preferred_study_time'];
    $zoom_availability = $_POST['zoom_availability'];
    $payment_method = $_POST['payment_method'];

    if ($studentId > 0) {
        $sql = "UPDATE students SET
                full_name_arabic = ?,
                full_name_english = ?,
                dob = ?,
                gender = ?,
                current_country = ?,
                current_city = ?,
                address = ?,
                email = ?,
                whatsapp_number = ?,
                education_level = ?,
                english_experience = ?,
                preferred_study_time = ?,
                zoom_availability = ?,
                payment_method = ?
                WHERE s_no = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssssssi", $full_name_arabic, $full_name_english, $date_of_birth, $gender,
                          $current_country, $current_city, $address, $email, $whatsapp_number, $education_level,
                          $english_experience, $preferred_study_time, $zoom_availability, $payment_method, $studentId);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "تم تحديث بيانات الطالب بنجاح"]);
        } else {
            echo json_encode(["status" => "error", "message" => "فشل في تحديث بيانات الطالب"]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "لم يتم تحديد الطالب"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "لم يتم استقبال البيانات بشكل صحيح"]);
}

$conn->close();
?>
