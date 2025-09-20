<?php include('partials/_header.php') ?>

<!-- Sidebar -->
<?php include('partials/_sidebar.php') ?>
<!-- Main Content -->
<div class="content">
<!-- Navbar -->
<?php include("partials/_navbar.php"); ?>


<?php
// اتصال قاعدة البيانات
include 'config.php';
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// إضافة بطاقة
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_card'])) {
    $title = $_POST['title'];
    $icon_class = $_POST['icon_class'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO feature_cards (title, icon_class, content) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $icon_class, $content);
    $stmt->execute();
    
}

// تحديث بطاقة
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_card'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $icon_class = $_POST['icon_class'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE feature_cards SET title = ?, icon_class = ?, content = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $icon_class, $content, $id);
    $stmt->execute();
 
}

// حذف بطاقة
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $stmt = $conn->prepare("DELETE FROM feature_cards WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
  
}

// جلب البطاقات
$result = $conn->query("SELECT * FROM feature_cards");
$cards = $result->fetch_all(MYSQLI_ASSOC);
?>



<div class="container my-5">

<div class="container my-5">
    <!-- الأيقونات للتبديل بين "الكاردس" و "الوصف" -->
    <div class="d-flex justify-content-center mb-4">
        <button class="btn btn-info mx-3" id="show_cards" onclick="showContent('cards')">
            <i class="fa fa-credit-card"></i> الكاردس
        </button>
        <button class="btn btn-info mx-3" id="show_description" onclick="showContent('description')">
            <i class="fa fa-info-circle"></i> الوصف
        </button>
    </div>

    <!-- عرض المحتوى بناءً على الاختيار -->
    <div id="content_area">
        <!-- محتوى الكاردس -->
        <div id="cards_content" class="content-section">
            <h3>إضافة بطاقة جديدة</h3>
            <!-- إضافة بطاقة -->
            <form method="POST" class="mb-5">
                <div class="mb-3">
                    <label for="title" class="form-label">العنوان</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="icon_class" class="form-label">أيقونة CSS</label>
                    <input type="text" id="icon_class" name="icon_class" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">المحتوى</label>
                    <textarea id="content" name="content" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" name="add_card" class="btn btn-primary">إضافة</button>
            </form>

            <!-- عرض البطاقات مع إمكانية الحذف والتعديل -->
            <div class="row">
                <?php foreach ($cards as $card): ?>
                    <div class="col-md-4">
                        <div class="card border-0 shadow p-3 mb-4 h-100">
                            <div class="py-3">
                                <h3 class="fs-4">
                                    <span class="text-primary icon-hover">
                                    <i><?= $card['id']; ?></i>-
                                        <i><?= $card['icon_class']; ?></i>
                                    </span>
                                    <?= htmlspecialchars($card['title']); ?>
                                </h3>
                            </div>
                            <p><?= htmlspecialchars($card['content']); ?></p>
                            <form method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');" class="d-inline">
                                <input type="hidden" name="delete_id" value="<?= $card['id']; ?>">
                                <button type="submit" class="btn btn-danger">حذف</button>
                            </form>
                            <!-- زر التعديل -->
                            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editModal<?= $card['id']; ?>">تعديل</button>
                        </div>
                    </div>

                    <!-- نافذة التعديل -->
                    <div class="modal fade" id="editModal<?= $card['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">تعديل البطاقة</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $card['id']; ?>">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">العنوان</label>
                                            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($card['title']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="icon_class" class="form-label">أيقونة CSS</label>
                                            <input type="text" name="icon_class" class="form-control" value="<?= htmlspecialchars($card['icon_class']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="content" class="form-label">المحتوى</label>
                                            <textarea name="content" class="form-control" rows="3" required><?= htmlspecialchars($card['content']); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                                        <button type="submit" name="update_card" class="btn btn-primary">تحديث</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- محتوى الوصف -->
        <div id="description_content" class="content-section" style="display: none;">
            <div class="big-title">
                <h1>مرحباََ بكم ,في معهد ايكو انجلش</h1>
                <h1>اتقن اللغة الانجليزية.</h1>
            </div>
            <p class="text">
                <?= htmlspecialchars($description['text']); ?>
            </p>

            <!-- نموذج تحديث الوصف -->
            <form method="POST" class="mb-5">
                <h3>تعديل الوصف</h3>
                <div class="mb-3">
                    <label for="description" class="form-label">المحتوى</label>
                    <textarea id="description" name="description" class="form-control" rows="3" required><?= htmlspecialchars($description['text']); ?></textarea>
                </div>
                <button type="submit" name="update_description" class="btn btn-primary">تحديث</button>
            </form>
        </div>
    </div>
</div>


</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Sidebar -->
<?php include('partials/_footer.php') ?>