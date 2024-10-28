<?php
     //src/controllers/users_controller.php
        session_start();
        require "../lib/config.php";
        $email = "";
        $name = "";
        $errors = array();

    //for signUp form
        if (isset($_POST['signUp'])){
            $name = mysqli_real_escape_string($con, $_POST['name']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $password = mysqli_real_escape_string($con, $_POST['password']);
            $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
            $type = mysqli_real_escape_string($con, $_POST['user_type']);

            if($password !== $cpassword){
                $errors['password'] = "mot de passe incorrect";
            }
            $email_check = "SELECT * FROM users WHERE email = '$email'";
            $res = mysqli_query($con, $email_check);
            if (!$res) {
                die("Échec de la requête : " . mysqli_error($con)); // Gestion des erreurs
            }
            if(mysqli_num_rows($res) > 0){
                $errors['email'] = "L'email existe déjà";
            }
            if(count($errors) === 0){
                $encpass = password_hash($password, PASSWORD_BCRYPT);
                $insert_data = "INSERT INTO users (name, email, password, type)
                                values('$name', '$email', '$encpass', '$type')";
                $data_check = mysqli_query($con, $insert_data);
                if($data_check){
                        header('location: login_form.php');
                        exit();
                }
            }
        };
    
    //for login_form
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $check_email = "SELECT * FROM users WHERE email = '$email'";
    
        $res = mysqli_query($con, $check_email);
        if( mysqli_num_rows($res)>0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            $fetch_type = $fetch['type'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['loginUser'] = $email;

                if($fetch_type === 'user'){
                    $_SESSION['user_type'] = 'user';
                }elseif($fetch_type === 'admin'){
                    $_SESSION['user_type'] = 'admin';
                }
                
                if($_SESSION['loginUser']){
                    $_SESSION['name'] = $fetch['name'];
                    $_SESSION['email'] = $email;
                    header('location: home.php');
                    exit();
                }
            }else{
                $errors['email'] = "email ou mot de passe incorrect";
            }
        }else{
            $errors['email'] = "l'email n'existe pas, veuillez vous inscrire";
        }
    }

    