<?php

    require_once 'config'.DIRECTORY_SEPARATOR.'functions.php';
    require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'Compteur.php';
    $compteurFile = new Compteur(dirname(__DIR__).DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR."compteur.txt");
    $comptJourFile = new Compteur(dirname(__DIR__).DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR."compteur-".date('Y-m-d').".txt");
    $compteur=$compteurFile->incrementer();
    $compteur=$compteurFile->recuperer();
    $comptJour=$comptJourFile->incrementer();
    $comptJour=$comptJourFile->recuperer();
    ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title><?php
        $title=explode('.',$_SERVER["SCRIPT_NAME"])[0];
        echo substr ($title,1);?></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <meta name="theme-color" content="#563d7c">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="/">monsite</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <?php
                echo nav_menu("nav-link");?>
    </div>
</nav>

<main role="main" class="container">
