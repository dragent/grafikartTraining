<?php
    //checkbox
    $parfums=[
        "fraise"=>4,
        "chocolat"=>5,
        "vanille"=>3
    ];
    //radio
    $cornets=[
        "pot"=>2,
        "cornet"=>3
    ];
    //checkbox
    $supplements=[
        "pepites de chocolat"=>1,
        "nappage fraise"=>0.5
    ];
    require_once 'class'.DIRECTORY_SEPARATOR.'Form.php';
    require "elements/header.php";
?>
<h1>Composer votre glace</h1>
<div class="row ">
    <div class="col-md-4 card ">
        <h5 class="card-title card-body">Votre glace</h5>
        <ul>
            <?php
                    $finalProduct=finalProduct($_POST,"parfum",$parfums);
                    $price= $finalProduct[1];
                    echo createListe($finalProduct[0]);
                    $finalProduct=finalProduct($_POST,"cornet",$cornets);
                    $price+= $finalProduct[1];
                    echo createListe($finalProduct[0]);
                    $finalProduct=finalProduct($_POST,"supplements",$supplements);
                    $price+= $finalProduct[1];
                    echo createListe($finalProduct[0]);
                    echo "Vous devez regler ".$price."€.";
             ?>
        </ul>
    </div>
    <div class="col-md-8">
        <form action="jeu.php" method="POST">
            <div class="form-group">
                <h3>Choississez vos parfum</h3>
                <?php foreach ($parfums as $parfum=>$prix)
                    {
                        echo Form::checkbox("checkbox","parfum",$parfum,$prix,$_POST);

                    };?>
            </div>
            <div class="form-group">
                <h3>Choississez votre cornet</h3>
                <?php foreach ($cornets as $cornet=>$prix)
                {
                    echo Form::radio("radio","cornet",$cornet,$prix,$_POST);
                };?>
            </div>
            <div class="form-group">
                <h3>Choississez vos supplements</h3>
                <?php foreach ($supplements as $supplement=>$prix)
                {
                    echo Form::checkbox("checkbox","supplements",$supplement,$prix,$_POST);
                };?>
            </div>
            <button type="submit" class="btn btn-primary">Composer ma glace</button>
        </form>
    <div>
</div>
<?php require "elements".DIRECTORY_SEPARATOR."footer.php";?>