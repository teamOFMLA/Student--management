<?php include('shared/_header.php');?>
<?php

include'config.php';
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}


$result = $conn->query("SELECT * FROM feature_cards WHERE ID=1");
$cards = $result->fetch_all(MYSQLI_ASSOC);
?>
  <main>
    <div class="big-wrapper light">
      

     <?php include('shared/_navbar.php'); ?>
      <div class="container mt-5" dir="rtl">
        <div class="row">
          <div class="col-12 col-md-6 d-flex justify-content-center get-started" style="height: 550px;">
            <div class=" d-flex justify-content-center align-items-center">
              <div>
                <div class="big-title">
                <?php foreach ($cards as $card): ?>
                  <?php if ($card['id']>1 ) break;?>
                  <h1>   <?= htmlspecialchars($card['title']); ?></h1>
                  <h1>   <?= htmlspecialchars($card['icon_class']); ?></h1>
                </div>
                <p class="text">
                <?= htmlspecialchars($card['content']); ?>
                </p>

                <?php endforeach; ?>
                <div class="cta">
                <a  class="btn  addlink" data-bs-toggle="modal" data-bs-target="#addTeacherModal"  style="   background-color: #7380ec;"> إحجز مقعدك</a>


                  
                </div>


              </div>
            </div>
          </div>

          <div class="col-12 col-md-6 image-box">

            <img src="./images/logo12.png" alt="Person Image" class="person" />
          </div>
        </div>
      </div>


  <?php include('shared/feature-cards.php'); ?>
      

      <div class="container mt-3">
        <hr>
      </div>

      <div class="container mt-3 carousel-box">

        <div id="carouselExample" class="carousel slide">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="images/carousel1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="images/carousel2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="images/carousel3.jpg" class="d-block w-100" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>

      </div>
    </div>




   <?php include('register.php'); ?>

<!-- end of add new student model -->

  </main>



<script  src="reg.js"></script>
  <?php include('shared/_footer.php'); ?>
