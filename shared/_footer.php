<footer>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <!-- Insert website logo -->
          <img src="images/logo.png" alt="Website Logo">
          <!-- Display visitor count -->
          <p>Echo English</p>
          <!-- Display time zone -->
          <p>ايكو انجلش تعليم متقن</p>
        </div>
        <div class="col-md-4">
          <p>Time Zone: <?php
                        date_default_timezone_set('Asia/Kolkata');
                        $current_time = date('D M d Y H:i:s \G\M\TO (T)');
                        echo "<p>$current_time</p>";
                        ?></p>
        </div>
        <div class="col-md-4">
          <div class="footer-links">
           
          <p>follow us on</p>
          </div>
          <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f facebook"></i></a>
            <a href="#"><i class="fa-brands fa-x-twitter twitter"></i></a>
            <a href="#"><i class="fab fa-instagram instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in linked-in"></i></a>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-md-12">
          <p>&copy; <?php echo date('Y'); ?> By <a href="##" target="_blank">Eng:Omar && Eng: Bader</a>. All rights reserved.</p>
        </div>
      </div>
    </div>
  </footer>


  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="liveToast" style="z-index: 2000; direction: rtl;">
        <div class="toast-header">
          
          <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      <div class="toast-body" id="toast-alert-message"></div>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
  <script src="./shared/app.js"></script>
</body>

</html>
  