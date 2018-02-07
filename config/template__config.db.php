<?php

// rename as config.db.php

####################################################################
# TemaTres : aplicación para la gestión de lenguajes documentales  #
#                                                                  #
# Copyright (C) 2004-2017 Diego Ferreyra tematres@r020.com.ar      #
# Distribuido bajo Licencia GNU Public License, versión 2          #
# (de junio de 1.991) Free Software Foundation                     #
#                                                                  #
####################################################################

##### Configuracion de base de datos == Database Configuration #####



$uri          = $_SERVER['REQUEST_URI'];

$DBCFG = array(
    "DBdriver"  => "", // MySQLi (default), mysql, postgres, oci8, mssql, and more: http://phplens.com/adodb/supported.databases.html
    "Server"    => "localhost",
    "DBName"    => "",
    "DBLogin"   => "",
    "DBPass"    => "",
    "DBcharset" => "utf8",
    "debugMode" => "1",
    'URL'       => ''
);

$vocabularies = array('tesauro', 'test', 'nueva');

$prefixes     = array(
    'tesauro' => 'bnm_',
    'test' => 'test_',
    'nueva' => 'nueva_'
);

list($vocabulary, $page) = getVocabulary($uri, $vocabularies);

$DBCFG["DBprefix"] = $prefixes[$vocabulary];

define('URL_BASE', $DBCFG['URL'] . $vocabulary. '/');

define('T3_WEBPATH', $DBCFG['URL'] . '/common/');

define('CFG_HASH_PASS','1'); // Define if storage hashed passwords or not  (1 = Yes, 0 = No: default: 0)



############################ FUNCTIONS #############################

function getVocabulary($uri, $vocabularies)
{
    global $DBCFG;

    preg_match('#(\w+)\/?(\w+)?#', $uri, $matches);

    if ( ! isset($matches[1]) || ! in_array($matches[1], $vocabularies)) {
        echo 'No existe vocabulario. Probá con... <br>';
        foreach ($vocabularies as $voc) {
            echo '<a href="' . $DBCFG['URL'] . $voc . '">' . $voc . '</a><br>';
        }
        die;
    }

    if ( ! isset($matches[2]) || ! in_array($matches[2], array('admin', 'index', 'install', 'js', 'login', 'modal', 'searcher', 'services', 'sobre', 'sparql', 'suggest', 'xml'))) {
        $page = 'index';
    } else {
        $page = $matches[2];
    }

    return array($matches[1], $page);
}



############################## UTILS ###############################


function dd($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}
