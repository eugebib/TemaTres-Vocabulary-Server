<?php

####################################################################
# TemaTres : aplicación para la gestión de lenguajes documentales  #
#                                                                  #
# Copyright (C) 2004-2017 Diego Ferreyra tematres@r020.com.ar      #
# Distribuido bajo Licencia GNU Public License, versión 2          #
# (de junio de 1.991) Free Software Foundation                     #
#                                                                  #
####################################################################

##### Configuracion de base de datos == Database Configuration #####



// Select driver to use
// Default: MySQLi , can be mysqli,postgres, oci8, mssql, and more: http://phplens.com/adodb/supported.databases.html
// To default value, leave empty eg: $DBCFG["DBdriver"] ="";
$DBCFG["DBdriver"] = "";

//  Dirección IP o nombre del servidor - IP Address of the database server
$DBCFG["Server"] = "localhost";

//  Nombre de la base de datos Database name
$DBCFG["DBName"] = "vocabularios";

//  Nombre de usuario - login
$DBCFG["DBLogin"] = "vea";

//  Passwords
$DBCFG["DBPass"] = "password";

//  Prefijo para tablas # Prefix for tables
//$DBCFG["DBprefix"] = "bnm_";

$DBCFG["DBcharset"] = "utf8";

//  modo debug = 1 // debug mode = 1
$DBCFG["debugMode"] = "1";

// Define if storage hashed passwords or not  (1 = Yes, 0 = No: default: 0)
define('CFG_HASH_PASS','1');

/*  In almost cases, you don't need to touch nothing here!!
 *  Absolute path to the directory where are located /common/include.
 */

// change to whatever timezone you want
if(date_default_timezone_get()!=ini_get('date.timezone')){
	date_default_timezone_set('Etc/UTC');
}

if ( ! defined('T3_ABSPATH') )
	/** Use this for version of PHP < 5.3 */
	define('T3_ABSPATH', dirname(dirname(__FILE__)) . '/');

	/** Use this for version of PHP >= 5.3	*/
	//~ define('T3_ABSPATH', dirname(__DIR__) . '/');

	/** Use to define specific local path for common/include directory */
	//~ define('T3_ABSPATH', '/home/my_name/tematres/');
