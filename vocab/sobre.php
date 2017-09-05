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
$top      = getQtyXTop();

?>

<!DOCTYPE html>
<html lang="<?php echo LANG;?>">
    <head>
        <?php echo HTMLheader($metadata);?>
    </head>
    <body>
        <?php echo HTMLnavHeader(); ?>
        <div class="container sobre">
            <?php
                $resumen          = ARRAYresumen($_SESSION["id_tesa"],"G","");
                $fecha_crea       = do_fecha($_SESSION["CFGCreacion"]);
                $fecha_mod        = do_fecha($_SESSION["CFGlastMod"]);
                $ARRAYmailContact = ARRAYfetchValue('CONTACT_MAIL');
            ?>

            <h1><?= LABEL_Info;?></h1>
            <dl>
                <div class="flex">
                    <dt><?php echo mb_strtoupper(LABEL_Autor, 'UTF-8');?></dt>
                    <dd><?php echo $_SESSION[CFGAutor];?> </dd>
                </div>
                <div class="flex">
                    <dt><?php echo mb_strtoupper(LABEL_URI, 'UTF-8');?></dt>
                    <dd><?php echo $_SESSION[CFGURL];?> </dd>
                </div>
                <div class="flex">
                    <dt><?php echo mb_strtoupper(LABEL_Idioma, 'UTF-8');?></dt>
                    <dd><?php echo $_SESSION[CFGIdioma];?></dd>
                </div>
                <?php if ($ARRAYmailContact["value"]) : ?>
                    <div class="flex">
                        <dt><?php echo mb_strtoupper(FORM_LABEL__contactMail, 'UTF-8');?></dt>
                        <dd><?php echo $ARRAYmailContact["value"];?></dd>
                    </div>
                <?php endif; ?>
                <div class="flex">
                    <dt><?php echo mb_strtoupper(LABEL_Fecha, 'UTF-8');?></dt>
                    <dd><?php echo $fecha_crea[dia].'/'.$fecha_crea[mes].'/'.$fecha_crea[ano];?></dd>
                </div>
                <div class="flex">
                    <dt><?php echo mb_strtoupper(LABEL_lastChangeDate, 'UTF-8');?></dt>
                    <dd><?php echo $fecha_mod[dia].'/'.$fecha_mod[mes].'/'.$fecha_mod[ano];;?>
                </div>
                <?php if ($_SESSION[CFGKeywords]) : ?>
                    <div class="flex">
                        <dt><?php echo mb_strtoupper(LABEL_Keywords, 'UTF-8');?></dt>
                        <dd><?php echo $_SESSION[CFGKeywords];?></dd>
                    </div>
                <?php endif; ?>
                <?php if ($_SESSION[CFGTipo]) : ?>
                    <div class="flex">
                        <dt><?php echo mb_strtoupper(LABEL_TipoLenguaje, 'UTF-8');?></dt>
                        <dd><?php echo $_SESSION[CFGTipo];?></dd>
                    </div>
                <?php endif; ?>
                <?php if ($_SESSION[CFGCobertura]) : ?>
                    <div class="flex">
                        <dt><?php echo mb_strtoupper(LABEL_Cobertura, 'UTF-8');?></dt>
                        <dd><?php echo $_SESSION[CFGCobertura];?></dd>
                    </div>
                <?php endif; ?>
                <?php if ($_SESSION[CFGDerechos]) : ?>
                    <div class="flex">
                        <dt><?php echo mb_strtoupper(LABEL_Derechos, 'UTF-8');?></dt>
                        <dd><?php echo $_SESSION[CFGDerechos];?></dd>
                    </div>
                <?php endif; ?>
                <?php if (CFG_ENABLE_SPARQL==1) : ?>
                    <div class="flex">
                        <dt><?= mb_strtoupper(LABEL_SPARQLEndpoint);?></dt>
                        <dd><a href="<?= URL_BASE;?>sparql.php" title="<?= LABEL_SPARQLEndpoint;?>"><?= $_SESSION["CFGURL"];?>sparql.php</a></dd>
                    </div>
                <?php endif; ?>
                <?php if (CFG_SIMPLE_WEB_SERVICE == 1) : ?>
                    <div class="flex">
                        <dt>API</dt>
                        <dd><a href="<?= URL_BASE;?>services.php" title="API"><?= $_SESSION["CFGURL"];?>services.php</a></dd>
                    </div>
                <?php endif; ?>
                <div class="flex">
                    <dt><?= mb_strtoupper(LABEL_Terminos, 'UTF-8');?></dt>
                    <dd>
                        <?= $resumen[cant_total]; ?>
                        <?= '<a class="label label-info pull-right" href="'.URL_BASE.'index.php?s=n" title="'.mb_strtoupper(LABEL_showNewsTerm, 'UTF-8').'">
                                <span class="glyphicon glyphicon-fire"></span>' .
                                mb_strtoupper(LABEL_showNewsTerm, 'UTF-8').'
                            </a>'; ?>
                    </dd>
                </div>
                <div class="flex">
                    <dt><?= 'TÉRMINOS POR CATEGORÍA'; ?></dt>
                    <dd>
                        <div id="chart_div"></div>
                    </dd>
                </div>
            	<?php if ($_SESSION[$_SESSION["CFGURL"]]["CFG_VIEW_STATUS"]==1 && $resumen[cant_candidato] > 0): ?>
                    <div class="flex">
                    	<dt><?= mb_strtoupper(LABEL_Candidatos, 'UTF-8');?></dt>
                        <dd><a href="'.URL_BASE.'index.php?estado_id=12"><?= $resumen[cant_candidato];?></a></dd>
                    </div>
                <?php endif;?>
                <?php if ($_SESSION[$_SESSION["CFGURL"]]["CFG_VIEW_STATUS"]==1 && $resumen[cant_rechazado] > 0): ?>
        		    <div class="flex">
                        <dt><?= mb_strtoupper(LABEL_Rechazados, 'UTF-8');?></dt>
                        <dd><a href="'.URL_BASE.'index.php?estado_id=14"><?= $resumen[cant_rechazado];?></a></dd>
                    </div>
                <?php endif;?>
                <?php if($_SESSION[$_SESSION["CFGURL"]]["ssuser_id"] && $_SESSION[$_SESSION["CFGURL"]]["_SHOW_TREE"]==1): ?>
                    <div class="flex">
                        <dt><?= mb_strtoupper(LABEL_termsXdeepLevel, 'UTF-8');?></dt>
                        <dd style="padding: 0px;"><?= HTMLdeepStats();?></dd>
                    </div>
                <?php endif; ?>
                <?php if($resumen[cant_rel] > 0): ?>
                    <div class="flex">
                        <dt><?php echo mb_strtoupper(LABEL_RelTerminos, 'UTF-8');?></dt>
                        <dd><?php echo $resumen[cant_rel];?></dd>
                    </div>
                <?php endif; ?>
                <?php if($resumen[cant_up] > 0): ?>
                    <div class="flex">
                        <dt><?php echo mb_strtoupper(LABEL_TerminosUP, 'UTF-8');?></dt>
                        <dd><?php echo $resumen[cant_up];?></dd>
                    </div>
                <?php endif; ?>
                <?php
                if (is_array($resumen["cant_notas"])) {
                    $sqlNoteType=SQLcantNotas();
                    $arrayNoteType=array();
                    while ($array=$sqlNoteType->FetchRow()) {
    			  		if($array[cant]>0) {
    			  		 	echo '<div class="flex"><dt>';
    				  		echo (in_array($array["value_id"],array(8,9,10,11,15))) ? arrayReplace(array(8,9,10,11,15),array(mb_strtoupper(LABEL_NA, 'UTF-8'),mb_strtoupper(LABEL_NH, 'UTF-8'),mb_strtoupper(LABEL_NB, 'UTF-8'),mb_strtoupper(LABEL_NP, 'UTF-8'),mb_strtoupper(LABEL_NC, 'UTF-8')),$array["value_id"]) : $array["value"];
    				    	echo '</dt><dd> '.$array[cant].'</dd></div>';
    			  		}
                    };
                }
                if ($_SESSION[$_SESSION["CFGURL"]]["ssuser_id"]) {
                    //es admin y quiere ver un usuario
                    if(($_GET[user_id])	&&	($_SESSION[$_SESSION["CFGURL"]][ssuser_nivel]==1)) {
                        echo doBrowseTermsFromUser(secure_data($_GET[user_id],$_GET[ord]));
                        //no es admin y quiere verse a si mismo
                    } elseif($_GET[user_id]) {
                        echo doBrowseTermsFromUser(secure_data($_SESSION[$_SESSION["CFGURL"]][ssuser_id],"sql"),secure_data($_GET[ord],"sql"));
                        //quiere ver un año
                    } elseif($_GET[y]) {
                        echo doBrowseTermsFromDate(secure_data($_GET[m],"sql"),secure_data($_GET[y],"sql"),secure_data($_GET[ord],"sql"));
                    } else {
                		//ver lista agregada
                		echo doBrowseTermsByDate();
                    }
                };
                ?>
                <div class="flex">
                    <dt><?php echo mb_strtoupper(LABEL_Version, 'UTF-8'); ?></dt>
                    <dd><a href="http://www.vocabularyserver.com/" title="TemaTres: vocabulary server"><?php echo $CFG["Version"];?></a></dd>
                </div>
            </dl>
        </div>

        <?php echo footer(); ?>
        <?php echo HTMLjsInclude();?>

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
