<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 10px;
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            font-weight: 600;
            border-radius: 10px 10px 0 0;
        }
        .btn {
            font-size: 0.9rem;
        }
        table {
            font-size: 0.85rem;
            max-width: 100%;
            margin: auto;
        }
        .card-title {
            color: white;
        }
        .search-bar {
            margin-bottom: 1rem;
        }
        @media (min-width: 992px) {
            .table {
                width: 80%;
            }
        }
        @media (max-width: 768px) {
            .table thead {
                display: none;
            }
            .table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #ddd;
                border-radius: 5px;
                background-color: #fff;
                padding: 10px;
            }
            .table tbody tr td {
                display: flex;
                justify-content: space-between;
                padding: 0.5rem;
                border-bottom: 1px dashed #ddd;
            }
            .table tbody tr td:last-child {
                border-bottom: none;
            }
            .table tbody tr td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #007bff;
                margin-right: 10px;
            }
            .btn {
                font-size: 0.75rem;
                padding: 0.3rem 0.5rem;
            }
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            border-radius: 10px;
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .alert-success{
            display: none;

        }
        .modal-body {
        margin-top: 15px;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    .form-control {
        border-radius: 5px;
        padding: 10px;
        width: 100%;
    }
    .btn {
        font-size: 1rem;
    }


    
/* زر إغلاق النافذة */
.close {
  font-size: 24px;
  font-weight: bold;
  color: #aaa;
  cursor: pointer;
}

.close:hover {
  color: black;
}

/* تنسيق جسم النافذة */
.modal-body {
  padding-top: 10px;
}

/* تنسيق الحقول والنماذج */
.form-group {
  margin-bottom: 15px;
}

label {
  font-size: 16px;
  display: block;
  margin-bottom: 5px;
}

input, select {
  width: 100%;
  padding: 10px;
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

input[type="date"] {
  padding: 5px;
}

button {
  width: 100%;
  padding: 12px;
  background-color: #28a745;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
}

button:hover {
  background-color: #218838;
}

.fade{
    position: absloute;
     top: 0;
    left: 0;
    z-index: 104000;

background: none;
}
.modal-backdrop{
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1040;
    width: 100vw;
    height: 100vh;
}

/* تفاعل مع الشاشات الصغيرة */
@media (max-width: 600px) {
  .modal-content {
    padding: 15px;
    width: 82%;
  }

  .modal-header h5 {
    font-size: 18px;
  }

  .close {
    font-size: 20px;
  }

  button {
    font-size: 14px;
  }
}

/* تفاعل مع الشاشات الكبيرة */
@media (min-width: 1200px) {
  .modal-content {
    max-width: 1000px;
  }
}
    </style>




<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
          

            <h4 class="card-title mb-0">إدارة الطلاب</h4>
        </div>
        <div class="card-body">
            <div class="search-bar">
                <input type="text" id="searchInput" class="form-control" placeholder="ابحث عن طالب...">
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th class="text-center">#</th>
                        <th>ID</th>
                        <th>الاسم</th>
                        <th>name</th>
                        <th>العنوان</th>
                        <th>whtsapp</th>
                        
                        <th>تاريخ الميلاد</th>
                       
                        <th>الدفع</th>
                        <th>الوقت المفضل</th>
                        <th>Zoom</th>
                        <th>التعليم</th>
                        <th>email</th>
                        <th class="text-center">عمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                   include 'config.php'; 

                    // جلب البيانات
                    $sql = "SELECT * FROM students";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $counter = 1;
                  
                        while ($row = $result->fetch_assoc()) {
                            $id=$row['s_no'];
                            $Did=$row['id'];
                            echo "<tr>
                            <td class='text-center' data-label='#'>{$counter}</td>
                            <td data-label='ID'>{$row['id']}</td>
                            <td data-label='الاسم'>{$row['full_name_arabic']}</td>
                            <td data-label='name #'>{$row['full_name_english']}</td>
                            <td data-label='العنوان'>{$row['address']}</td>
                            <td data-label='whtsapp'>{$row['whatsapp_number']}</td>
                            <td data-label='تاريخ الميلاد'>{$row['dob']}</td>
                            <td data-label='الدفع'>{$row['payment_method']}</td>
                            <td data-label='الوقت المفضل'>{$row['preferred_study_time']}</td>
                            <td data-label='Zoom'>{$row['zoom_availability']}</td>
                            <td data-label='التعليم'>{$row['education_level']}</td>
                            <td data-label='المستوى'>{$row['email']}</td>
                            <td class='text-center' data-label='عمليات'>
                                <button class='btn btn-sm btn-info view-btn' data-id='$id'>عرض</button>
                             <button class='btn btn-sm btn-warning edit-btn'  onclick=\"editStudent(`".$id."`)\">تعديل</button>
                   <a class='btn btn-sm btn-danger'data-id='$id' onclick=\"deleteStudentWithId(`".$Did."`)\">حذف</a>


                            </td>
                        </tr>";
                            $counter++;
                        }
                    } else {
                        echo "<tr><td colspan='15' class='text-center'>لا توجد بيانات</td></tr>";
                    }

                    $conn->close();
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- alert to delete teacher  -->
<div class="modal fade" id="delete-confirmation-modal" tabindex="-19" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <strong>Do you really want to delete Student?</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="deleteTeacherWithIdSeted()">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- نافذة تعديل بيانات الطالب -->
<div id="editStudentModal" class="modal">
    <div class="modal-content">
        <div class="modal-header" dir="rtl">
            <h5>تعديل بيانات الطالب</h5>
            <span class="close" onclick="closeEditModal()">&times;</span>
        </div>
        <div class="modal-body">
        <form id="editStudentForm" dir="rtl" method="post" action="update_student.php">
    <div class="form-group">
        <label for="full_name_arabic">الاسم (باللغة العربية)</label>
        <input type="text" id="full_name_arabic" name="full_name_arabic" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="full_name_english">الاسم (باللغة الإنجليزية)</label>
        <input type="text" id="full_name_english" name="full_name_english" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="date_of_birth">تاريخ الميلاد</label>
        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="gender">الجنس</label>
        <input type="text" id="gender" name="gender" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="current_country">الدولة الحالية</label>
        <input type="text" id="current_country" name="current_country" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="current_city">المدينة الحالية</label>
        <input type="text" id="current_city" name="current_city" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="address">العنوان</label>
        <input type="text" id="address" name="address" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">البريد الإلكتروني</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="whatsapp_number">رقم الواتساب</label>
        <input type="text" id="whatsapp_number" name="whatsapp_number" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="education_level">المستوى التعليمي</label>
        <input type="text" id="education_level" name="education_level" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="english_experience">خبرة اللغة الإنجليزية</label>
        <input type="text" id="english_experience" name="english_experience" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="preferred_study_time">الوقت المفضل للدراسة</label>
        <input type="text" id="preferred_study_time" name="preferred_study_time" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="zoom_availability">التوافر على زووم</label>
        <input type="text" id="zoom_availability" name="zoom_availability" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="payment_method">طريقة الدفع</label>
        <input type="text" id="payment_method" name="payment_method" class="form-control" required>
    </div>
    <input type="number" id="studentId" name="studentId">
    <button type="submit" class="btn-success" name="submit">تعديل البيانات</button>
</form>

        </div>
    </div>
</div>


<!-- نافذة  تفاصيل الطالب -->


<div id="studentModal" class="modal">
    <div class="modal-content">
        <div class="modal-header" dir="rtl">
            <h5>تفاصيل الطالب</h5>
            <span class="close"  onclick="closeStudentModal()">&times;</span>
        </div>
        <div class="modal-body"  dir="rtl">
            <p id="studentDetails">تحميل البيانات...</p>
        </div>
    </div>
</div>

<script>
  var editing = false;
var editingStudentId = "";
var preEditedData;
var postEditedData;
let tmodal = document.getElementById('editStudentModal');

function editStudent(sid) {
    editStudentById(sid);
    tmodal.style.display = 'block';
}

function closeEditModal() {
    tmodal.style.display = 'none';
}

window.addEventListener('click', event => {
    if (event.target === tmodal) {
        tmodal.style.display = 'none';
    }
});

function editStudentById(sid) {
    editing = true;
    editingStudentId = sid;

    // استدعاء بيانات الطالب
    fetch('getStudent.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + encodeURIComponent(sid),
    })
        .then(response => response.json())
        .then(data => {
            console.log("Received data:", data); // فحص البيانات المسترجعة

            // التأكد من البيانات المُسترجعة قبل تعبئة الحقول
            if (!data || Object.keys(data).length === 0) {
                alert("Error: No data found for the selected student.");
                return;
            }

            // تعبئة الحقول بالبيانات المسترجعة
            document.getElementById("full_name_arabic").value = data['full_name_arabic'] || '';
            document.getElementById("full_name_english").value = data['full_name_english'] || '';
            document.getElementById("date_of_birth").value = data['dob'] || '';
            document.getElementById("gender").value = data['gender'] || '';
            document.getElementById("current_country").value = data['current_country'] || '';
            document.getElementById("current_city").value = data['current_city'] || '';
            document.getElementById("address").value = data['address'] || '';
            document.getElementById("email").value = data['email'] || '';
            document.getElementById("whatsapp_number").value = data['whatsapp_number'] || '';
            document.getElementById("education_level").value = data['education_level'] || '';
            document.getElementById("english_experience").value = data['english_experience'] || '';
            document.getElementById("preferred_study_time").value = data['preferred_study_time'] || '';
            document.getElementById("zoom_availability").value = data['zoom_availability'] || '';
            document.getElementById("payment_method").value = data['payment_method'] || '';
            document.getElementById("studentId").value = editingStudentId;
        })
        .catch(error => {
            console.error('Error fetching student data:', error);
            alert("Failed to fetch student data. Please try again.");
        });
}

