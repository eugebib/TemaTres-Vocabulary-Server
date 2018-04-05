<?php

// rename as config.tematres.php

####################################################################
# TemaTres : aplicación para la gestión de lenguajes documentales  #
#                                                                  #
# Copyright (C) 2004-2017 Diego Ferreyra tematres@r020.com.ar      #
# Distribuido bajo Licencia GNU Public License, versión 2          #
# (de junio de 1.991) Free Software Foundation                     #
#                                                                  #
####################################################################

############# ARCHIVO DE CONFIGURACION === CONFIG FILE #############



if (stristr( $_SERVER['REQUEST_URI'], "config.tematres.php") ) die("no access");

$CFG = [
  "debugMode" => 0,
  "hashPass"  => 1
];










####################################################################

if ( ! defined('T3_ABSPATH')) {
    /** Use this for version of PHP < 5.3 */
    define('T3_ABSPATH', dirname(dirname(__FILE__)) . '/');

    /** Use this for version of PHP >= 5.3  */
    //~ define('T3_ABSPATH', dirname(__DIR__) . '/');

    /** Use to define specific local path for common/include directory */
    //~ define('T3_ABSPATH', '/home/my_name/tematres/');
}

if ($CFG["debugMode"]=='1') {
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors',false);
}

require_once(T3_ABSPATH . 'common/include/fun.gral.php');

// Conexión con la BD || => proceso de instalación
$DB = DBconnect();

if (!$DB) {
    loadPage(T3_ABSPATH . 'vocab/install.php');
}

//Agregado para la version multi
require_once(T3_ABSPATH . 'common/include/config.tematres.php');

//if (checkAllowPublication(basename($_SERVER['SCRIPT_NAME']))==0) loadPage('login.php');

// ID del Tesauro por DEFAULT
$CFG["DFT_TESA"] ='1';

//Config Sites availables for URL search
$CFG["SEARCH_URL_SITES"] =array("wikipedia","Google exacto","Google scholar","Google images","Google books");

//List of alias code for hidden non prefered terms
$CFG["HIDDEN_EQ"] =array("MS","SP","H");

// Config URI base for XML URI as identifiers. If null, use URI vocabulary
$CFG["_URI_BASE_ID"] = '';

// Config char beween _URI_BASE_ID and term ID. If null, use '?tema=' for HTTP response
$CFG["_URI_SEPARATOR_ID"] ='?tema=';

// Config char encode (only can be: utf-8 or iso-8859-1)
$CFG["_CHAR_ENCODE"] ='utf-8';


/*
Define specific  Excluded characters from the alphabetic menu
 */
//$CFG["_EXCLUDED_CHARS"]=array("<",">","[","]","(",")");

// Status details visible for any users [Detalles del estado de terminos visibles para todos los usurios] 0 => no public details / 1 => public details
define('CFG_VIEW_STATUS','1');

// Define way to display top terms, 0=AJAX, 1=HTML div, default = 0
$CFG["_TOP_TERMS_BROWSER"] ='0';

// Define char to recognice tag separator in txt import procedure. default = ":"
$CFG["IMP_TAG_SEPARATOR"]  =':';

// Define char to recognice as tabulator, tabulator is char used in txt import procedure to asig to the term the same relation as previous relation. default = "==="
$CFG["IMP_TAG_TABULATOR"]  ='===';


/* Config here to publish image and fixed link in header:

    URL_IMG= URL for the image.
    URL_LINK= link for the image (optional)

 Example
 $CFG["HEADER_EXTRA"] =array(
    "LINK_IMG"=>'http://vocabularyserver.com/img/tematres-logo.gif',
    "LINK_URL"=>'http://vocabularyserver.com/',
    "LINK_TITLE"=>'TemaTres: open source way to manage formal representations of knowledge'
    );
 */
$CFG["HEADER_EXTRA"] =array(
    "LINK_IMG"=>'',
    "LINK_URL"=>'',
    "LINK_TITLE"=>''
);

/*  In almost cases, you don't need to touch nothing here!!
 *  Web path to the directory where are located
 */

// change to whatever timezone you want
if (date_default_timezone_get() != ini_get('date.timezone')) {
    date_default_timezone_set('Etc/UTC');
}

if ( ! defined('T3_WEBPATH')) {
    define('T3_WEBPATH', getURLbase().'../common/');
}

require_once(T3_ABSPATH . 'common/include/fun.sql.php');
require_once(T3_ABSPATH . 'common/include/fun.xml.php');
require_once(T3_ABSPATH . 'common/include/fun.html.php');
require_once(T3_ABSPATH . 'common/include/fun.html_forms.php');
