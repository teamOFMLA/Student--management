<?php include('partials/_header.php') ?>



  <?php include 'register.php';?>


<!-- Sidebar -->
<?php include('partials/_sidebar.php') ?>
<input type="hidden" value="3" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
<!-- Navbar -->
<?php include("partials/_navbar.php"); ?>

<!-- End of Navbar -->
<?php include('stu.php');?>



<div style="align-items: center; margin-left: 200px; " > <h1> 
<?php include('manage_user.php');?> </h1> </div>

<!-- end of alert to delete teacher -->
</div>
<Script>

function switchPage(pageNumber) {
    // إخفاء جميع الصفحات
    var pages = document.querySelectorAll('.page');
    pages.forEach(function(page) {
        page.classList.remove('active');
    });

    // إظهار الصفحة المطلوبة
    var activePage = document.getElementById('page' + pageNumber);
    activePage.classList.add('active');
}
</Script>
<?php include('partials/_footer.php'); ?>

