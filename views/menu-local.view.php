<!DOCTYPE html>
<html lang="es">

    <head>
        <link href="common/css/local.css" rel="stylesheet">
        <link href="common/css/icono-arg.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy|Work+Sans|Open+Sans|Roboto" rel="stylesheet">

        <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
    </head>

    <body>

        <div class="container-fluid vocabularies">
            <div class="header">
                <h1>Ese vocabulario no existe. Probá con alguno de estos...</h1>
            </div>

            <div class="boxes">

                <?php foreach ($vocabularies as $k => $v) : ?>
                    <a href="<?= $CFG['URL'] . $k ?>" class="box <?= $v['style'] ?>">
                        <i class="<?= $v['icon'] ?>"></i>
                        <?= $v['title'] ?>
                    </a>
                <?php endforeach; ?>

            </div>

        </div>

        <div class="push"></div>

    </body>
</html>
