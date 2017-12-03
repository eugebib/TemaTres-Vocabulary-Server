<?php

include("config.tematres.php");

if (! $_SESSION[$_SESSION["CFGURL"]]["ssuser_id"]) {
    header("Location:../index.php");
}

?>

<!DOCTYPE html>
<html lang="<?php echo LANG;?>">
    <head>
        <?php echo HTMLheader($metadata);?>
    </head>
    <body>
        <?php echo HTMLnavHeader(); ?>

        <div class="container">
            <div class="box">
                <div class="box-title">
                    <span><?= ucfirst(LABEL_auditoria) ?></span>
                    <div>
                        <a href="auditoria.php" class="btn btn-primary"><?= ucfirst(LABEL_Porfecha) ?></a>
                        <a href="auditoria.php?user_id=<?= secure_data($_SESSION[$_SESSION["CFGURL"]]["ssuser_id"]) ?>" class="btn btn-primary"><?= ucfirst(LABEL_Misterminos) ?></a>
                    </div>
                </div>

                <div class="table-content">

                    <?php
                    if ($_GET["user_id"]) {
                        echo doBrowseTermsFromUser(secure_data($_GET["user_id"],$_GET["ord"]));
                    } elseif ($_GET["y"]) {
                        echo doBrowseTermsFromDate(secure_data($_GET["m"],"sql"),secure_data($_GET["y"],"sql"),secure_data($_GET["ord"],"sql"));
                    } else {
                        echo doBrowseTermsByDate();
                    }
                    ?>

                </div>
            </div>
        </div>
        <?php echo footer(); ?>
        <?php echo HTMLjsInclude(); ?>
    </body>
</html>
