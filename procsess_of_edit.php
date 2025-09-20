
<?php
// معالجة العمليات في نفس الصفحة
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action == 'add') {
        $title = $_POST['title'];
        $icon_class = $_POST['icon_class'];
        $content = $_POST['content'];

        $stmt = $conn->prepare("INSERT INTO feature_cards (title, icon_class, content) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $icon_class, $content);
        $stmt->execute();

        $card_html = '<div class="col-md-4 card-item" data-id="' . $conn->insert_id . '">
                        <div class="card border-0 shadow p-3 mb-4 h-100">
                            <div class="py-3">
                                <h3 class="fs-4">
                                    <span class="text-primary icon-hover">
                                        <i class="' . htmlspecialchars($icon_class) . '"></i>
                                    </span>
                                    ' . htmlspecialchars($title) . '
                                </h3>
                            </div>
                            <p>' . htmlspecialchars($content) . '</p>
                            <button class="btn btn-danger delete_card_btn">حذف</button>
                            <button class="btn btn-secondary edit_card_btn" data-bs-toggle="modal" data-bs-target="#editModal' . $conn->insert_id . '">تعديل</button>
                        </div>
                    </div>';

        echo json_encode(['message' => 'تم إضافة البطاقة بنجاح!', 'card_html' => $card_html]);
    }

    if ($action == 'update') {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $icon_class = $_POST['icon_class'];
        $content = $_POST['content'];

        $stmt = $conn->prepare("UPDATE feature_cards SET title=?, icon_class=?, content=? WHERE id=?");
        $stmt->bind_param("sssi", $title, $icon_class, $content, $id);
        $stmt->execute();

        echo json_encode(['message' => 'تم تحديث البطاقة بنجاح!']);
    }

    if ($action == 'delete') {
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM feature_cards WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        echo json_encode(['message' => 'تم حذف البطاقة بنجاح!']);
    }
}
?>
