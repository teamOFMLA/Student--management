<?php include('partials/_header.php') ?>

<!-- Sidebar -->
<?php include('partials/_sidebar.php') ?>
<input type="hidden" value="3" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include("partials/_navbar.php"); ?>

    <?php
    include('config.php');
    $message = ''; // لعرض الرسالة بعد عملية الإضافة

    if (isset($_POST['submit'])) {
        $question_text = $_POST['question_text'];
        $type = $_POST['type'];
        $correct_answer = $_POST['correct_answer'];

        // إضافة السؤال إلى قاعدة البيانات
        $query = "INSERT INTO questions (question_text, type, correct_answer) VALUES ('$question_text', '$type', '$correct_answer')";
        if (mysqli_query($conn, $query)) {
            $question_id = mysqli_insert_id($conn);

            // إضافة الإجابات إذا كانت اختيارات متعددة
            if ($type === 'multiple_choice' && isset($_POST['answers'])) {
                foreach ($_POST['answers'] as $answer) {
                    $is_correct = ($answer === $correct_answer) ? 1 : 0;
                    $query = "INSERT INTO answers (question_id, answer_text, is_correct) VALUES ('$question_id', '$answer', '$is_correct')";
                    mysqli_query($conn, $query);
                }
            }

            $message = "تم إضافة السؤال بنجاح!";
            $toast_class = "success-toast";
        } else {
            $message = "حدث خطأ أثناء إضافة السؤال. يرجى المحاولة مرة أخرى.";
            $toast_class = "error-toast";
        }
    }

    // جلب الأسئلة من قاعدة البيانات لعرضها
    $result = mysqli_query($conn, "SELECT * FROM questions");

    ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">إضافة أسئلة جديدة</h1>

        <!-- إشعار النجاح أو الفشل -->
        <?php if ($message): ?>
            <div class="toast position-fixed <?php echo $toast_class; ?>" style="top: 20px; right: 20px; z-index: 9999; display: block;">
                <div class="toast-body">
                    <?php echo $message; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- نموذج إضافة سؤال -->
        <form method="POST">
            <div class="mb-3">
                <label for="question_text" class="form-label">نص السؤال</label>
                <textarea id="question_text" name="question_text" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">نوع السؤال</label>
                <select id="type" name="type" class="form-select" required>
                    <option value="multiple_choice">اختيارات متعددة</option>
                    <option value="true_false">صح أو خطأ</option>
                </select>
            </div>
            <div id="answers-section" style="display: none;">
                <label class="form-label">الإجابات</label>
                <div class="mb-3">
                    <input type="text" name="answers[]" class="form-control mb-2" placeholder="الإجابة الأولى">
                    <input type="text" name="answers[]" class="form-control mb-2" placeholder="الإجابة الثانية">
                    <input type="text" name="answers[]" class="form-control mb-2" placeholder="الإجابة الثالثة">
                    <input type="text" name="answers[]" class="form-control mb-2" placeholder="الإجابة الرابعة">
                </div>
            </div>
            <div class="mb-3">
                <label for="correct_answer" class="form-label">الإجابة الصحيحة</label>
                <input type="text" id="correct_answer" name="correct_answer" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">إضافة السؤال</button>
        </form>

        <!-- عرض الأسئلة السابقة -->
        <h2 class="text-center mt-5">الأسئلة المطروحة</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نص السؤال</th>
                    <th>نوع السؤال</th>
                    <th>الإجابة الصحيحة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$counter}</td>
                        <td>{$row['question_text']}</td>
                        <td>{$row['type']}</td>
                        <td>{$row['correct_answer']}</td>
                        <td>
                            <a href='edit_question.php?id={$row['id']}' class='btn btn-warning btn-sm'>تعديل</a>
                            <a href='delete_question.php?id={$row['id']}' class='btn btn-danger btn-sm'>حذف</a>
                        </td>
                    </tr>";
                    $counter++;
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

<script>
    document.getElementById('type').addEventListener('change', function () {
        const answersSection = document.getElementById('answers-section');
        if (this.value === 'multiple_choice') {
            answersSection.style.display = 'block';
        } else {
            answersSection.style.display = 'none';
        }
    });
</script>

<?php include('partials/_footer.php'); ?>
