

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self'; style-src 'self';">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>School Management</title>
    <link rel="icon" type="image/x-icon" href="../images/1.png">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> -->


    <link rel="stylesheet" href="css/bootstrap.css">
   
    

    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js"></script>
    <link rel="stylesheet" href="admin_panel/style.css">

    <link rel="stylesheet" href="admin_panel/css/date-picker.css">
   
</head>

<body>
    
<!-- add new student model -->


<div class="modal" style="z-index: 2000;" id="addTeacherModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" dir="rtl">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">البيانات الشخصية</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="personal-info-form" novalidate>
                <div class="modal-body">
                    <div class="container my-3">
                        <div class="mb-3">
                            <label for="full_name_arabic" class="form-label" >الإسم الرباعي بالعربية</label>
                            <input type="text" class="form-control" placeholder="full name in arabic" id="full_name_arabic" name="full_name_arabic" required>
                            <div class="invalid-feedback">
                                مطلوب!
                            </div>
                        </div>
                         <div class="mb-3">
                            <label for="full_name_english" class="form-label">الاسم الرباعي بالإنجليزية</label>
                            <input type="text" class="form-control" id="full_name_english" name="full_name_english" required  placeholder="full name in English" >
                            <div class="invalid-feedback">
                                مطلوب!
                            </div>
                        </div>

                      
                      
                        
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="date_of_birth" class="form-label">تاريخ الميلاد     Birth Date</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                                    <div class="invalid-feedback">
                                        مطلوب!
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="gender" class="form-label">النوع  Gander</label>
                                    <select class="form-select" id="gender" name="gender" style="width:100%;" required   placeholder="YY-MM-DD">
                                        <option selected disabled value="">--حدد--</option>
                                        <option value="male">ذكر</option>
                                        <option value="female">أنثى</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        مطلوب!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="current_country" class="form-label">البلد الذي تعيش فيه حاليا</label>
                                    <input type="text" class="form-control" id="current_country" name="current_country" required   placeholder="Current home">
                                    <div class="invalid-feedback">
                                        مطلوب!
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="current_city" class="form-label">المحافظة التي تعيش فيها حاليا</label>
                                    <input type="text" class="form-control" id="current_city" name="current_city" required    placeholder="current city">
                                    <div class="invalid-feedback">
                                        مطلوب!
                                    </div>
                                </div>
                        
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">العنوان</label>
                            <input type="text" class="form-control" id="address" name="address" required   placeholder="Address">
                            <div class="invalid-feedback">
                                مطلوب!
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
              

                     
                    <a href="./login.php" class="btn"  style="color:red;    text-decoration: underline;     background-color: #7380ec;" >هل لديك حساب</a>
                    <button type="button" class="btn btn-primary" id="next-btn">
                        <div><span> التالي</span><i class='bx bxs-chevrons-left'></i></div>
                    </button>
                </div>
                
            </form>
        </div>
    </div>
</div>
<!-- personal information -->
<div class="modal" style="z-index: 2000;" id="personalInformationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  dir="rtl">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
             <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">البيانات الشخصية</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x'></i></button>
            </div>
           <form class="needs-validation" id="address-info-form" novalidate>
                <div class="modal-body">
                    <div class="container my-3">
                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الالكتروني الخاص بك</label>
                            <input type="email" class="form-control" id="email" name="email" required   placeholder="example@echo.com">
                            <div class="invalid-feedback">
                                مطلوب!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="whatsapp_number" class="form-label">رقم الواتساب</label>
                            <input type="tel" class="form-control" id="whatsapp_number" name="whatsapp_number" placeholder="+1 XXXXXXXXXX" required>
                            <div class="invalid-feedback">
                                مطلوب!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="education_level" class="form-label">التعليم Education</label>
                            <select class="form-select" id="education_level" name="education_level" style="width:100%;" required>
                                <option selected disabled value="">---حدد---</option>
                                <option value="Secondary">ثانوي</option>
                                <option value="University">جامعي</option>
                            </select>
                            <div class="invalid-feedback">
                                مطلوب!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="english_experience" class="form-label">هل درست اللغة الانجليزية من قبل؟</label>
                            <select class="form-select" id="english_experience" name="english_experience" style="width:100%;" required>
                                <option selected disabled value="">---حدد---</option>
                                <option value="Yes">نعم</option>
                                <option value="No">لا</option>
                            </select>
                            <div class="invalid-feedback">
                                مطلوب!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="preferred_study_time" class="form-label">وقت الدراسة المناسب لك</label>
                            <input type="text" class="form-control" id="preferred_study_time" name="preferred_study_time" placeholder="مثل: 10-12" required>
                            <div class="invalid-feedback">
                                مطلوب!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="zoom_availability" class="form-label">هل تستطيع استخدام تطبيق زوم؟</label>
                            <select class="form-select" id="zoom_availability" name="zoom_availability" style="width:100%;" required>
                                <option selected disabled value="">---حدد---</option>
                                <option value="Yes">نعم</option>
                                <option value="No">لا</option>
                            </select>
                            <div class="invalid-feedback">
                                مطلوب!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">طريقة الدفع</label>
                            <select class="form-select" id="payment_method" name="payment_method" style="width:100%;" required>
                                <option selected disabled value="">---حدد---</option>
                                <option value="cash">كاش</option>
                                <option value="payPal">بايبال</option>
                                <option value="hoalh">حوالة</option>
                            </select>
                            <div class="invalid-feedback">
                                مطلوب!
                            </div>
                        </div>
                      
                       

                       
                    </div>
                </div>
                 <div class="modal-footer">      

                 
                    <button type="button" class="btn btn-primary" id="personal-info-btn"  name="send_data">
                        <div><i class='bx bxs-check'></i><span>  تم  </span></div>
                    </button>

                    <button type="button" class="btn btn-secondary" id="back-btn">
                   <div><span> رجوع</span><i class='bx bxs-chevron-right'></i></div>
                </button>


                </div>
               
                
            </form>
        </div>
    </div>
    
</div>

<div id="liveToast" class="toast position-fixed" style="top: 20px; right: 20px; z-index: 9999; display: none;">
    <div class="toast-body" id="toast-alert-message"></div>
</div>




</body>


</html>