<?php
require "elements".DIRECTORY_SEPARATOR."header.php";
    $error=null;
    $email=null;
    if(isset($_POST["email"]))
    {
        $email=htmlentities($_POST["email"]);
        if( filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $file=__DIR__.DIRECTORY_SEPARATOR."email".DIRECTORY_SEPARATOR.date("Y-m-d").".txt";
            file_put_contents($file,$email.PHP_EOL,FILE_APPEND);
            $email="";
            $error= <<<HTML
            <div class="alert alert-success">Vous avez été enregistré</div>
HTML;

        }
        else
        {
            $error= <<<HTML
            <div class="alert alert-danger">Veuillez rentre un email valide</div>
HTML;
        }
    }
    ?>
    <h1>Newsletter</h1>
    <?=$error?>
    <form action="newsletter.php" method="post" class="form-inline" >
        <div class="form-group">
            <input type="text" placeholder="rentrez votre mail" name="email" value="<?=$email?>" required class="form-control"/>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>

    <?php require "elements/footer.php";?>
