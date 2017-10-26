<?php
####################################################################
# TemaTres : aplicación para la gestión de lenguajes documentales  #
#                                                                  #
# Copyright (C) 2004-2017 Diego Ferreyra tematres@r020.com.ar      #
# Distribuido bajo Licencia GNU Public License, versión 2          #
# (de junio de 1.991) Free Software Foundation                     #
#                                                                  #
####################################################################

include("config.tematres.php");
$metadata = do_meta_tag();

$top              = getQtyXTop();
$resumen          = ARRAYresumen($_SESSION["id_tesa"],"G","");
$fecha_crea       = do_fecha($_SESSION["CFGCreacion"]);
$fecha_mod        = do_fecha($_SESSION["CFGlastMod"]);
$ARRAYmailContact = ARRAYfetchValue('CONTACT_MAIL');

?>

<!DOCTYPE html>
<html lang="<?= LANG ?>">

    <head>
        <?= HTMLheader($metadata) ?>
    </head>

    <body>
        <?= HTMLnavHeader() ?>

        <div class="container">
            <div class="about">

                <div class="span2 vspan4">
                    <h3><?= $_SESSION["CFGTitulo"] ?></h3>

                    <?php if ($_SESSION["CFGCobertura"]) : ?>
                        <p class="about"><?= $_SESSION["CFGCobertura"] ?></p>
                    <?php endif ?>

                    <?php if ($_SESSION["CFGTipo"] || $_SESSION["CFGKeywords"]) : ?>
                        <p class="about">
                            <?= ($_SESSION["CFGTipo"]) ? mb_strtoupper($_SESSION["CFGTipo"]) : '' ?><?= ($_SESSION["CFGTipo"] && $_SESSION["CFGKeywords"]) ? ', ' : '' ?><?= ($_SESSION["CFGKeywords"]) ? mb_strtoupper($_SESSION["CFGKeywords"]) : ''?>
                        </p>
                    <?php endif ?>

                    <p>Creado el <?= $fecha_crea["dia"].'/'.$fecha_crea["mes"].'/'.$fecha_crea["ano"] ?>. Actualizado al <?= $fecha_mod["dia"].'/'.$fecha_mod["mes"].'/'.$fecha_mod["ano"] ?>.</p>
                </div>

                <div class="span3 vspan2">
                    <h4>ENLACES</h4>
                    <p class='uri'><?= mb_strtoupper(LABEL_URI, 'UTF-8') ?>: <a href="<?= $_SESSION[CFGURL] ?>"><?= $_SESSION[CFGURL] ?></a></p>

                    <?php if (CFG_ENABLE_SPARQL == 1) : ?>
                        <p class='uri'><?= mb_strtoupper(LABEL_SPARQLEndpoint) ?>: <a href="<?= URL_BASE ?>sparql.php" title="<?= LABEL_SPARQLEndpoint ?>"><?= $_SESSION["CFGURL"] ?>sparql.php</a></p>
                    <?php endif ?>

                    <?php if (CFG_SIMPLE_WEB_SERVICE == 1) : ?>
                        <p class='uri'>API: <a href="<?= URL_BASE ?>services.php" title="API"><?= $_SESSION["CFGURL"] ?>services.php</a></p>
                    <?php endif ?>
                </div>

                <div class="vspan2">
                    <h4><?= mb_strtoupper(LABEL_Autor, 'UTF-8') ?></h4>
                    <p><?= $_SESSION["CFGAutor"] ?></p>
                    <?php if ($ARRAYmailContact["value"]) : ?>
                        <p><?= $ARRAYmailContact["value"] ?></p>
                    <?php endif ?>
                </div>

                <div class="vspan3 v-center">
                    <div class="text-center">
                        <p><?= $resumen["cant_total"] ?> <?= LABEL_Terminos ?></p>

                        <?php if ($resumen["cant_up"] > 0) : ?>
                            <p><?= $resumen["cant_up"] ?> <?= LABEL_TerminosUP ?></p>
                        <?php endif ?>

                        <?php if ($_SESSION[$_SESSION["CFGURL"]]["ssuser_id"] && $_SESSION[$_SESSION["CFGURL"]]["CFG_VIEW_STATUS"] == '1') : ?>
                            <?php if ($resumen["cant_candidato"] > 0) : ?>
                                <p>
                                    <a href="<?= URL_BASE ?>index.php?estado_id=12">
                                        <?= $resumen["cant_candidato"] ?> <?= $resumen["cant_candidato"] == 1 ? LABEL_Candidato : LABEL_Candidatos ?>
                                    </a>
                                </p>
                            <?php endif ?>

                            <?php if ($resumen["cant_rechazado"] > 0) : ?>
                                <p>
                                    <a href="<?= URL_BASE ?>index.php?estado_id=14">
                                        <?= $resumen["cant_rechazado"] ?> <?= $resumen["cant_rechazado"] == 1 ? LABEL_Rechazado : LABEL_Rechazados ?>
                                    </a>
                                </p>
                            <?php endif ?>
                        <?php endif ?>

                        <?php if ($resumen["cant_rel"] > 0) : ?>
                            <p><?= $resumen["cant_rel"] ?> <?= LABEL_relatedTerms ?></p>
                        <?php endif ?>

                    </div>
                </div>

                <?php if (is_array($resumen["cant_notas"])) : ?>
                    <div class="vspan3 v-center">
                        <div class="text-center">
                            <?php foreach ($resumen["cant_notas"] as $key => $value) : ?>
                                <p><?= $value ?> <?= strtolower($key) ?></p>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php endif ?>

                <div class="span2 vspan2">
                    <h4>ÚLTIMOS</h4>
                    <ul>
                    <?php foreach ($resumen['ultimos'] as $value) : ?>
                        <li><a href="<?= URL_BASE ?>index.php&tema=<?= $value['tema_id'] ?>"><?= $value['tema'] ?></a></li>
                    <?php endforeach ?>
                    </ul>
                    <a class="btn btn-warning" href="<?= URL_BASE ?>index.php?s=n" title="<?= mb_strtoupper(LABEL_showNewsTerm, 'UTF-8') ?>">
                        <?= mb_strtoupper(LABEL_showNewsTerm, 'UTF-8')?>
                    </a>
                </div>

                <?php if ($_SESSION[$_SESSION["CFGURL"]]['_SHOW_TREE'] == 1) : ?>
                    <div class="span2 vspan2">
                        <h4>TÉRMINOS POR CATEGORÍA</h4>
                        <div id="chart_div" style="background-color: white;"></div>
                    </div>
                <?php endif ?>

                <?php if($_SESSION[$_SESSION["CFGURL"]]["ssuser_id"] && $_SESSION[$_SESSION["CFGURL"]]["_SHOW_TREE"]==1) : ?>
                    <div class="vspan3">
                        <h4><?= mb_strtoupper(LABEL_termsXdeepLevel, 'UTF-8') ?></h4>
                        <?= HTMLdeepStats() ?>
                    </div>
                <?php endif ?>

