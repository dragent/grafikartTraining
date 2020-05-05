<?php
    require "elements".DIRECTORY_SEPARATOR."header.php";
    $fileName=__DIR__.DIRECTORY_SEPARATOR.'cli'.DIRECTORY_SEPARATOR.'menu.tsv';
    $file=fopen($fileName,"r+");
    ?>
    <h1>Le menu du jour</h1>
    <?php
            echo lecture_fichier($file);
    require "elements".DIRECTORY_SEPARATOR."footer.php";?>