document.getElementById("editStudentForm").addEventListener('submit', event => {
    event.preventDefault(); // منع الإرسال الافتراضي

    if (!editing) {
        alert("No student is being edited.");
        return;
    }

    let formData = new FormData(document.getElementById("editStudentForm"));

    // فحص البيانات قبل الإرسال
    formData.forEach((value, key) => {
        console.log(key, value);
    });

    fetch("update_student.php", {
        method: 'POST',
        body: formData,
    })
        .then(response => response.text())
        .then(data => {
            let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
            let liveToast = document.getElementById("liveToast");

            if (data.includes("success")) {
                liveToast.style.backgroundColor = "#BBF7D0";
                liveToast.style.color = 'green';
                document.getElementById('toast-alert-message').innerHTML = "Details edited successfully";
                cleanForm();
            } else {
                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data;
            }
            myToast.show();
            tmodal.style.display = 'none';
           
            setTimeout(function() {
            location.reload(); // إعادة تحميل الصفحة لتحديث البيانات
        }, 2000);


        
        })
        .catch(error => {
            console.error("Error updating student data:", error);
            alert("Failed to update student data. Please try again.");
        });
      
  
}, false);


function cleanForm() {
    document.getElementById("editStudentForm").reset();
    editing = false;
    editingStudentId = "";
}