<!--                 <?php if ($_SESSION[$_SESSION["CFGURL"]]["ssuser_id"]) {

                    if (($_GET["user_id"]) && ($_SESSION[$_SESSION["CFGURL"]]["ssuser_nivel"]==1)) { ?>
                        <div class="span3">
                            <?= doBrowseTermsFromUser(secure_data($_GET["user_id"],$_GET["ord"])) ?>
                        </div>

                    <?php } elseif($_GET["user_id"]) {
                        echo doBrowseTermsFromUser(secure_data($_SESSION[$_SESSION["CFGURL"]]["ssuser_id"],"sql"),secure_data($_GET[ord],"sql"));
                        //quiere ver un año
                    } elseif($_GET[y]) {
                        echo doBrowseTermsFromDate(secure_data($_GET["m"],"sql"),secure_data($_GET["y"],"sql"),secure_data($_GET["ord"],"sql"));
                    } else {
                        //ver lista agregada
                        echo doBrowseTermsByDate();
                    }
                } ?> -->

                <?php if ($_SESSION["CFGDerechos"]) : ?>
                    <div>
                        <h4><?= mb_strtoupper(LABEL_Derechos, 'UTF-8') ?></h4>
                        <p><?= $_SESSION["CFGDerechos"] ?></p>
                    </div>
                <?php endif ?>

                <div>
                    <h4><?= mb_strtoupper(LABEL_Version, 'UTF-8') ?></h4>
                    <a href="http://www.vocabularyserver.com/" title="TemaTres: vocabulary server"><?= $CFG["Version"] ?></a>
                </div>

            </div>
        </div>

        <?= footer() ?>
        <?= HTMLjsInclude() ?>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Categoría');
                data.addColumn('number', 'Slices');
                data.addRows([<?= $top ?>]);

                var options = {
                    chartArea: {
                        left: 20,
                        top: 10,
                        width: '75%',
                        height: '100%'
                    },
                    backgroundColor: 'transparent',
                    is3D: true,
                    sliceVisibilityThreshold: 0
                };

                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }

            $(window).resize(function(){
              drawChart();
            });

        </script>
    </body>
</html>

<?php

function getQtyXTop()
{
    $filename = T3_ABSPATH . 'vocab' .DIRECTORY_SEPARATOR . 'qtyXTop';
    if (file_exists($filename)) {
        $cache = file_get_contents($filename);
        $json  = json_decode($cache, true);
        if ($json['time'] > time() - 86400) {
            return $json['html'];
        }
    }

    $topes = SQLverTopTerm();
    while ($tope = $topes->FetchRow()) {
        $top .= '["'.$tope['tema'].'", '.cantChildTerms($tope['id']).'],';
    }

    $file = fopen($filename, "w");
    fwrite($file, json_encode(
        array(
            'time' => time(),
            'html' => $top,
        )
    ));
    fclose($file);

    return $top;
}
