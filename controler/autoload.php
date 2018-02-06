<?php

/** Permet l'auto-chargement des classes */

function chargerClasse($class)
{

    $file = str_replace('\\','/',$class); // on met 2\\ car \ en php est un caractère réservé
    $file = ltrim($file,'/');
    require_once $file.'.php';
}
spl_autoload_register('chargerClasse');
