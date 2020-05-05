<?php
    $pseudo=null;
    if((isset($_GET["action"])) && ($_GET["action"]==="deconnecter"))
    {
        unset($_COOKIE["utilisateur"]);
        setcookie('utilisateur','',time()-10);
    }
    if(isset($_POST["pseudo"]))
    {
        setcookie("utilisateur",$_POST["pseudo"]);
        $pseudo=htmlentities($_COOKIE['utilisateur']);
    }
    require "elements".DIRECTORY_SEPARATOR."header.php";
    ?>
        <?php if($pseudo){?>
        <h1>Bonjour <?=$pseudo?></h1>
        <a href="profile.php?action=deconnecter">Deconnexion</a>
        <?php } else { ?>
        <h1>Votre Profil</h1>
        <?php } ?>
        <form method="post" action="profile.php">
            <div class="form-group">
                <input type="text" class="form-control" name="pseudo" placeholder="Veuillez mettre votre pseudo"/>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrez vous</button>
        </form>
    <?php require "elements".DIRECTORY_SEPARATOR."footer.php";
?>