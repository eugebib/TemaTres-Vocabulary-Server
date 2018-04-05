<script type="text/javascript" src="<?=T3_WEBPATH ?>jq/jquery.autocomplete.js"></script>
<script type="text/javascript" src="<?=T3_WEBPATH ?>jq/jquery.mockjax.js"></script>
<script type="text/javascript" src="<?=T3_WEBPATH ?>jq/tree.jquery.js"></script>

<link rel="stylesheet" type="text/css" href="<?=T3_WEBPATH ?>css/jquery.autocomplete.css" />
<link rel="stylesheet" type="text/css" href="<?=T3_WEBPATH ?>css/jqtree.css" />
<script type="text/javascript" src="<?=T3_WEBPATH ?>bootstrap/submenu/js/bootstrap-submenu.min.js"></script>
<script type="text/javascript" src="<?=T3_WEBPATH ?>bootstrap/bootstrap-tabcollapse.js"></script>
<link type="text/css" src="<?=T3_WEBPATH ?>bootstrap/forms/css/styles.css"/>

<?php if (isset($_SESSION[$_SESSION["CFGURL"]]["ssuser_nivel"]) && ($_SESSION[$_SESSION["CFGURL"]]["ssuser_nivel"]>0)) : ?>
    <!-- Load TinyMCE -->
    <script type="text/javascript" src="<?=T3_WEBPATH ?>tiny_mce4/tinymce.min.js"></script>

    <link type="text/css" href="<?=T3_WEBPATH ?>jq/theme/ui.all.css" media="screen" rel="stylesheet" />
    <script type="text/javascript" src="<?=T3_WEBPATH ?>jq/jquery.jeditable.mini.js" charset="utf-8"></script>
<?php endif; ?>

<script type="application/javascript" src="<?=T3_WEBPATH ?>include/js.php" charset="utf-8"></script>
<script type="text/javascript" src="<?=T3_WEBPATH ?>forms/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=T3_WEBPATH ?>bootstrap/js/validator.min.js"></script>';

<?php  if ($_SESSION[$_SESSION["CFGURL"]]["lang"][2]!=='en') : ?>
    <script src="<?=T3_WEBPATH ?>forms/localization/messages_<?= $_SESSION[$_SESSION["CFGURL"]]["lang"][2] ?>.js" type="text/javascript"></script>
<?php endif; ?>

<script type="text/javascript">
    $("#myTermTab").tabCollapse();
    $(".dropdown-submenu > a").submenupicker();

    $(".termDefinition").popover();
    $("#popoverOption").popover({ trigger: "hover"});
    $(".autoGloss").tooltip();
</script>

<!-- script to export form -->
<?php if ((isset($_SESSION[$_SESSION["CFGURL"]]["ssuser_nivel"])) &&
         ($_SESSION[$_SESSION["CFGURL"]]["ssuser_nivel"]==1) &&
         ($_GET["doAdmin"]=='export')) : ?>
    <script type=\'text/javascript\'>//<![CDATA[
                $(window).load(function(){
                $(\'#dis\').bind(\'change\', function(event) {
                    var x = $(\'#dis\').val();
                    if ((x == "txt") || (x == "spdf") || (x == "rpdf")) {
                        $(\'#txt_config\').show();
                    }else{
                        $(\'#txt_config\').hide();
                    }
                    if ((x == "txt") || (x == "rpdf")) {
                        $(\'#txt_config2\').show();
                    } else {
                        $(\'#txt_config2\').hide();
                    }
                    if (x == "rfile") {
                        $(\'#skos_config\').show();
                    } else{
                        $(\'#skos_config\').hide();
                    }
                });
                });//]]>
    </script>
<?php endif; ?>
