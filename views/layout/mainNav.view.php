<nav class="navbar navbar-inverse" role="navigation">

    <div class="container">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapsible">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" title="<?= MENU_Inicio ?> <?= $_SESSION["CFGTitulo"] ?>" href="<?= URL_BASE ?>">
            <?= MENU_Inicio ?>
        </a>
    </div>

    <div class="navbar-collapse collapse" id="navbar-collapsible">

        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="<?= URL_BASE ?>index?xsearch=1">
                    <?= ucfirst(LABEL_BusquedaAvanzada) ?>
                </a>
            </li>
            <li>
                <a href="<?= URL_BASE ?>sobre">
                    <?= MENU_Sobre ?>
                </a>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-left">

            <!-- with login -->
            <?php if($_SESSION[$_SESSION["CFGURL"]]["ssuser_nivel"]) : ?>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"><?= ucfirst(LABEL_Menu) ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">

                        <!-- Admin options -->
                        <?php if ($_SESSION[$_SESSION["CFGURL"]]["ssuser_nivel"] == '1') : ?>
                        <li class="dropdown dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?= LABEL_Admin ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?= URL_BASE ?>admin?vocabulario_id=list">
                                        <?= ucfirst(LABEL_lcConfig) ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= URL_BASE ?>admin?doAdmin=bulkReplace">
                                        <?= ucfirst(MENU_bulkEdition) ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= URL_BASE ?>admin?doAdmin=glossConfig">
                                        <?= ucfirst(MENU_glossConfig) ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= URL_BASE ?>admin?user_id=list">
                                        <?= ucfirst(MENU_Usuarios) ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= URL_BASE ?>admin?doAdmin=export">
                                        <?= ucfirst(LABEL_export) ?>
                                    </a>
                                </li>
                                <li class="dropdown dropdown-submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <?= ucfirst(LABEL_dbMantenimiento) ?>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="<?= URL_BASE ?>admin?doAdmin=reindex">
                                                <?= ucfirst(LABEL_reIndice) ?>
                                            </a>
                                        </li>

                                        <?php if (CFG_ENABLE_SPARQL == 1) : ?>
                                        <li>
                                            <a href="<?= URL_BASE ?>admin?doAdmin=updateEndpoint">
                                                <?= ucfirst(LABEL_updateEndpoint) ?>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <li>
                                            <a href="<?= URL_BASE ?>admin?doAdmin=import">
                                                <?= ucfirst(ucfirst) ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= URL_BASE ?>admin?doAdmin=massiverem">
                                                <?= ucfirst(MENU_massiverem) ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= URL_BASE ?>admin?opTbl=TRUE">
                                                <?= ucfirst(LABEL_OptimizarTablas) ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= URL_BASE ?>admin?doAdmin=updte1_6x1_7">
                                                <?= ucfirst(LABEL_update1_6x1_7) ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= URL_BASE ?>admin?doAdmin=updte1_5x1_6">
                                                <?= ucfirst(LABEL_update1_5x1_6) ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= URL_BASE ?>admin?doAdmin=updte1_4x1_5">
                                                <?= ucfirst(LABEL_update1_4x1_5) ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= URL_BASE ?>admin?doAdmin=updte1_3x1_4">
                                                <?= ucfirst(LABEL_update1_3x1_4) ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= URL_BASE ?>admin?doAdmin=updte1_1x1_2">
                                                <?= ucfirst(LABEL_update1_1x1_2) ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= URL_BASE ?>admin?doAdmin=updte1x1_2">
                                                <?= ucfirst(LABEL_update1x1_2) ?>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <!-- List menu -->
                        <li class="dropdown dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?= ucfirst(LABEL_Ver) ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a title="<?= ucfirst(LABEL_terminosLibres) ?>" href="<?= URL_BASE ?>index?verT=L">
                                        <?= ucfirst(LABEL_terminosLibres) ?>
                                    </a>
                                </li>
                                <li>
                                    <a title="<?= ucfirst(LABEL_terminosRepetidos) ?>" href="<?= URL_BASE ?>index?verT=R">
                                        <?= ucfirst(LABEL_terminosRepetidos) ?>
                                    </a>
                                </li>
                                <li>
                                    <a title="<?= ucfirst(LABEL_termsNoBT) ?>" href="<?= URL_BASE ?>index?verT=NBT">
                                        <?= ucfirst(LABEL_termsNoBT) ?>
                                    </a>
                                </li>
                                <li>
                                    <a title="<?= ucfirst(LABEL_Rechazados) ?>" href="<?= URL_BASE ?>index?estado_id=14">
                                        <?= ucfirst(LABEL_Rechazados) ?>
                                    </a>
                                </li>
                                <li>
                                    <a title="<?= ucfirst(LABEL_Candidatos) ?>" href="<?= URL_BASE ?>index?estado_id=12">
                                        <?= ucfirst(LABEL_Candidatos) ?>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- User menu -->
                        <li>
                            <a title="<?= LABEL_bulkTranslate ?>" href="<?= URL_BASE ?>index?mod=trad">
                                <?= ucfirst(MENU_bulkTranslate) ?>
                            </a>
                        </li>
                        <li>
                            <a title="<?= LABEL_FORM_simpleReport ?>" href="<?= URL_BASE ?>index?mod=csv">
                                <?= ucfirst(LABEL_FORM_simpleReport) ?>
                            </a>
                        </li>
                        <li>
                            <a title="<?= MENU_MisDatos ?>" href="<?= URL_BASE ?>login">
                                <?= ucfirst(MENU_MisDatos) ?>
                            </a>
                        </li>
                        <li>
                            <a title="<?= MENU_Salir ?>" href="<?= URL_BASE ?>index?cmdlog=<?= substr(md5(date("Ymd")),"5","10") ?>">
                                <?= ucfirst(MENU_Salir) ?>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a role="button" title="<?= ucfirst(MENU_AgregarT) ?>" href="<?= URL_BASE ?>index?taskterm=addTerm&amp;tema=0">
                        <?= ucfirst(MENU_AgregarT) ?>
                    </a>
                </li>
            </ul>
            <!-- no login -->
            <?php else : ?>
            <li>
                <a href="<?= URL_BASE ?>login">
                    <?= MENU_MiCuenta ?>
                </a>
            </li>
            <?php endif; ?>

        </ul>

        <form method="get" id="simple-search" name="simple-search" action="<?= URL_BASE ?>index" class="navbar-form">
            <div class="form-group" style="display:inline;">
                <div class="fill col2">
                    <input class="form-control" id="query" name="<?= FORM_LABEL_buscar ?>" <?= ($_GET["taskSearch"] == '1') ? 'autofocus' : '' ?> type="search">
                    <input class="btn btn-default" type="submit" value="<?= LABEL_Buscar ?>" />
                    <input type="hidden" name="taskSearch" id="taskSearch" value="1" />
                </div>
            </div>
        </form>

    </div>
</nav>
