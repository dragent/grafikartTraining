<?php
    $pseudo=null;

    if(isset($_POST["pseudo"]))
    {
        setcookie("pseudo",$_POST["pseudo"]);
        $_COOKIE["pseudo"]=$_POST["pseudo"];
        $pseudo=htmlentities($_COOKIE["pseudo"]);
        setcookie("age",$_POST["age"]);
        $_COOKIE["age"]=$_POST["age"];
        $age=htmlentities($_COOKIE["age"]);
    }
    require "elements".DIRECTORY_SEPARATOR."header.php";
    ?>
    <?php
        if($pseudo){?>
        <h1>Bonjour <?=$pseudo?></h1>
        <?php
            if(date('Y')-$age>=18)
           {?>
               <div class="alert alert-success">Vous êtes connecté</div>
           <?php }
           else{?>
               <div class="alert alert-danger">Vous n'avez pas le droit d'être ici</div>
               <?php }
         } else { ?>
        <h1> Salon nsfw</h1>
    <?php } ?>
    <form action="" method="post">
        <div class="form-group">
            <input type="text" name="pseudo" class="form-control" placeholder="Veuillez mettre votre pseudo"/>
            <select name="age" class="custom-select" placeholder="Veuillez mettre votre age" size="5">
            <?php for($i=0;$i<100;$i++)
                {
                    $annee=date('Y')-$i;
                    echo <<<HTML
                    <option value=$annee>$annee</option>
HTML;
                }?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
    <?php require "elements".DIRECTORY_SEPARATOR."footer.php";
