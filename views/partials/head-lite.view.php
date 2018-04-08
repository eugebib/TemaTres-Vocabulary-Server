<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $metadata["metadata"] ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link href="<?= T3_WEBPATH ?>bootstrap/submenu/css/bootstrap-submenu.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link type="image/x-icon" href="<?= T3_WEBPATH ?>images/tematres.ico" rel="icon" />
    <link type="image/x-icon" href="<?= T3_WEBPATH ?>images/tematres.ico" rel="shortcut icon" />
    <link rel="stylesheet" type="text/css" href="<?php echo T3_WEBPATH;?>css/jquery.autocomplete.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo T3_WEBPATH;?>css/jqtree.css" />
    <link type="text/css" src="<?php echo T3_WEBPATH;?>bootstrap/forms/css/styles.css"/>
    <link href="<?= T3_WEBPATH ?>css/t3style.css" rel="stylesheet">

    <?php if (file_exists(T3_ABSPATH . 'common/css/' . $_SESSION['style'] . '.css')) : ?>
    <link href="<?= T3_WEBPATH ?>css/<?= $_SESSION['style'] ?>.css" rel="stylesheet">
    <?php endif; ?>

    <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy|Work+Sans|Open+Sans|Roboto" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
