<nav class="navbar">

    <div class="container-fluid">
        <a class="link link-hidden" title="Inicio" href="<?= URL_BASE ?>index">
            <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
            <span class="sr-only">Inicio</span>
        </a>

        <div class="search">
            <a href="#" class="toggle"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></a>
            <form class="brand" method="get" id="simple-search" name="simple-search" action="<?= URL_BASE ?>index">
                <input id="query" name="<?= FORM_LABEL_buscar ?>" type="search">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"><span class="sr-only">
                        <?= LABEL_Buscar ?>
                    </span></span>
                </button>
            </form>
        </div>

        <div class="section section-left">
            <?php if ( ! $_SESSION[$_SESSION["CFGURL"]]["ssuser_nivel"]) : ?>
            <a class="link" title="<?= LABEL_busqueda ?>" href="<?= URL_BASE ?>index?xsearch=1">
                <?= ucfirst(LABEL_BusquedaAvanzada) ?>
            </a>
            <?php endif; ?>

            <div class="dropdown">
                <a href="#" class="link link-dropdown" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
                    <?= ucfirst(LABEL_Menu) ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-change">
                    <li>
                        <a title="<?= LABEL_busqueda ?>" href="<?= URL_BASE ?>index?xsearch=1">
                            <?= ucfirst(LABEL_BusquedaAvanzada) ?>
                        </a>
                    </li>
                    <li>
                        <a title="<?= LABEL__getForRecomendation ?>" href="<?= URL_BASE ?>index?taskterm=addTermSuggested">
                            <?= ucfirst(LABEL__getForRecomendation) ?>
                        </a>
                    </li>
                    <li class="dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?= ucfirst(LABEL_Ver) ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a title="'.ucfirst(LABEL_terminosLibres).'" href="<?= URL_BASE ?>index?verT=L">
                                    <?= ucfirst(LABEL_terminosLibres) ?>
                                </a>
                            </li>
                            <li>
                                <a title="'.ucfirst(LABEL_terminosRepetidos).'" href="<?= URL_BASE ?>index?verT=R">
                                    <?= ucfirst(LABEL_terminosRepetidos) ?>
                                </a>
                            </li>
                            <li>
                                <a title="'.ucfirst(LABEL_termsNoBT).'" href="<?= URL_BASE ?>index?verT=NBT">
                                    <?= ucfirst(LABEL_termsNoBT) ?>
                                </a>
                            </li>
                            <li>
                                <a title="'.ucfirst(LABEL_Aceptados).'" href="<?= URL_BASE ?>index?estado_id=13">
                                    <?= ucfirst(LABEL_Aceptados) ?>
                                </a>
                            </li>
                            <li>
                                <a title="'.ucfirst(LABEL_Rechazados).'" href="<?= URL_BASE ?>index?estado_id=14">
                                    <?= ucfirst(LABEL_Rechazados) ?>
                                </a>
                            </li>
                            <li>
                                <a title="'.ucfirst(LABEL_Candidatos).'" href="<?= URL_BASE ?>index?estado_id=12">
                                    <?= ucfirst(LABEL_Candidatos) ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a title="'.ucfirst(MENU_bulkTranslate).'" href="<?= URL_BASE ?>index?mod=trad">
                            <?= ucfirst(MENU_bulkTranslate) ?>
                        </a>
                    </li>
                    <li>
                        <a title="'.ucfirst(LABEL_FORM_simpleReport).'" href="<?= URL_BASE ?>index?mod=csv">
                            <?= ucfirst(LABEL_FORM_simpleReport) ?>
                        </a>
                    </li>
                    <li>
                        <a title="'.ucfirst(LABEL_export).'" href="<?= URL_BASE ?>doAdmin=export">
                            <?= ucfirst(LABEL_export) ?>
                        </a>
                    </li>
                    <li>
                        <a title="'.ucfirst(LABEL_auditoria).'" href="<?= URL_BASE ?>auditoria">
                            <?= ucfirst(LABEL_auditoria) ?>
                        </a>
                    </li>
                </ul>
            </div>
            <a class="link" title="<?= ucfirst(MENU_AgregarT) ?>" href="<?= URL_BASE ?>index?taskterm=addTerm&amp;tema=0">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>

        </div>

        <div class="section section-right">
            <div class="dropdown">
                <a href="#" class="link link-dropdown" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
                    <?= ucfirst(MENU_Sobre) ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a title="<?= MENU_Sobre ?>" href="<?= URL_BASE ?>sobre">
                            <?= ucfirst(MENU_Stats) ?>
                        </a>
                    </li>
                    <li>
                        <a title="Ultimos *" href="<?= URL_BASE ?>index?s=n">
                            <?= ucfirst(LABEL_newsTerm) ?>
                        </a>
                    </li>

                    <?php (CFG_ENABLE_SPARQL == 1) ? '<li><a title="' . LABEL_SPARQLEndpoint . '" href="' . URL_BASE . 'sparql">' . LABEL_SPARQLEndpoint . '</a></li>' : '' ?>

                    <?php (CFG_SIMPLE_WEB_SERVICE == 1) ? '<li><a title="API" href="' . URL_BASE . 'services">API</a></li>' : '' ?>

                </ul>
            </div>

            <?php if ($_SESSION[$_SESSION["CFGURL"]]["ssuser_nivel"]) : ?>
            <div class="dropdown">
                <a href="#" class="link link-dropdown" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    <span class="sr-only"><?= ucfirst(LABEL_Admin) ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a title="<?= ucfirst(LABEL_lcConfig) ?>" href="<?= URL_BASE ?>admin?vocabulario_id=list">
                            <?= ucfirst(LABEL_lcConfig) ?>
                        </a>
                    </li>
                    <li>
                        <a title="<?= ucfirst(MENU_Usuarios) ?>" href="<?= URL_BASE ?>admin?user_id=list">
                            <?= ucfirst(MENU_Usuarios) ?>
                        </a>
                    </li>
                    <li>
                        <a title="<?= ucfirst(MENU_bulkEdition) ?>" href="<?= URL_BASE ?>admin?doAdmin=bulkReplace">
                            <?= ucfirst(MENU_bulkEdition) ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="dropdown">
                <a href="#" class="link link-dropdown" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <span class="sr-only"><?= ucfirst(LABEL_Admin) ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a title="<?= MENU_MisDatos ?>" href="<?= URL_BASE ?>login">
                            <?= MENU_MisDatos ?>
                        </a>
                    </li>
                    <li>
                        <a title="<?= MENU_MisDatos ?>" href="<?= URL_BASE ?>auditoria?user_id=<?= secure_data($_SESSION[$_SESSION["CFGURL"]]["ssuser_id"]) ?>">
                            <?= MENU_MisTerminos ?>
                        </a>
                    </li>

                    <li>
                        <a title="<?= MENU_Salir ?>" href="<?= URL_BASE ?>index?cmdlog=<?= substr(md5(date("Ymd")),"5","10") ?>">
                            <?= MENU_Salir ?>
                        </a>
                    </li>
                </ul>
            </div>
            <?php else : ?>
            <a class="link" href="<?= URL_BASE ?>login" title="<?= MENU_MiCuenta ?>">
                <?= MENU_MiCuenta ?>
            </a>
            <?php endif; ?>

        </div>
    </div>

</nav>