document.getElementById('searchInput').addEventListener('keyup', function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        let match = false;

        cells.forEach(cell => {
            if (cell.textContent.toLowerCase().includes(filter)) {
                match = true;
            }
        });

        row.style.display = match ? '' : 'none';
    });
});

    
    

    const modal = document.getElementById('studentModal');
    const modalContent = document.getElementById('studentDetails');
    const closeModal = document.querySelector('.close');

    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {
            const studentnum = this.getAttribute('data-id');
            modalContent.textContent = `جاري تحميل بيانات الطالب ID: ${studentnum}`;

            // طلب البيانات باستخدام AJAX
            fetch(`get_student_details.php?s_num=${studentnum}`)
                .then(response => response.json())
                .then(data => {
                    modalContent.innerHTML = `
                        <p >الاسم: ${data.full_name_arabic}</p>
                          <p>name: ${data.full_name_english}</p>
                        <p>العنوان: ${data.address}</p>
                        <p>تاريخ ميلاد: ${data.dob}</p>
                        <p>الدفع: ${data.payment_method}</p>
                        <p>المستوى: ${data.education_level}</p>
                        <p>البريد الإلكتروني: ${data.email}</p>
                          <p>النوع: ${data.gender}</p>
                            <p>درس من قبل: ${data.english_experience}</p> 
                              <p>المدينة: ${data.current_city}</p>
                               <p>الدولة: ${data.current_country}</p>
                                <p>استخدام زوم: ${data.zoom_availability}</p>
                                  <p>الوقت المفضل: ${data.preferred_study_time}</p>
                                  

                    `;
                })
                .catch(error => {
                    modalContent.textContent = 'فشل في تحميل البيانات.';
                });

            modal.style.display = 'block';
        });
     
    });

   function closeStudentModal(){
    
        modal.style.display = 'none';

   }

    

    window.addEventListener('click', event => {
        if (event.target === modal) {
            modal.style.display = 'none';
          
        }
    });



