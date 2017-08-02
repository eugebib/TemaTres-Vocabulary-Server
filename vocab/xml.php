<?php
###################################################################
# TemaTres : aplicación para la gestión de lenguajes documentales #
#                                                                 #
# Copyright (C) 2004-2008 Diego Ferreyra tematres@r020.com.ar     #
# Distribuido bajo Licencia GNU Public License, versión 2         #
# (de junio de 1.991) Free Software Foundation                    #
#                                                                 #
###################################################################


include("config.tematres.php");
if ($_GET[zthesTema]) {
	header('Content-Type: text/xml');
	echo do_zthes(do_nodo_zthes($_GET[zthesTema]));
}
if ($_GET[skosTema]) {
	header('Content-Type: text/xml');
	echo do_skos(do_nodo_skos($_GET[skosTema]));
}
if ($_GET[skosMeta] == 1) {
	header('Content-Type: text/xml');
	echo do_skos("",true);
}
if ($_GET[skosNode]) {
	header('Content-Type: text/xml');
	echo do_skosNode(do_nodo_skos($_GET[skosNode]));
}
if ($_GET[vdexTema]) {
	header('Content-Type: text/xml');
	echo do_VDEX($_GET[vdexTema]);
}
if ($_GET[bs8723Tema]) {
	header('Content-Type: text/xml');
	echo do_BS8723s(do_nodo_BS8723($_GET[bs8723Tema]));
}
if ($_GET[madsTema]) {
	header('Content-Type: text/xml');
	echo do_mads($_GET[madsTema]);
}
if ($_GET[xtmTema]) {
	header('Content-Type: text/xml');
	return do_topicMap($_GET[xtmTema]);
}
if ($_GET[dcTema]) {
	header('Content-Type: text/xml');
	return do_dublin_core($_GET[dcTema]);
}
if($_GET[jsonTema]) {
	header('Content-type: application/json');
	echo do_json($_GET[jsonTema]);
}
if($_GET[jsonldTema]) {
    header('Content-type: application/json');
	echo do_jsonld($_GET[jsonldTema]);
}
if ($_GET[rss]) {
	header('Content-Type: application/rss+xml');
	return do_rss();
}
if (($_SESSION[$_SESSION["CFGURL"]][ssuser_nivel] == '1') && ($_GET["dis"])) {
	switch ($_GET[dis]) {
		case 'zline':
			return doTotalZthes("line");
		break;
		case 'zfile':
			return doTotalZthes("file");
		break;
		case 'moodfile':
			return doTotalMoodle("file");
		break;
		case 'rline':
			return doTotalSkos("line");
		break;
		case 'rfile':
			$params = array("hasTopTerm"=>$_GET["hasTopTermSKOS"]);
			return doTotalSkos("file",$params);
		break;
		case 'vfile':
			return doTotalVDEX("file");
		break;
		case 'siteMap':
			return do_sitemap("file");
		break;
		case 'rxtm':
			return doTotalTopicMap("file");
		break;
		case 'lxtm':
			return doTotalTopicMap("line");
		break;
		case 'BSfile':
			return doTotalBS8723("file");
		break;
		case 'madsFile':
			return doTotalMADS("file");
		break;
		case 'wxr':
	        echo doTotalWXR("file");
    	break;
		case 'txt':
			header('Content-Type: text/plain');
			$params = array("hasTopTerm" => $_GET["hasTopTerm"],
				"includeNote"        => $_GET["includeNote"],
				"includeCreatedDate" => $_GET["includeCreatedDate"],
				"includeTopTerm"     => $_GET["includeTopTerm"],
				"includeModDate"     => $_GET["includeModDate"]);
			echo txtAlfabetico($params);
		break;
		case 'termAlpha':
			header('Content-Type: text/plain');
			echo TXTalphaList4term($_GET["term_id"], array("includeNote"=>array(),
				"includeCreatedDate" =>'0',
				"includeTopTerm"     =>'0',
				"includeModDate"     =>'0'));
		break;
		case 'termTree':
			header('Content-Type: text/plain');
			echo TXTtreeList4term($_GET["term_id"]);
		break;
		case 'jtxt':
			header('Content-Type: text/plain');
			echo txtJerarquico();
		break;
		case 'rsql':
			echo do_mysql_dump();
		break;
		// case 'rpdf':
		// 	$params = array(
		// 		"hasTopTerm"         => $_GET["hasTopTerm"],
		// 		"includeNote"        => $_GET["includeNote"],
		// 		"includeCreatedDate" => $_GET["includeCreatedDate"],
		// 		"includeTopTerm"     => $_GET["includeTopTerm"],
		// 		"includeModDate"     => $_GET["includeModDate"]
		// 	);
		// 	echo do_pdfAlpha($params);
		// break;
		case 'rpdf':
			$params = array(
				"hasTopTerm"  => $_GET["hasTopTerm"],
				"includeNote" => $_GET["includeNote"],
				"includeAlt"  => $_GET["includeAlt"]
			);
			echo do_pdfAlpha2($params);
		break;
		case 'spdf':
			$params = array("hasTopTerm" => $_GET["hasTopTerm"]);
			echo do_pdfSist($params);
		break;
		case 'jglossary':
			header('Content-type: application/json');
			$filname = string2url($_SESSION[CFGTitulo]).'.json';
			//echo makeGlossary($_GET["note4gloss"],array("altTerms"=>$_GET["includeAltLabel"]));
			return sendFile(makeGlossary($_GET["note4gloss"],array("altTerms"=>$_GET["includeAltLabel"])),"$filname");
		break;
	}
}
