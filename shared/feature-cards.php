<?php
// اتصال قاعدة البيانات
include'config.php';
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// جلب البطاقات
$result = $conn->query("SELECT * FROM feature_cards WHERE ID >1");
$cards = $result->fetch_all(MYSQLI_ASSOC);
?>



<div class="container card-container"  id="feature-cards">
        <div class="row g-5 show-cards">
        <?php foreach ($cards as $card): ?>




          <div class="col-12 col-md-4">
            <div class="card border-0 shadow p-3 h-100">
              <div class="py-3">
                <h3 class="fs-4 justify-content-center">
                  <span class="text-primary icon-hover"><i><?=$card['icon_class']; ?></i></span>
                  <?= htmlspecialchars($card['title']); ?>
                </h3>
              </div>
              <p><?= htmlspecialchars($card['content']); ?></p>
            </div>
          </div>

          <?php endforeach; ?>



          <div class="col-12 col-md-4">
            <div class="card border-0 shadow p-3 h-100">
              <div class="py-3">
                <h3 class="fs-4 justify-content-center">
                  <span class="text-primary icon-hover"><i>∙</i></span>
                  OMAR
                </h3>
              </div>
              <p>OMAR MOKHTAR </p>
            </div>
          </div>

      </div>
      
      </div>