<?php
/*
 *      db.tematres.php
 *
 *      Copyright 2011 diego ferreyra <diego@r020.com.ar>
 *
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */

// Configuarcion de base de datos - Database Configuration

// Select driver to use
// Default: mysql , can be mysqli,postgres, oci8, mssql, and more: http://phplens.com/adodb/supported.databases.html
// To default value, leave empty eg: $DBCFG["DBdriver"] ="";
$DBCFG["DBdriver"] ="mysqli";

//  Dirección IP o nombre del servidor - IP Address of the database server
$DBCFG["Server"]      = "localhost";

//  Nombre de la base de datos Database name
$DBCFG["DBName"]     = "tematres";

//  Nombre de usuario - login
$DBCFG["DBLogin"]    = "root";

//  Passwords
$DBCFG["DBPass"] = "";

//  Prefijo para tablas # Prefix for tables
$DBCFG["DBprefix"] = "bnm__tes_";


$DBCFG["DBcharset"] ="utf8";

//  modo debug = 1 // debug mode = 1
$DBCFG["debugMode"] = "1";

//  enlace a documentación de ayuda
$DBCFG["help"] = "http://help.com";

// Define if storage hashed passwords or not  (1 = Yes, 0 = No: default: 0)
define('CFG_HASH_PASS','0');

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
$CFG["HEADER_EXTRA"] = array(
    "LINK_URL"=>'',
    "LINK_TITLE"=>''
);

//$CFG["intro"] = '';

/*  In almost cases, you don't need to touch nothing here!!
 *  Absolute path to the directory where are located /common/include.
 */
if ( !defined('T3_ABSPATH') )
	/** Use this for version of PHP < 5.3 */
	//define('T3_ABSPATH', dirname(__FILE__) . '/../');

	/** Use this for version of PHP >= 5.3	*/
	define('T3_ABSPATH', dirname(__DIR__) . '/');

    define('local_path', T3_ABSPATH . basename(dirname(__FILE__)) . '/');
    /** Use to define specific local path for common/include directory */
    //~ define('T3_ABSPATH', '/home/my_name/tematres/');

function dd($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