// remove teacher start
(() => {
    'use strict';

    const removeTeacherBtn = document.getElementById('remove-student-btn');
    const removeTeacherForm = document.querySelector('#remove-student-form');

    removeTeacherBtn.addEventListener('click', event => {
        validateGeneralForm();

        event.preventDefault();
        event.stopPropagation();
    }, false);

    function validateGeneralForm() {
        if (removeTeacherForm.checkValidity()) {

            var id = document.getElementById('student-id').value;


            let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
            let liveToast = document.getElementById("liveToast");

            fetch('../assets/removeStudent.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded', // or 'application/json' depending on your needs
                },
                body: 'studentid=' + encodeURIComponent(id),
            })
                .then(response => response.text())
                .then(data => {
                    if (data.indexOf("success") != -1) {
                        liveToast.style.backgroundColor = "#BBF7D0";
                        liveToast.style.color = 'green';
                        location.reload(); 
                        alert("تم حذف الطالب بنجاح!");
                      

                    } else {
                        liveToast.style.backgroundColor = "#FECDD3";
                        liveToast.style.color = 'red';
                        alert("حدث خطأ أثناء عملية الحذف.");
                    }

                    document.getElementById("student-id").value = "";
                    $(".removeTeacherModal").modal("hide");
                    myToast.show();

                })
                .catch(error => {
                    console.error('Error:', error);
                });

        } else {
            removeTeacherForm.classList.add('was-validated');
        }
    }
})();
// remove teacher end
// remove teacher with id used by show teachers 

var student_id = "";
function deleteStudentWithId(id) {

    student_id = id;
    $('#delete-confirmation-modal').modal('show');

}
function deleteTeacherWithIdSeted() {
    let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
    let liveToast = document.getElementById("liveToast");

    fetch('delete_student.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // or 'application/json' depending on your needs
        },
        body: 'studentid=' + encodeURIComponent(student_id),
    })
        .then(response => response.text())
        .then(data => {
            if (data.indexOf("success") != -1) {
                liveToast.style.backgroundColor = "#BBF7D0";
                liveToast.style.color = 'green';
                alert("تم حذف الطالب بنجاح!");
            } else {
                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                alert("حدث خطأ أثناء عملية الحذف.");
            }

            $('#delete-confirmation-modal').modal('hide');
            showStudents();
            myToast.show();

        })
        .catch(error => {
            console.error('Error:', error);
        });
}
//end of remove teacher with id used by show teachers 
//show teachers 

</script>
