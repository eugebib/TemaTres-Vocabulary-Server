<?php

// rename as config.local.php

$DBCFG['URL'] = '';

$uri          = $_SERVER['REQUEST_URI'];

$vocabularies = ['tesauro', 'test', 'nueva'];

$prefixes     = [
    'tesauro' => 'bnm_',
    'test'    => 'test_',
    'nueva'   => 'nueva_'
];
