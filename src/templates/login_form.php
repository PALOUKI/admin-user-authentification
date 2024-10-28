<?php 
//src/templates/login_form.php
require_once('../controllers/users_controller.php'); 
$title = "Se connecter";
ob_start(); 

// Vérifier que la variable $errors est initialisée
if (!isset($errors)) {
    $errors = []; 
}
?>
    <div class="form-container">
        <form action="" method="post">
            <h3>Se connecter</h3>
                <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                ?>
            <input type="email" name="email" required placeholder="Enter your Email">
            <input type="password" name="password" required placeholder="Enter your Password">

                <input type="submit" value="login now" name="login" class="form-btn">

            <p>Vous n'avez pas de compte? <a href="signUp_form.php">S'inscrire.</a></p>
        </form>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('layout.php') ?>

