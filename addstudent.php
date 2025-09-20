<?php


error_reporting(0);
session_start();
include("config.php");
$response = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // إنشاء معرف فريد
    $uniqueId = "S" . time();

    // جمع البيانات من POST
    $full_name_arabic = htmlspecialchars(trim($_POST["full_name_arabic"]));
    $full_name_english = htmlspecialchars(trim($_POST["full_name_english"]));
    $dobString = htmlspecialchars(trim($_POST["date_of_birth"]));
    $timestamp = strtotime($dobString);
    $dob = date('Y-m-d', $timestamp);
    $gender = htmlspecialchars(trim($_POST["gender"]));
    $current_country = htmlspecialchars(trim($_POST["current_country"]));
    $current_city = htmlspecialchars(trim($_POST["current_city"]));
    $address = htmlspecialchars(trim($_POST["address"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $whatsapp_number = htmlspecialchars(trim($_POST["whatsapp_number"]));
    $education_level = htmlspecialchars(trim($_POST["education_level"]));
    $english_experience = htmlspecialchars(trim($_POST["english_experience"]));
    $preferred_study_time = htmlspecialchars(trim($_POST["preferred_study_time"]));
    $zoom_availability = htmlspecialchars(trim($_POST["zoom_availability"]));
    $payment_method = htmlspecialchars(trim($_POST["payment_method"]));

    // التحقق من القيم المدخلة

    // التحقق من الاسم العربي
    if (!preg_match("/^[\p{Arabic}\s]+$/u", $full_name_arabic) || mb_strlen($full_name_arabic) > 100) {
        die("Invalid Arabic name!");
    }

    // التحقق من الاسم الإنجليزي
    if (!preg_match("/^[a-zA-Z\s]+$/", $full_name_english) || strlen($full_name_english) > 100) {
        die("Invalid English name!");
    }

    // التحقق من تاريخ الميلاد
    $currentDate = date('Y-m-d');
    if ($dob > $currentDate || (date('Y') - date('Y', strtotime($dob))) < 13) {
        die("Invalid date of birth!");
    }

    // التحقق من الجنس
    $allowedGenders = ["male", "female"];
    if (!in_array($gender, $allowedGenders)) {
        die("Invalid gender!");
    }

    // التحقق من الدولة والمدينة
    if (!preg_match("/^[\p{L}\s]+$/u", $current_country) || mb_strlen($current_country) > 50) {
        die("Invalid country name!");
    }
    if (!preg_match("/^[\p{L}\s]+$/u", $current_city) || mb_strlen($current_city) > 50) {
        die("Invalid city name!");
    }

    // التحقق من العنوان
    if (strlen($address) > 255) {
        die("Invalid address!");
    }

    // التحقق من البريد الإلكتروني
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email address!");
    }

    if (!preg_match("/^\+?\s?\d{1,4}(\s?\d{1,4}){2,4}$/", $whatsapp_number)) {
        die("Invalid WhatsApp number!");
    }
    
    // التحقق من مستوى التعليم
    $allowedEducationLevels = ["Secondary", "University", "master", "phd"];
    if (!in_array($education_level, $allowedEducationLevels)) {
        die("Invalid education level!");
    }

    // التحقق من مستوى اللغة الإنجليزية
    $allowedEnglishLevels = ["Yes", "No", ];
    if (!in_array($english_experience, $allowedEnglishLevels)) {
        die("Invalid English experience level!");
    }

    // التحقق من الوقت المفضل للدراسة
  

    // التحقق من توفر Zoom
    $allowedZoomAvailability = ["Yes", "No"];
    if (!in_array($zoom_availability, $allowedZoomAvailability)) {
        die("Invalid Zoom availability!");
    }

    // التحقق من طريقة الدفع
   
    // التحقق من وجود البريد الإلكتروني
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        die('Error preparing email check statement: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo 'Email already exists!';
    } else {
        // إدخال تفاصيل الطالب
        $addStudentDetailQuery = "INSERT INTO `students` (`s_no`, `id`, `full_name_arabic`, `full_name_english`, `gender`, `dob`, `current_country`, `current_city`, `address`, `email`, `whatsapp_number`, `education_level`, `english_experience`,`preferred_study_time`,`zoom_availability`,`payment_method`) 
        VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $addStudentDetailQuery);
        if ($stmt === false) {
            die('Error preparing student insert statement: ' . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "sssssssssssssss", $uniqueId, $full_name_arabic, $full_name_english, $gender, $dob, $current_country, $current_city, $address, $email, $whatsapp_number, $education_level, $english_experience, $preferred_study_time, $zoom_availability, $payment_method);
       
        $executeResult = mysqli_stmt_execute($stmt);
        if ($executeResult === false) {
            die('Error executing student insert statement: ' . mysqli_error($conn));
        }

        // إدخال بيانات المستخدم
        $password = str_replace("-", "", $dob);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $addUserDetailQuery = "INSERT INTO `users` (`s_no`, `id`, `email`, `password_hash`, `role`, `theme`) VALUES (NULL, ?, ?, ?, 'student', 'light')";

        $stmt2 = mysqli_prepare($conn, $addUserDetailQuery);
        if ($stmt2 === false) {
            die('Error preparing user insert statement: ' . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt2, "sss", $uniqueId, $email, $passwordHash);

        $executeResult2 = mysqli_stmt_execute($stmt2);
        if ($executeResult2 === false) {
            die('Error executing user insert statement: ' . mysqli_error($conn));
        }

        if (mysqli_stmt_affected_rows($stmt) > 0 && mysqli_stmt_affected_rows($stmt2) > 0) {
            $response = 'success';

            // تخزين المتغيرات في الجلسة
            $_SESSION['uid'] = $uniqueId;

            header("Location: student_panel/index.php");
            
            exit();
         
        } else {
            $response = 'Error - Unable to add user';
        }
    }
} else {
    $response = "Invalid request!";
}

echo $response;



?>
