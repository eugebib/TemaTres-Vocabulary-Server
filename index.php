<?php

/*
 *      index.php
 *
 *      Copyright 2013 diego <tematres@r020.com.ar>
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


require 'config/config.local.php';


// get vocabulary

preg_match('#(\w+)\/?(\w+)?#', $uri, $matches);

$vocabulary = $matches[1];

if ( ! isset($vocabulary) || ! in_array($vocabulary, $vocabularies)) {
    echo 'No existe vocabulario. Probá con... <br>';
    foreach ($vocabularies as $voc) {
        echo '<a href="' . $DBCFG['URL'] . $voc . '">' . $voc . '</a><br>';
    }
    die;
}

// assign table

$DBCFG["DBprefix"] = $prefixes[$vocabulary];

// get page

if ( ! isset($matches[2]) || ! in_array($matches[2], array('admin', 'index', 'install', 'login', 'modal', 'services', 'sobre', 'sparql', 'xml'))) {
    $page = 'index';
} else {
    $page = $matches[2];
}

define('URL_BASE', $DBCFG['URL'] . $vocabulary. '/');

require('vocab/' . $page . '.php');
