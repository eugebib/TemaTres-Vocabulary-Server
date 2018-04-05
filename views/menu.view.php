<?php

echo 'No existe vocabulario. Probá con... <br>';

foreach ($vocabularies as $k => $v) {
    echo '<a href="' . $CFG['URL'] . $k . '">' . $v['title'] . '</a><br>';
}
