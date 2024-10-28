<?php 
//src/templates/signUp_form.php
require_once('../controllers/users_controller.php'); 
$title = "S'inscrire";
ob_start(); 
// Vérifier que la variable $errors est initialisée
if (!isset($errors)) {
    $errors = []; 
}
?>
    <div class="form-container">
        <form action="" method="post">
            <h3>S'inscrire </h3>
            <?php
            if(count($errors) == 1){
                ?>
                <div class="alert alert-danger text-center">
                    <?php
                    foreach($errors as $showerror){
                        echo $showerror;
                    }
                    ?>
                </div>
                <?php
            }elseif(count($errors) > 1){
                ?>
                <div class="alert alert-danger">
                    <?php
                    foreach($errors as $showerror){
                        ?>
                        <li><?php echo $showerror; ?></li>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>
            <input type="text" name="name" required placeholder="nom">
            <input type="email" name="email" required placeholder="email">
            <input type="password" name="password" required placeholder="mot de passe">
            <input type="cpassword" name="cpassword" required placeholder="confirmer le mot de passe">
            <select name="user_type">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <input type="submit" name="signUp" value="register now" class="form-btn">
            <p>Already have an Account? <a href="login_form.php">Login Now.</a></p>
        </form>
<?php $content = ob_get_clean(); ?>
<?php require('layout.php') ?>