<?php
$text="";
$error=true;
$password= "$2y$12\$BQo7eDvBshsf0/Oln7XPSu.2JAmlFbZ9pgT3cIltCs1z4l3fuLUpq";

session_start();
if(isset($_SESSION["admin"]))
{
    $text='<div class="alert alert-success">Vous avez été enregistré</div>';
    $error=false;
}
else if(isset($_POST["pseudo"]))
{
    $error=true;
    if(($_POST['pseudo']==="test")&&(password_verify($_POST["password"],$password)))
    {
        $_SESSION["admin"]=$_POST["pseudo"];
        $text='<div class="alert alert-success">Vous avez été enregistré</div>';
        $error=false;
    }
    else
    {
        $text='<div class="alert alert-danger">Le login et mot de passe ne correspondent pas</div>';
    }
}
require "elements".DIRECTORY_SEPARATOR."header.php"; ?>
<h1>Connexion</h1>
    <?php

    if($text!=="")
    {
        echo $text;
    }
    if($error){?>
    <form action="" method="post">
        <div class="form-group">
            <input type="text" name="pseudo" class="form-control" placeholder="Veuillez mettre votre pseudo" required/>
            <input type="password" name="password" class="form-control" placeholder="Tapez votre mot de passe" size="5" required> </input>
        </div>
        <button type="submit" class="btn btn-primary">Connection</button>
    </form>
    <?php }
require "elements".DIRECTORY_SEPARATOR."footer.php";

