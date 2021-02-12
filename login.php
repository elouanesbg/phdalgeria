<?php 
$pageName="S'identifier";
include_once 'connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

if (isset($_POST['submit'])) {
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

    $q="SELECT * FROM `users` WHERE `email`='$email' and `password`='$password'";
    $r=mysqli_query($dbc,$q);
    $num=mysqli_num_rows($r);

    if ($num==1) {
        $row=mysqli_fetch_assoc($r);
        $user_id=$row['id'];

        if($row['archived']==1){
          header('Location: login.php?archived');
          exit();
        }

        ob_start();
        if($row['active']!=1){
          header('Location: login.php?active');
          exit();
        }

        

        $_SESSION['user_id']=$row['id'];
        $_SESSION['user_firstname']=$row['firstname'];
        $_SESSION['user_lastname']=$row['lastname'];
        $_SESSION['user_phone']=$row['phone'];
        $_SESSION['user_email']=$row['email'];
        $_SESSION['user_date']=$row['date'];

        header('location: index.php');
    }else{
        $msg="Il y a une erreur dans l'e-mail ou le mot de passe";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $pageName ?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Nous saluons le retour!</h1>
                            </div>

                            <?php 
                            if(isset($msg)){ ?>
                                <div class="alert alert-info">
                                  <strong>PHD Algeria!</strong> <?= $msg ?>
                                </div>
                            <?php } ?>

                            <?php 
                            if(isset($_GET['success'])){ ?>
                                <div class="alert alert-info">
                                  <strong>PHD Algeria!</strong> Vous avez été enregistré! Veuillez vérifier votre email!
                                </div>
                            <?php } ?>

                            <?php 
                            if(isset($_GET['success2'])){ ?>
                                <div class="alert alert-info">
                                  <strong>PHD Algeria!</strong> Votre compte est activé, vous pouvez vous connecter
                                </div>
                            <?php } ?>

                            <?php 
                            if(isset($_GET['success3'])){ ?>
                                <div class="alert alert-info">
                                  <strong>PHD Algeria!</strong> Le mot de passe a été changé avec succès
                                </div>
                            <?php } ?>

                            <?php 
                            if(isset($_GET['archived'])){ ?>
                                <div class="alert alert-info">
                                  <strong>PHD Algeria!</strong> Votre compte a été supprimé. Vous ne pouvez pas vous connecter
                                </div>
                            <?php } ?>

                            <?php 
                            if(isset($_GET['active'])){ ?>
                                <div class="alert alert-info">
                                  <strong>PHD Algeria!</strong> Votre compte n'est pas activé, vérifiez votre Email
                                </div>
                            <?php } ?>

                            <form class="user" action="login.php" method="post">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email"
                                        placeholder="Adresse e-mail">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                            name="password" placeholder="Mot de passe">
                                </div>

                                <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="S'identifier">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="index.php">Page d'accueil</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Mot de passe oublié?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="register.php">Créer un compte!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>