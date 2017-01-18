<?php

    switch ($_GET['img']) {
        case 'logo':
            $width = 200;
            $height = 100;
            break;

        case 'header':
            $width = 1265;
            $height = 246;
            break;
    }

    if ( ! $_FILES['image']['name'] || empty($_FILES['image']['name'])) {
        header('Location:admin.php?vocabulario_id=list&upload_code=1');
        die;
    }

    if ($_FILES['image']['error']) {
        header('Location:admin.php?vocabulario_id=list&upload_code=' . $_FILES['image']['error']);
        die;
    }

    $ext = explode('.', $_FILES['image']['name']);
    $ext = end($ext);

    if ($ext != 'png') {
        header('Location:admin.php?vocabulario_id=list&upload_code=2');
        die;
    }

    if ($_FILES['image']['size'] > (1024000)) {
        header('Location:admin.php?vocabulario_id=list&upload_code=3');
        die;
    }

    $dim = getimagesize($_FILES['image']['tmp_name']);

    if ($dim[0] > $width || $dim[1] > $height) {
        header('Location:admin.php?vocabulario_id=list&upload_code=4');
        die;
    }

    move_uploaded_file($_FILES['image']['tmp_name'], $_GET['img'] . '.png');

    header('Location:admin.php?vocabulario_id=list&upload_code=0');
