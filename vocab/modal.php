<?php

####################################################################
# TemaTres : aplicación para la gestión de lenguajes documentales  #
#                                                                  #
# Copyright (C) 2004-2017 Diego Ferreyra tematres@r020.com.ar      #
# Distribuido bajo Licencia GNU Public License, versión 2          #
# (de junio de 1.991) Free Software Foundation                     #
#                                                                  #
####################################################################


$metadata              = do_meta_tag();

//If tterm_id isset, is a foreing term
//falta elegir entre 3 tipos de fuente de metadata: tema_id,tterm_id, URL
$tterm_id              = (is_numeric(@$_GET["tterm_id"])) ? $_GET["tterm_id"] : 0;
$metadata["arraydata"] = ($tterm_id>0) ? ARRAYtargetTerm($metadata["arraydata"]["tema_id"],$tterm_id) : $metadata["arraydata"];

if (is_array($metadata["arraydata"])) echo HTMLmodalTerm($metadata);


#
# modal body for simple Term data
#
function HTMLmodalTerm($arrayTermData)
{
    //is foreing term
    if (isset($arrayTermData["arraydata"]["tterm_uri"])) {
        require_once(T3_ABSPATH . 'common/include/vocabularyservices.php');

        $arrayTterm                            = ttermFullMetadata($arrayTermData["arraydata"]["tterm_uri"]);
        $arrayTerm                             = ARRAYttermData(getURLdata($arrayTermData["arraydata"]["tterm_uri"]));
        $arrayTermData["arraydata"]["titTema"] = $arrayTterm["tterm"]["string"];
        $arrayTermData["arraydata"]["tema_id"] = $arrayTterm["tterm"]["term_id"];
        $URL_ttermData                         = URIterm2array($arrayTermData["arraydata"]["tterm_uri"]);
        //$HTMLtermRelations                   = HTMLsimpleForeignTerm($arrayTermData,$URL_ttermData);
        $HTMLtermRelations                     = HTMLsimpleForeignTerm1($arrayTterm,$URL_ttermData);
        $HTMLlinkTerm                          = '<a href="'.$URL_ttermData["tterm_url"].'" target="_blank" title="'.$arrayTermData["arraydata"]["titTema"].'">'.$arrayTermData["arraydata"]["titTema"].'</a>';

    } else {
        $HTMLtermRelations = HTMLsimpleTerm($arrayTermData);
        $HTMLlinkTerm      = HTMLlinkTerm(array("tema_id"=>$arrayTermData["arraydata"]["tema_id"],"tema"=>$arrayTermData["arraydata"]["titTema"]));
    }

    $rows='<!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">'.$HTMLlinkTerm.'</h4>
                    </div>
                    <div class="modal-body">
                        <div class="te">'.
                            $HTMLtermRelations["BTrows"].'
                        </div>
                        <div class="te">'.
                            $HTMLtermRelations["UFrows"].'
                        </div>
                        <div class="te">'.
                            $HTMLtermRelations["NTrows"].'
                        </div>
                        <div class="te">'.
                            $HTMLtermRelations["RTrows"].'
                        </div>
                        <div class="notas">'.
                            HTMLNotasTermino($arrayTermData["arraydata"]).'
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">'.ucfirst(LABEL_close).'</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

    return $rows;
}

