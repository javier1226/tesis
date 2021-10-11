<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Farmacia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/estilos.css">
<link rel="stylesheet" type="text/css" href="../css/css/all.min.css">
</head>
<?php
session_start();
if(!empty($_SESSION['us_tipo'])){
    header('Location: ../controller/loginController.php');
}
else{
    session_destroy();
?>
<body>
    <img class="wave" src="../img/wave1.png" alt="">
    <div class="contenedor">
         <div class="img">
             <img src="../img/bg.svg" alt=""> 
         </div>
         <div class="contenido-login">
            <form  action="../controller/loginController.php" method="post">
                <img src="../img/doctor.png" alt="">
                <h2>EbFarma</h2>
                <div class="input-div dni">
                   <div class="i">
                      <i class="fas fa-user"></i>
                   </div>
                   <div class="div">
                       <h5>DNI</h5>
                       <input type="text" name="user" class="input">
                   </div>
                </div>
                <div class="input-div pass">
                   <div class="i">
                      <i class="fas fa-lock"></i>
                   </div>
                   <div class="div">
                       <h5>Contraseña</h5>
                       <input type="password" name="pass" class="input">
                   </div>
                </div>
                <a href="../view/recuperar.php">recuperar password</a>
                <a href="">Registrarse</a>
                <input type="submit" class="btn" value="Iniciar sesión">
            </form>
         </div>
    </div>
</body>
<script src="../js/login.js"> </script>
</html>
<?php
}
?>