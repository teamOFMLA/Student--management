<?php include('../admin_panel/partials/_header.php') ?>

<!-- Sidebar -->

<input type="hidden" value="3" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
  
    <?php
    include('config.php');

    // جلب الأسئلة من قاعدة البيانات
    $result = mysqli_query($conn, "SELECT * FROM questions");
    $questions = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>

    <!-- سؤال جاهز للإجابة من الطالب -->
    <div id="readyQuestion" class="text-center mt-5">
        <h2>هل أنت مستعد للاختبار؟</h2>
        <button id="startExamBtn" class="btn btn-success">نعم</button>
        <button id="cancelExamBtn" class="btn btn-danger">لا</button>
    </div>

    <!-- البدء في عرض الأسئلة بعد الموافقة -->
    <div id="quizContainer" style="display: none;">
        <div class="container mt-5">
            <h1 class="text-center mb-4">اختبار الطالب</h1>

            <!-- موقت العد التنازلي -->
            <div id="timer" class="text-center mb-4">
                <h3>الوقت المتبقي: <span id="time"></span> دقيقة</h3>
            </div>

            <form id="quizForm" method="POST" action="submit_exam.php">
                <div id="questionSection">
                    <!-- سيتم إضافة الأسئلة هنا ديناميكياً -->
                </div>

                <!-- زر الإرسال -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">إرسال الإجابات</button>
                </div>
            </form>
        </div>
    </div>

    <!-- إشعار الفشل في إجابة الأسئلة -->
    <div id="error-message" class="alert alert-danger" style="display: none;">
        <strong>تنبيه!</strong> يجب عليك الإجابة على جميع الأسئلة.
    </div>

    <!-- عرض النتيجة -->
    <div id="resultContainer" style="display: none;" class="text-center mt-5">
        <h2>نتيجتك:</h2>
        <p id="correctAnswers">الإجابات الصحيحة: 0</p>
        <p id="wrongAnswers">الإجابات الخاطئة: 0</p>
        <p id="score">النتيجة: 0%</p>
    </div>
</div>

<script>
    window.onload = function () {
        let timeLeft = 60 * 60; // 60 دقيقة
        let currentQuestionIndex = 0;
        let correctAnswersCount = 0;
        let wrongAnswersCount = 0;
        let questions = <?php echo json_encode($questions); ?>;
        let quizContainer = document.getElementById('quizContainer');
        let readyQuestion = document.getElementById('readyQuestion');
        let timerElement = document.getElementById('time');
        let questionSection = document.getElementById('questionSection');
        let errorMessage = document.getElementById('error-message');
        let startExamBtn = document.getElementById('startExamBtn');
        let cancelExamBtn = document.getElementById('cancelExamBtn');
        let quizForm = document.getElementById('quizForm');
        let resultContainer = document.getElementById('resultContainer');
        let correctAnswersDisplay = document.getElementById('correctAnswers');
        let wrongAnswersDisplay = document.getElementById('wrongAnswers');
        let scoreDisplay = document.getElementById('score');

        // تجهيز الأسئلة لعرضها
        function loadQuestion(index) {
            if (index >= questions.length) {
                showResult();
                return;
            }

            let question = questions[index];
            let questionHTML = `<div class="mb-4">
                <h5>${index + 1}. ${question['question_text']}</h5>`;

            if (question['type'] == 'multiple_choice') {
                questionHTML += `<div class="form-check">`;
                let answers = <?php echo json_encode(mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM answers WHERE question_id = {$question['id']}"), MYSQLI_ASSOC)); ?>;
                answers.forEach(answer => {
                    questionHTML += `<input type="radio" class="form-check-input" name="question${question['id']}" value="${answer['answer_text']}" required>`;
                    questionHTML += `<label class="form-check-label">${answer['answer_text']}</label><br>`;
                });
                questionHTML += `</div>`;
            } else if (question['type'] == 'true_false') {
                questionHTML += `
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="question${question['id']}" value="صح" required>
                        <label class="form-check-label">صح</label><br>
                        <input type="radio" class="form-check-input" name="question${question['id']}" value="خطأ" required>
                        <label class="form-check-label">خطأ</label><br>
                    </div>`;
            }

            questionHTML += `</div>`;

            questionSection.innerHTML = questionHTML;
        }

        // تحديث الموقت
        function updateTimer() {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            timerElement.textContent = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
            if (timeLeft > 0) {
                timeLeft--;
            } else {
                showResult();
            }
        }

        // بدء الموقت بعد الإجابة بنعم
        startExamBtn.addEventListener('click', function () {
            readyQuestion.style.display = 'none';
            quizContainer.style.display = 'block';
            loadQuestion(currentQuestionIndex);
            setInterval(updateTimer, 1000);
        });

        // إلغاء الاختبار
        cancelExamBtn.addEventListener('click', function () {
            window.location.href = 'index.php'; // إعادة توجيه الطالب إلى الصفحة الرئيسية
        });

        // عرض النتيجة
        function showResult() {
            questionSection.style.display = 'none';
            let formData = new FormData(quizForm);
            let answers = [];
            formData.forEach((value, key) => {
                answers.push({ questionId: key, answer: value });
            });

            answers.forEach(answer => {
                let correctAnswer = questions.find(q => q.id == answer.questionId).correct_answer;
                if (answer.answer === correctAnswer) {
                    correctAnswersCount++;
                } else {
                    wrongAnswersCount++;
                }
            });

            correctAnswersDisplay.textContent = `الإجابات الصحيحة: ${correctAnswersCount}`;
            wrongAnswersDisplay.textContent = `الإجابات الخاطئة: ${wrongAnswersCount}`;
            scoreDisplay.textContent = `النتيجة: ${((correctAnswersCount / questions.length) * 100).toFixed(2)}%`;

            resultContainer.style.display = 'block';
        }

        // التحقق من الإجابة على جميع الأسئلة
        quizForm.addEventListener('submit', function (event) {
            let unansweredQuestions = false;

            questions.forEach((question) => {
                if (!document.querySelector(`input[name="question${question['id']}"]:checked`)) {
                    unansweredQuestions = true;
                }
            });

            if (unansweredQuestions) {
                errorMessage.style.display = 'block';
                event.preventDefault(); // منع الإرسال حتى يتم الإجابة على جميع الأسئلة
            } else {
                errorMessage.style.display = 'none';
            }
        });
    }
</script>

<?php include('../admin_panel/partials/_footer.php'); ?>
