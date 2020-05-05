<?php

/**
 * @param string $lien
 * @param string $title
 * @param string $linkClass
 * @return string
 *
 * Création des liens pour le menu
 */
function nav_item(string $lien,string  $title,string $linkClass):string
{
    $class="nav-item";
    if(($_SERVER["SCRIPT_NAME"]===$lien)||(($_SERVER["SCRIPT_NAME"]=="/index.php") && ($lien=="/")))
    {
        $class=" active";
    }
    return <<<HTML
            <li class=$class>
                <a class=$linkClass href=$lien>$title</a>
            </li>
HTML;
}


/**
 * @param string $linkClass
 * @return string
 *
 * Création du menu
 */
function nav_menu(string $linkClass ='""'): string
{
    if(session_status()===PHP_SESSION_NONE )
    {
        session_start();
    }
    $text=<<<HTML
    <ul class="navbar-nav mr-auto">
HTML;
    $text.=nav_item("/", "Accueil", $linkClass).
    nav_item("/contact.php", "Contact", $linkClass).
    nav_item("/menu.php", "Menu", $linkClass).
    nav_item("/jeu.php", "Jeu", $linkClass).
    nav_item("/newsletter.php", "Newsletter", $linkClass).
    nav_item("/profile.php", "Profil", $linkClass).
    nav_item("/nsfw.php", "NSFW", $linkClass).
    nav_item("/dashboard.php", "Dashboard", $linkClass).
    nav_item("/livreOr.php", "Livre D'or", $linkClass);

    if(isset($_SESSION['admin']))
    { $text.=<<<HTML
    </ul><ul class="navbar-nav">
HTML;
        $text.=  nav_item("/deconnection.php", "Deconnexion", $linkClass);
        $text.=<<<HTML
        </ul>
HTML;
    }
    else
    {
        $text.= nav_item("/connection.php", "Connexion", $linkClass);;
    }
    $text.=<<<HTML
    </ul>
HTML;

    return $text;
}


/**
 * @param array $data
 * @param string $products
 * @param $productsData
 * @return array
 *
 * renvoie le produit final et son montant pour la page Jeu
 */

function finalProduct(array $data, string $products,$productsData):array
{
    $ingredient=[];
    $price=0;
    if(isset($data[$products]))
    {
        foreach ($data[$products] as $product)
        {
            $ingredient[]=$product;
            $price+=$productsData[$product];
        }
    }
    return [$ingredient,$price];
}

/**
 * @param $products
 * @return string
 * creer une liste contenant tout les produit
 */
function createListe($products)
{
    $liste='';
    foreach($products as $product)
    {
        $liste.=<<<HTML
                <li>$product</li>
HTML;
    }
    return $liste;
}


/**
 * @param array $creneaux
 * @return string
 *
 * Renvoie un string donnant les horaires d ouverture
 */
function creneaux_HTML(array $creneaux)
{
    $string="";
    foreach ($creneaux as $creneau)
    {
        if($creneau!=NULL) {
            $horaire[] = "Ouvert de  <strong>{$creneau[0]}</strong> h à <strong>{$creneau[1]}h</strong>";
            $string=implode(" et de ",$horaire);
        }
        else{
            $string="Le magasin est fermé";
            break;
        }

    }
    return $string;
}

/**
 * @param array $jours
 * @param array $horaires
 * @param $act
 * @return string
 *
 * affiche les jours d'ouverture et la disponnibilité suivant le jour
 */
function affichage_jour(array $jours, array $horaires,$act)
{
    $string="";
    for($i=0;$i<sizeof($jours);$i++)
    {
        if(($act==$i) &&( $i<5))
        {
            $style='green';
        }
        else if(($act==$i) &&( $i>=5))
        {
            $style='red';
        }
        else
        {
            $style="";
        }
        $creneauJour=creneaux_HTML($horaires[$i]);
        $string .=<<<HTML
        <li><div style='color:$style'><strong>$jours[$i]</strong> : $creneauJour</div></li>
HTML;
    }
    return $string;
}

/**
 * @param int $heure
 * @param array $creneaux
 * @return string
 *
 * Compare 2 créneau différent pour voir s'ils s entrecroisent
 */
function in_creneaux(int $heure, array $creneaux)
{

    foreach ($creneaux as $creneau)
    {
        if(($creneau!=null) && ($heure>=$creneau[0])&&($heure<$creneau[1]))
        {
            return <<<HTML
            <div class="alert alert-success">Le magasin est ouvert</div>
HTML;
        }
    }
    return <<<HTML
    <div class="alert alert-danger">Le magasin est fermé</div>
HTML;
}


/**
 * @param $fichier
 * @return string
 *
 * lis un fichier pour la page menu et le transforme en code html
 */
function lecture_fichier($fichier)
{
    $text="";
    $i=0;
    while($line=fgets($fichier))
    {
        $i++;
        $parties=explode('	',$line);
        if(count($parties)==1){
            if($text!="")
            {
                $text.=<<<HTML
                </ul>
HTML;
            }
            $text.=<<<HTML
            <h2>$parties[0]</h2>
            <ul
HTML;
        }
        else
        {
            $text.=<<<HTML
            <li><strong>$parties[0] : $parties[2]€ </strong><br>
            <p>$parties[1],</p>       
HTML;
        }
    }
    return $text;
}

/**
 * @param $year
 * @param $month
 * @return false|int|string
 *
 * renvoie le compteur mensuel de visite
 */
function comptMonth($year, $month)
{
    $compt=0;
    foreach ( glob(dirname(__DIR__).DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR."compteur-".$year."-".$month."-*.txt") as $file)
    {
        $compt+=file_get_contents($file);
    }
    return $compt;
}

/**
 * @param $year
 * @param $mois
 * @return string
 *
 * retourne un tableau html contenant les mois de l'année selectionnée
 */
function printYear($year,$mois)
{
    $text="<table class=\"table table-striped table-responsive\"><thead><tr>";
    foreach ($mois as $k=>$m)
    {
        $text.="<th>".$k."</th>";
    }
    $text.="</tr></thead><tbody><tr>";
    foreach ($mois as $k => $m)
    {
        $text.="<td>".comptMonth($year,$m)."</td>";
    }
    $text.="</tr></tbody></table>";
    return $text;
}

/**
 * @param $year
 * @param $month
 * @return string
 *
 * Retourne une chaine contenant le nombre de visite sur le mois selectionné
 */
function printMonth($year,$month)
{
    $text=<<<HTML
    <h2>Détails visite pour le mois</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Jour</th>
                <th>Nombre de visite</th>
            </tr>
        </thead>
        <tbody>
HTML;
    foreach ( glob(dirname(__DIR__).DIRECTORY_SEPARATOR."elements".DIRECTORY_SEPARATOR."compteur-".$year."-".$month."-*.txt") as $file)
    {
        $day=substr( explode('-',basename($file))[3],0,2);
        $count=0;
        if(file_exists($file))
        {
            $count=file_get_contents($file);
        }
        $text.=<<<HTML
            <tr>
                <td>$day</td>
                <td>$count</td>
            </tr>
HTML;
    }
    $text.=<<<HTML
        </tbody>
    </table>
HTML;
    return $text;
}