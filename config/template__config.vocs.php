<?php

// rename as config.vocs.php

####################################################################
# TemaTres : aplicación para la gestión de lenguajes documentales  #
#                                                                  #
# Copyright (C) 2004-2017 Diego Ferreyra tematres@r020.com.ar      #
# Distribuido bajo Licencia GNU Public License, versión 2          #
# (de junio de 1.991) Free Software Foundation                     #
#                                                                  #
####################################################################

#### Configuración de vocabularios == Vocabularies Configuration ###



$vocabularies['tesauro'] = array(
    'name'      => '',
    'title'     => '',
    'DBprefix'  => '',
    'logoImg'   => '',
    'logoTitle' => '',
    'logoLink'  => ''
);

$CFG['URL']              = '';





####################################################################



list($vocabulary, $page) = getVocabulary($vocabularies);

define('URL_BASE', $CFG['URL'] . $vocabulary['name']. '/');



############################ FUNCTIONS #############################

function getVocabulary($vocabularies)
{
    GLOBAL $CFG;

    $uri = $_SERVER['REQUEST_URI'];

    preg_match('#(\w+)\/?(\w+)?#', $uri, $matches);

    if ( ! isset($matches[1]) || ! array_key_exists($matches[1], $vocabularies)) {
        if (file_exists('views/menu-local.view.php')) {
            require 'views/menu-local.view.php';
            die;
        }

        echo 'No existe vocabulario. Probá con... <br>';

        foreach ($vocabularies as $k => $v) {
            echo '<a href="' . $CFG['URL'] . $k . '">' . $v['title'] . '</a><br>';
        }
        die;
    }

    if ( ! isset($matches[2]) || ! in_array($matches[2], array('admin', 'index', 'install', 'js', 'login', 'modal', 'searcher', 'services', 'sobre', 'sparql', 'suggest', 'xml'))) {
        $page = 'index';
    } else {
        $page = $matches[2];
    }

    return array($vocabularies[$matches[1]], $page);
}
