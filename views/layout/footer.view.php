<div id="footer" class="footer">
    <div class="container">

        <?= ( ! $_GET["letra"]) ? HTMLlistaAlfabeticaUnica() : '' ?>

        <p class="navbar-text pull-left">

            <?= (CFG_ENABLE_SPARQL == 1) ? '<a class="label label-info" href="'.URL_BASE.'sparql" title="'.LABEL_SPARQLEndpoint.'">'.LABEL_SPARQLEndpoint.'</a>' : '' ?>

            <?= (CFG_SIMPLE_WEB_SERVICE == 1) ? '<a class="label label-info" href="'.URL_BASE.'services" title="'.API.'"><span class="glyphicon glyphicon-share"></span> API</a>' : '' ?>

            <a class="label label-info" href="<?= URL_BASE ?>xml?rss=true" title="RSS">
                <span class="icon icon-rss"></span> RSS
            </a>
            <a class="label label-info" href="<?= URL_BASE ?>index?s=n" title="<?= ucfirst(LABEL_showNewsTerm) ?>">
                <span class="glyphicon glyphicon-fire"></span> <?= ucfirst(LABEL_showNewsTerm) ?>
            </a>

        </p>

        <?php echo doMenuLang($metadata["arraydata"]["tema_id"]); ?>

    </div>
</div>
