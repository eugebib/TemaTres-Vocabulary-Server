<div class="container">
    <div class="header">
        <h1>
            <a href="<?= URL_BASE ?>index" title="<?= $_SESSION['CFGTitulo'] . ': ' . MENU_ListaSis ?>">
                <?= ucfirst($_SESSION['CFGTitulo']) ?>
            </a>
        </h1>

        <?php if ($vocabulary['logoImg']) {
            if ($vocabulary['logoLink']) { ?>
                <a href="<?= $vocabulary['logoLink'] ?>" title="<?= $vocabulary['logoTitle'] ?>">
                    <img src="../img/<?= $vocabulary['logoImg'] ?>" height="50px">
                </a>
            <?php } else { ?>
                <img src="../img/<?= $vocabulary['logoImg'] ?>" height="50px" alt="<?= $vocabulary['logoTitle'] ?>">
            <?php }
        } ?>

    </div>
</div>
