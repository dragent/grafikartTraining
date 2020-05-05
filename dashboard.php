<?php
    session_start();
    if(!isset($_SESSION["admin"]))
    {
        header("Location:connection.php");
        exit();
    }
    $annee=(int)date('Y');
    $monthCompt=null;
    $monthSelected=empty($_GET["month"]) ? null: $_GET["month"];
    $yearSelected= empty($_GET["year"]) ? $annee: (int)$_GET["year"];
    $mois=[
        "janvier"=>"01",
        "fevrier"=>"02",
        "mars"=>"03",
        "avril"=>"04",
        "mai"=>"05",
        "juin"=>"06",
        "juillet"=>"07",
        "aout"=>"08",
        "septembre"=>"09",
        "octobre"=>"10",
        "novembre"=>"11",
        "décembre"=>"12"
    ];
    require_once "elements".DIRECTORY_SEPARATOR."header.php";
    if($monthSelected!=null)
    {
        $monthCompt=comptMonth($yearSelected,$mois[$monthSelected]);
    }?>

    <div class="row">
        <div class="card col-md-4">
            <h1>Dashboard</h1>
            <div class="card-body">
                <div> Vous avez eu <strong><?= $compteur ?></strong> depuis l'ouverture du site</div>

                <?php if($monthCompt!=null){?><div>Vous avez eu <strong><?= $monthCompt ?></strong> en <?= $monthSelected ?> <?= $yearSelected ?></div><?php

                }

                ?>
            </div>
        </div>
        <div class=" col-md-6">
                <?php if($monthSelected==null){echo printYear($yearSelected,$mois);}
                else{ echo printMonth($yearSelected,$mois[$monthSelected]);}?>
        </div>
        <div class="col-md-2">
            <ul class="list-unstyled text-small list-group">
                <?php for($i=0;$i<5;$i++)
                {
                    if(($annee-$i)===$yearSelected)
                    {

                        $text="<li class='list-group-item active'>".($annee-$i)."</li><ul class='list-group'> ";

                        foreach ($mois as $m=>$v)
                        {
                            if($m===$monthSelected)
                            {
                                $text.="<li class='list-group-item active'>".$m."</li>";
                            }
                            else
                            {
                                $text.="<a href='dashboard.php?year=".($annee-$i)."&month=".$m."'> <li class='list-group-item'>".$m."</li></a>";
                            }
                        }
                        $text.="</ul>";
                    }
                    else
                    {
                        $text="<a href='dashboard.php?year=".($annee-$i)."'> <li class='list-group-item'>".($annee-$i)."</li></a>";
                    }
                    echo $text;
                }?>
            </ul>
        </div>
    </div>
   <?php require_once "elements".DIRECTORY_SEPARATOR."footer.php";
?>