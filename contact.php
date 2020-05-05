<?php
    require "elements".DIRECTORY_SEPARATOR."header.php";
    require_once "class".DIRECTORY_SEPARATOR."Form.php";
    require_once "config".DIRECTORY_SEPARATOR."configPhp.php";
    $act=$_POST["jour"]??date('N')-1;
    $heure=$_POST["heure"]??date('H');
;?>

<div class="row">
    <div class="col-md-8">
        <h2>Nous contacter</h2>
        <p>aaa</p>
    </div>
    <div class="col-md-4">
        <h2>Horaire d'ouverture</h2>
        <?= in_creneaux($heure,CREANEAUX[$act]);?>

        <form action="" method="POST">
            <div class="form-group">
                <?= Form::select("jour",$act,JOURS);?>

            </div>
            <div class="form-group">
                <input class="form-control" type="number" name="heure" value="<?= $heure?>">

            </div>
            <button class="btn btn-primary" type="submit">Voir si le magasin est ouvert</button>
        </form>
        <ul>
            <?= affichage_jour(JOURS,CREANEAUX,$act);?>
        </ul>
    </div>
</div>
<?php require "elements/footer.php";?>
