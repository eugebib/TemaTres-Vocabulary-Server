<!-- rename as menu-local.view.php -->

<!DOCTYPE html>
<html lang="es">

    <head>
        <link href="common/css/local.css" rel="stylesheet">
    </head>

    <body>

        <div class="container-fluid vocabularies">
            <div class="header">
                <h1>Ese vocabulario no existe. Probá con alguno de estos...</h1>
            </div>

            <div class="boxes">

                <?php foreach ($vocabularies as $k => $v) : ?>
                    <a href="<?= $CFG['URL'] . $k ?>" class="box">
                        <?= $v['title'] ?>
                    </a>
                <?php endforeach; ?>

            </div>

        </div>

        <div class="push"></div>

    </body>
</html>

