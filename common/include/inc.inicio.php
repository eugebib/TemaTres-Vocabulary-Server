<?php
if ((stristr( $_SERVER['REQUEST_URI'], "session.php") ) || ( !defined('T3_ABSPATH') )) die("no access");
####################################################################
# TemaTres : aplicación para la gestión de lenguajes documentales  #
#                                                                  #
# Copyright (C) 2004-2017 Diego Ferreyra tematres@r020.com.ar      #
# Distribuido bajo Licencia GNU Public License, versión 2          #
# (de junio de 1.991) Free Software Foundation                     #
#                                                                  #
####################################################################

# Include para seleccionar include o función de visualizaicon de listas de términos #

//Antes de desplegar cotenidos => Echo mensajes de error
echo $MSG_PROC_ERROR["html"];

//Mostrar alfabeto
if ($_GET["letra"]) {
	$letra = isValidLetter($_GET["letra"]);
}

if ((strlen($letra)>0) && (strlen($letra)<5)) {

	echo '<div class="container" id="bodyText">';
	echo '<div class="row">';
	echo HTMLlistaAlfabeticaUnica($letra);
	echo HTMLterminosLetra($letra);
	echo '</div>';
	echo '</div>';

} elseif (strlen($search_string)>0) {

	//check again
	$search_string=XSSprevent($search_string);
	echo resultaBusca($search_string,$_GET["tipo"]);

} elseif( //Mostrar ficha de termino o crear término
	(is_numeric($metadata["arraydata"]["tema_id"])) ||
	($_GET["taskterm"]=='addTerm') ||
	($_GET["taskterm"]=='addTermSuggested')) {

	require_once(T3_ABSPATH . 'common/include/inc.vistaTermino.php');

} elseif (is_numeric($_GET[estado_id]) && ($_SESSION[$_SESSION["CFGURL"]][ssuser_id])) {

	//Vista de términos según estados
	echo '<div class="container" id="bodyText">';
	echo HTMLlistaTerminosEstado($_GET[estado_id],CFG_NUM_SHOW_TERMSxSTATUS);
	echo '</div>';

} elseif($_GET["s"]=='n') {

	//Vista de términos según estados
	echo '<div class="container" id="bodyText">';
	echo HTMLlistaTerminosFecha();
	echo '</div>';

} elseif(($_GET[xsearch]=='1')) {

	//Vista de busqueda avanzada
	echo '<div class="container" id="bodyText">';
	echo HTMLformAdvancedSearch($_GET);
	echo '</div>';

} elseif (($_GET[mod]=='csv') && ($_SESSION[$_SESSION["CFGURL"]][ssuser_id])) {

	echo '<div id="bodyText">'.
			HTMLformSimpleTermReport($_GET).
			HTMLformAdvancedTermReport($_GET).
			HTMLformNullNotesTermReport($_GET).
			HTMLformMappedTermReport($_GET).
		'</div>';

} elseif (($_SESSION[$_SESSION["CFGURL"]]["ssuser_id"])&&($_GET["mod"]=='trad')) {

	if ($_POST["task"]=='map4localTargetVocab') {
		$tasks=addLocalTargetTerms($_POST["tvocab_id"],$_POST);
    }
  	$tvocab_id=($_GET["tvocab_id"]>1) ? $tvocab_id : 0;
	if ($tvocab_id>0) {
		if ($_GET["letra2trad"]) {  // sanitice $letra
			$letra=isValidLetter($_GET["letra2trad"]);
 		}
		echo FORMtransterm4char4map($tvocab_id,$_GET["filterEQ"],$letra);
	} else {
		echo HTMLselectTargetVocabulary();
    }

} elseif (($_SESSION[$_SESSION["CFGURL"]]["ssuser_id"])&&($_GET["verT"])) {

	echo '<div class="container" id="bodyText">';
	switch($_GET["verT"]){
		case 'L':
			if ($_POST["massive_task_freeterms"]=='assocfreeTerm') {
				echo HTMLformAssociateFreeTerms($_POST["deleteFreeTerms_id"],"");
			} else {
				echo HTMLformVerTerminosLibres($_POST["massive_task_freeterms"],$_POST["deleteFreeTerms_id"]);
			}
			break;

		case 'LA':
			echo HTMLformAssociateFreeTerms($_POST["freeTerms_id"],$_POST["taskterm"]);
			break;

		case 'R':
			echo HTMLformVerTerminosRepetidos();
			break;

		case 'NBT':
			echo HTMLformVerTerminosSinBT($_POST["taskterm"],$_POST["deleteTerms_id"]);
			break;
	}
	echo '</div>';

} else {

	echo '<div class="container" id="bodyText">';
	echo HTMLlistaAlfabeticaUnica($letra);
	if($_SESSION[$_SESSION["CFGURL"]]["_SHOW_RANDOM_TERM"]!=='0') echo HTMLdisplayRandomTerm($_SESSION[$_SESSION["CFGURL"]]["_SHOW_RANDOM_TERM"]);
	if ($_SESSION[$_SESSION["CFGURL"]]["_SHOW_TREE"]=='1') {
		echo HTMLtopTerms($letra);
	}
	echo '</div>';

}
