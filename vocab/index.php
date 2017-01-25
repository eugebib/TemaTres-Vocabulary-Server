<?php

#########################################################################################
#                                                                       				#
#   TemaTres : aplicación para la gestión de lenguajes documentales 					#
#                                                                       				#
#   Copyright (C) 2004-2008 Diego Ferreyra tematres@r020.com.ar							#
#   Distribuido bajo Licencia GNU Public License, versión 2 (de junio de 1.991) 		#
#   Free Software Foundation															#
#																						#
#########################################################################################

	include("config.tematres.php");

	$metadata = do_meta_tag();

	/*term reporter*/
	if (($_GET[mod]=='csv') && (substr($_GET[task],0,3)=='csv') && ($_SESSION[$_SESSION["CFGURL"]][ssuser_id])) {
		return wichReport($_GET[task]);
	}

	$search_string = '';
	$search_string = (doValue($_GET,FORM_LABEL_buscar)) ? XSSprevent(doValue($_GET,FORM_LABEL_buscar)) : '';

?>
<!DOCTYPE html>
<html lang="<?php echo LANG;?>">
	<head>
		<?php echo HTMLheader($metadata);?>
	</head>
	<body>
		<?php echo HTMLnavHeader(); ?>
		<div id="wrap" class="container">
			<?php require_once(T3_ABSPATH . 'common/include/inc.inicio.php'); ?>
		</div>
		<?php echo footer(); ?>
		<?php echo HTMLjsInclude();?>
    </body>
</html>
