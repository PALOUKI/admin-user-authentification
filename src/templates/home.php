<?php
//src/templates/home.php
require_once('../controllers/users_controller.php'); 
if (!isset($_SESSION['loginUser'])){
    header('location:login_form.php');
}
$title = "page d'acceuil";
ob_start();
?>
    <div class="container">

        <div class="content">
            <h3>    Hi, <span><?= $_SESSION['user_type'] ?></span></h3>
            <h1>Welcome <span>
                <?php
                    echo $_SESSION['name']
                ?>
            </span></h1>
                <a href="../lib/logout.php" class="btn">Logout</a>
        </div>

    </div>
<?php
    $content = ob_get_clean();
?>
<?php require('layout.php') ?>
    
