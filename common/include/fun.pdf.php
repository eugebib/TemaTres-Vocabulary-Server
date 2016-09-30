<?php

class PDF extends FPDF
{
protected $col = 0; // Current column
protected $y0;      // Ordinate of column start
protected $HREF = '';

function WriteHTML($html)
{
    // Intérprete de HTML
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Etiqueta
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extraer atributos
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    // Etiqueta de apertura
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    // Etiqueta de cierre
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}

function SetStyle($tag, $enable)
{
    // Modificar estilo y escoger la fuente correspondiente
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    // Escribir un hiper-enlace
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}


function Header()
{
    if ($this->header==0) return;//turn off

    $title=latin1($_SESSION["CFGTitulo"]);

    $this->SetFont('OpenSans','B',10);
    $this->MultiCell(0,8,latin1($title.' / '.$_SESSION["CFGAutor"]),0,'L');
    /*$this->SetFont('OpenSans','',8);
    $title_link='<a href="'.URL_BASE.'" title="'.$title.'">'.URL_BASE.'</a>';
    $link=$this->WriteHTML($title_link);
    $this->Cell(0,10,$link,'0',0,'L');
    */
    $y=$this->GetY();
    $this->Line(10,$y,200,$y);
    $this->Ln(8);
    // Save ordinate
    $this->y0 = $this->GetY();
}

function Footer()
{
    if ($this->footer==0) return;//turn off
    // Page footer
    $this->SetY(-15);
    $this->SetFont('OpenSans','I',8);
    $this->SetTextColor(128);
    $this->Cell(0,10,$this->PageNo(),T,0,'C');
    $this->SetFont('OpenSans','',6);
    $this->Cell(-4,10,$_SESSION["CFGVersion"],T,0,'R','');
    $this->Image(T3_ABSPATH.'common/images/t3logo.png',198,285,0,0,'png','http://www.vocabularyserver.com');


}

function SetCol($col)
{
    // Set position at a given column
    $this->col = $col;
    $x = 10+$col*95;
    $this->SetLeftMargin($x);
    $this->SetX($x);
}

function AcceptPageBreak()
{
    // Method accepting or not automatic page break
    if($this->col<1)
    {
        // Go to next column
        $this->SetCol($this->col+1);
        // Set ordinate to top
        $this->SetY($this->y0);
        // Keep on page
        return false;
    }
    else
    {
        // Go back to first column
        $this->SetCol(0);
        // Page break
        return true;
    }
}

function ChapterTitle($label){
    // Title

    $this->SetFont('opensans','B',14);
    $this->SetFillColor(178,168,168);
    $this->Cell(0,8,$label,0,1,'L',true);
    $this->Ln(4);
    // Save ordinate
    $this->y0 = $this->GetY();
}


function PrintChapter($title, $letter,$params=array()){
    // Add chapter

    $sql=SQLterms4char($letter,$params["hasTopTerm"]);

    if(SQLcount($sql)==0) return;

    $this->AddPage();
    $this->header = 1;
    $this->footer = 1;
    $this->SetFont('opensans','B',14);
    $this->ChapterTitle($title);
    $this->ChapterBody($sql,$params);
}


function PrintCover($params=array()){

    GLOBAL $CFG;
    //turn off
    $this->footer = 0;
    $this->header = 0;

    $ARRAYmailContact=ARRAYfetchValue('CONTACT_MAIL');

    $this->AddFont('opensans','','opensans.php');
    $this->AddFont('opensans','B','opensansb.php');
    $this->AddFont('opensans','L','opensansl.php');
    $this->AddFont('opensans','I','opensansi.php');

    $this->AddPage();

    if (file_exists(T3_ABSPATH.'common/images/cabecera.png')) {
        $this->Image(T3_ABSPATH.'common/images/cabecera.png',null,null,190);
    } else {
        $this->Image(local_path . 'cabecera.png',null,null,190);
    }
    $this->Ln(40);

    $this->SetFont('opensans','B',36);
    $this->MultiCell(0,16,latin1($_SESSION["CFGTitulo"]),0,'C');
    $this->Ln(5);
    $this->SetFont('opensans','',15);
    $this->MultiCell(0,8,latin1($_SESSION["CFGAutor"]),0,'C');
    $this->SetFont('opensans','',10);
    if(strlen($ARRAYmailContact["value"])>0) {
        $this->MultiCell(0,8,latin1($ARRAYmailContact["value"]),0,'C');
    }
    if (file_exists(local_path . 'footer.png')) {
        $this->SetY(235);
        $this->Image(local_path . 'footer.png',null,null,190);
    }

    $this->AddPage();

    $this->SetFont('opensans','L',12);
    if (strlen($_SESSION["CFGCobertura"])>0) {
        $this->MultiCell(0,8,latin1(html2txt($_SESSION["CFGCobertura"])),1,'J');
        $this->Ln(5);
    }
    if (strlen($_SESSION["CFGContributor"])>0) {
        $this->MultiCell(0,8,latin1(LABEL_Contributor.': '.$_SESSION["CFGContributor"]),0,'L');
        $this->Ln(5);
    }
    if (strlen($_SESSION["CFGRights"])>0) {
        $this->MultiCell(0,8,latin1(LABEL_Rights.': '.$_SESSION["CFGRights"]),0,'L');
        $this->Ln(5);
    }
    $site_link = $this->WriteHTML('URL: <a href="'.URL_BASE.'">'.URL_BASE.'</a>');
    $this->MultiCell(0,8,$site_link,0,'L');
    $this->Ln(5);
    $this->SetFont('opensans','L',12);
    if (CFG_ENABLE_SPARQL==1) {
        $sparql_link=$this->WriteHTML(LABEL_SPARQLEndpoint.': <a href="'.URL_BASE.'sparql.php" title="'.LABEL_SPARQLEndpoint.'">'.URL_BASE.'sparql.php</a>');
        $this->MultiCell(0,8,$sparql_link,0,'L');
    }

    $this->Ln(20);
    $this->SetFont('opensans','B',12);
    $this->MultiCell(0,8,latin1(ucfirst(LABEL_references).':'),0,'L');
    $y=$this->GetY();
    $this->Line(10,$y,200,$y);
    $this->SetY($y+5);
    $this->SetFont('opensans','',10);

    //Relations
    if($params["includeTopTerm"]) $this->MultiCell(0,6,latin1('TT: '.TT_termino),0,'L');
    $this->MultiCell(0,6,latin1(TG_acronimo.':  '.TG_termino),0,'L');
    $this->MultiCell(0,6,latin1(TE_acronimo.':  '.TE_termino),0,'L');

    $sqlTypeRelations=SQLtypeRelations(3,0,true);
    while ($arrayTypeRelations=$sqlTypeRelations->FetchRow()){
        if($arrayTypeRelations["cant"]>0){

        $this->MultiCell(0,6,latin1($arrayTypeRelations["r_code"].$arrayTypeRelations["rr_code"].':  '.$arrayTypeRelations["r_value"]. ' ('.$arrayTypeRelations["rr_value"].')'),0,'L');

        }
    }

    $this->MultiCell(0,6,latin1(UP_acronimo.':  '.UP_termino),0,'L');
    $this->MultiCell(0,6,latin1(USE_termino.':  '.USE_termino),0,'L');

    $sqlTypeRelations=SQLtypeRelations(4,0,true);
    while ($arrayTypeRelations=$sqlTypeRelations->FetchRow()){
        if(($arrayTypeRelations["cant"]>0) && (!in_array($arrayTypeRelations["rr_code"],$CFG["HIDDEN_EQ"]))){

        $this->MultiCell(0,6,latin1($arrayTypeRelations["r_code"].$arrayTypeRelations["rr_code"].':  '.$arrayTypeRelations["r_value"]. ' ('.$arrayTypeRelations["rr_value"].')'),0,'L');

        }
    }

    $this->MultiCell(0,6,latin1(TR_acronimo.': '.TR_termino),0,'L');
    $sqlTypeRelations=SQLtypeRelations(2,0,true);
    while ($arrayTypeRelations=$sqlTypeRelations->FetchRow()){
        if($arrayTypeRelations["cant"]>0){

        $this->MultiCell(0,6,latin1($arrayTypeRelations["r_code"].$arrayTypeRelations["rr_code"].':  '.$arrayTypeRelations["r_value"]. ' ('.$arrayTypeRelations["rr_value"].')'),0,'L');

        }
    }


    //Notes
    if(is_array($params["includeNote"])){

    $sqlNoteType=SQLcantNotas();
    while ($arrayNoteType=$sqlNoteType->FetchRow()){

        if(($arrayNoteType["cant"]>0) && (in_array($arrayNoteType["tipo_nota"],$params["includeNote"]))){
            $arrayNoteType["value_code"] = str_replace('NA', NA_acronimo, $arrayNoteType["value_code"]);
            $this->MultiCell(0,6,latin1($arrayNoteType["value_code"].':  '.$arrayNoteType["value"]),0,'L');
            }
        }
    }

    $this->SetTextColor(108,101,101);
    $this->MultiCell(0,6,latin1(LABEL_Metatermino.':  '.NOTE_isMetaTermNote),0,'L');

    $this->SetXY(10,250);
    $this->SetTextColor(0,0,0);
    $this->MultiCell(0,6,latin1(ucfirst(LABEL_lastChangeDate).': '.substr(fetchlastMod(),0,10)),0,'L');
    $this->MultiCell(0,6,latin1(ucfirst(LABEL_printData).': '.date("Y-m-d")),0,'L');

    $tematres_link=$this->WriteHTML(LABEL_Version.': <a href="http://www.vocabularyserver.com">'.$_SESSION["CFGVersion"].'</a>');
    $this->MultiCell(0,6,latin1($tematres_link),0,'L');

 /*  $this->SetY(-10);
    $this->SetFont('OpenSans','I',8);
    $this->Cell(-4,10,$_SESSION["CFGVersion"],T,0,'R','');
    */
    $this->Image(T3_ABSPATH.'common/images/t3logo.png',198,285,0,0,'png','http://www.vocabularyserver.com');
    // Save ordinate
    $this->y0 = $this->GetY();
}


function ChapterBodyOld($sql_data,$params=array()){

GLOBAL $CFG;

while($arrayTerm=$sql_data->FetchRow()){

    #Mantener vivo el navegador
    $time_now = time();
    if ($time_start >= $time_now + 10) {
        $time_start = $time_now;
        header('X-pmaPing: Pong');
    };
    // Diferenciar entre términos preferidos y términos no preferidos o referencias
    // Si es no preferido o refencia: mostrar preferido y referido


if($arrayTerm["t_relacion"]){    //is altTerm
        //Remisiones de equivalencias y no preferidos
        $sqlNoPreferidos=SQLterminosValidosUF($arrayTerm["tema_id"]);
        while($arrayNoPreferidos=$sqlNoPreferidos->FetchRow()){

        if (!in_array($arrayNoPreferidos["rr_code"],$CFG["HIDDEN_EQ"])){
            $acronimo=arrayReplace ( array("4","5","6","7"),array(USE_termino,EQP_acronimo,EQ_acronimo,NEQ_acronimo),$arrayNoPreferidos["t_relacion"]);

            $referencia_mapeo = ($arrayNoPreferidos["vocabulario_id"]!=='1') ? ' ('.$arrayNoPreferidos["titulo"].')' : '';

            $this->SetFont('OpenSans','I',10);
            $this->MultiCell(80,5,latin1($arrayTerm["tema"].$referencia_mapeo),0,L);

            $this->SetFont('OpenSans','',8);
            $this->MultiCell(80,5,latin1($acronimo.$arrayNoPreferidos["rr_code"].': '.$arrayNoPreferidos["tema_pref"]),0,L);

            if($params["includeCreatedDate"]==1) $this->MultiCell(80,5,latin1(ucfirst(LABEL_fecha_creacion).': '.$arrayTerm[cuando]),0,L);
            if(($arrayTerm[cuando_final]>$arrayTerm[cuando]) && ($params["includeModDate"]==1)) $this->MultiCell(80,5,latin1(ucfirst(LABEL_fecha_modificacion).': '.$arrayTerm[cuando_final]),0,L);

            }//end if hidden
        };
        // Line break
        $this->Ln(2);

    } else { //prefered term
    //the term
    $this->SetFont('OpenSans','B',10);
    $this->SetTextColor(0,0,0);
    // Output justified text
    if ($arrayTerm["isMetaTerm"]) $this->SetTextColor(108,101,101);

    $this->MultiCell(80,5,latin1($arrayTerm["tema"]),0,L);
    $this->SetTextColor(0,0,0);
    //Show code
    if(($CFG["_SHOW_CODE"]=='1') && (strlen($arrayTerm["code"]>0))){
        $this->MultiCell(80,5,latin1(ucfirst(LABEL_CODE).': '.$arrayTerm["code"]),0,L);
    };

    $this->SetFont('OpenSans','',6);

    if($params["includeCreatedDate"]==1) $this->MultiCell(80,5,latin1(ucfirst(LABEL_fecha_creacion).': '.$arrayTerm["cuando"]),0,L);
    if(($arrayTerm[cuando_final]>$arrayTerm["cuando"]) && ($params["includeModDate"]==1)) $this->MultiCell(80,5,latin1(ucfirst(LABEL_fecha_modificacion).': '.$arrayTerm["cuando_final"]),0,L);

    /*  Notas  */
    //include or not notes
    if(is_array($params["includeNote"])) {
        $sqlNotas=SQLdatosTerminoNotas($arrayTerm["id_definitivo"]);
        while($arrayNotas=$sqlNotas->FetchRow()){
        $arrayNotas["label_tipo_nota"]=(in_array($arrayNotas["ntype_id"],array(8,9,10,11,15))) ? arrayReplace(array(8,9,10,11,15),array(LABEL_NA,LABEL_NH,LABEL_NB,LABEL_NP,LABEL_NC),$arrayNotas["ntype_id"]) : $arrayNotas["ntype_code"];

            if (in_array($arrayNotas["tipo_nota"],$params["includeNote"])){
            $this->MultiCell(80,5,$arrayNotas["tipo_nota"].': '.utf8_decode(html2txt($arrayNotas["nota"])),0,L);
            }
        };
    }

    #direct terms
    $this->SetFont('OpenSans','',8);

    if($params["includeTopTerm"]){
    //Top term
    $arrayMyTT=ARRAYmyTopTerm($arrayTerm["id_definitivo"]);
        if (($arrayMyTT["tema_id"]!==$arrayTerm["id_definitivo"]) && ($arrayMyTT["tema_id"]>0)) $this->MultiCell(80,5,latin1('TT: '.$arrayMyTT["tema"]),0,L);
    }
    #Fetch data about associated terms (BT,RT,UF)
    //Relaciones
    $sqlRelaciones=SQLverTerminoRelaciones($arrayTerm["id_definitivo"]);

    $arrayRelacionesVisibles=array(2,3,4,5,6,7); // TG/TE/UP/TR
    $i_target=0;
    while($arrayRelaciones=$sqlRelaciones->FetchRow()){
        $this->SetTextColor(0,0,0);

        if(in_array($arrayRelaciones["t_relacion"],$arrayRelacionesVisibles)){

            $acronimo=arrayReplace ( $arrayRelacionesVisibles,array(TR_acronimo,TG_acronimo,UP_acronimo,EQP_acronimo,EQ_acronimo,NEQ_acronimo),$arrayRelaciones["t_relacion"]);

            if(in_array($arrayRelaciones["t_relacion"],array(5,6,7))){
                //términos equivalentes .. se concatenan después de los TE/NT
                $label_target_vocabulary[].=' '.$acronimo.': '.$arrayRelaciones["tema"].' ('.$arrayRelaciones["titulo"].')';

            }elseif($arrayRelaciones["t_relacion"]==4){
                # is UF and not hidden UF
                if (!in_array($arrayRelaciones["rr_code"],$CFG["HIDDEN_EQ"])){
                        $this->Write(5,$acronimo.$arrayRelaciones["rr_code"].': ');
                        $this->SetFont('','I');
                        $this->MultiCell(80,5,latin1($arrayRelaciones["tema"]),0,L);
                        $this->SetFont('','');
                    }
            }else{//the RT and BT relations
                    $this->SetTextColor(0,0,0);
                    if ($arrayRelaciones["isMetaTerm"]) $this->SetTextColor(108,101,101);
                    $this->SetFont('','');
                    $this->MultiCell(80,5,latin1($acronimo.$arrayRelaciones["rr_code"].': '.$arrayRelaciones["tema"]),0,L);

            }
        }
    }

    #narrower terms
    $SQLTerminosE=SQLverTerminosE($arrayTerm["tema_id"]);
    while($arrayTE=$SQLTerminosE->FetchRow()){

        $this->SetTextColor(0,0,0);

        if ($arrayTE["isMetaTerm"]) $this->SetTextColor(108,101,101);
        $this->MultiCell(80,5,TE_acronimo.$arrayTE[rr_code].': '.latin1($arrayTE["tema"]),0,L);
        };
    }

    //internal target terms
    if(count($label_target_vocabulary)>0){
        foreach($label_target_vocabulary as $each_target_term){
        $this->MultiCell(80,5,latin1($each_target_term),0,L);
        }
    }

    //mapped target terms
    $SQLtargetTerms=SQLtargetTerms($arrayTerm["id_definitivo"]);
    while($arrayTargetT=$SQLtargetTerms->FetchRow()){
        $this->MultiCell(80,5,latin1(ucfirst($arrayTargetT["tvocab_label"].': '.$arrayTargetT["tterm_string"])),0,L);
    };

    //mapped URLs terms
    $SQLURI4term=SQLURIxterm($arrayTerm["id_definitivo"]);
    while($arrayURI4term=$SQLURI4term->FetchRow()){
        $this->MultiCell(80,5,latin1(ucfirst($arrayURI4term["uri_value"].': '.$arrayURI4term["uri"])),0,L);
    };

    $this->Ln(3);

}//end while term
    $this->SetCol(0);

}




function ChapterBody($sql_data,$params=array()){

GLOBAL $CFG;

while($arrayTerm=$sql_data->FetchRow()){

    #Mantener vivo el navegador
    $time_now = time();
    if ($time_start >= $time_now + 10) {
        $time_start = $time_now;
        header('X-pmaPing: Pong');
    };
    // Diferenciar entre términos preferidos y términos no preferidos o referencias
    // Si es no preferido o refencia: mostrar preferido y referido


if($arrayTerm["t_relacion"]){    //is altTerm
        //Remisiones de equivalencias y no preferidos
        $sqlNoPreferidos=SQLterminosValidosUF($arrayTerm["tema_id"]);
        while($arrayNoPreferidos=$sqlNoPreferidos->FetchRow()){

        if (!in_array($arrayNoPreferidos["rr_code"],$CFG["HIDDEN_EQ"])){
            $acronimo=arrayReplace ( array("4","5","6","7"),array(USE_termino,EQP_acronimo,EQ_acronimo,NEQ_acronimo),$arrayNoPreferidos["t_relacion"]);

            $referencia_mapeo = ($arrayNoPreferidos["vocabulario_id"]!=='1') ? ' ('.$arrayNoPreferidos["titulo"].')' : '';

            $this->SetFont('OpenSans','I',10);
            $this->MultiCell(80,5,latin1($arrayTerm["tema"].$referencia_mapeo),0,L);

            $this->SetFont('OpenSans','',8);
            $this->MultiCell(80,5,latin1($acronimo.': '.$arrayNoPreferidos["tema_pref"]),0,L);

            $this->SetFont('OpenSans','',6);
            if($params["includeCreatedDate"]==1) $this->MultiCell(80,5,latin1(ucfirst(LABEL_fecha_creacion).': '.$arrayTerm[cuando]),0,L);
            if(($arrayTerm[cuando_final]>$arrayTerm[cuando]) && ($params["includeModDate"]==1)) $this->MultiCell(80,5,latin1(ucfirst(LABEL_fecha_modificacion).': '.$arrayTerm[cuando_final]),0,L);

            }//end if hidden
        };
        // Line break
        $this->Ln(2);

    } else { //prefered term
    //the term
    $this->SetFont('OpenSans','B',12);
    $this->SetTextColor(0,0,0);
    // Output justified text
    if ($arrayTerm["isMetaTerm"]) $this->SetTextColor(108,101,101);

    $this->MultiCell(80,5,latin1($arrayTerm["tema"]),0,L);
    $this->SetTextColor(0,0,0);
    //Show code
    if(($CFG["_SHOW_CODE"]=='1') && (strlen($arrayTerm["code"]>0))){
        $this->MultiCell(80,5,latin1(ucfirst(LABEL_CODE).': '.$arrayTerm["code"]),0,L);
    };

    $this->SetFont('OpenSans','',8);

    if($params["includeCreatedDate"]==1) $this->MultiCell(80,5,latin1(ucfirst(LABEL_fecha_creacion).': '.$arrayTerm["cuando"]),0,L);
    if(($arrayTerm[cuando_final]>$arrayTerm["cuando"]) && ($params["includeModDate"]==1)) $this->MultiCell(80,5,latin1(ucfirst(LABEL_fecha_modificacion).': '.$arrayTerm["cuando_final"]),0,L);

    /*  Notas  */
    //include or not notes
    if(is_array($params["includeNote"])) {
        $sqlNotas=SQLdatosTerminoNotas($arrayTerm["id_definitivo"]);
        while($arrayNotas=$sqlNotas->FetchRow()){
        $arrayNotas["tipo_nota"]=(in_array($arrayNotas["ntype_id"],array(8,9,10,11,15))) ? arrayReplace(array(8,9,10,11,15),array(NA_acronimo,NH_acronimo,NB_acronimo,NP_acronimo,NC_acronimo),$arrayNotas["ntype_id"]) : $arrayNotas["ntype_code"];
            if (in_array($arrayNotas["tipo_nota"],$params["includeNote"])){
            $arrayNotas["tipo_nota"] = str_replace('NA', NA_acronimo, $arrayNotas["tipo_nota"]);
            $this->MultiCell(80,5,$arrayNotas["tipo_nota"].': '.utf8_decode(html2txt($arrayNotas["nota"])),0,L);
            }
        };
    }

    #direct terms
    $this->SetFont('OpenSans','',8);

    if($params["includeTopTerm"]){
    //Top term
    $arrayMyTT=ARRAYmyTopTerm($arrayTerm["id_definitivo"]);
        if (($arrayMyTT["tema_id"]!==$arrayTerm["id_definitivo"]) && ($arrayMyTT["tema_id"]>0)) $this->MultiCell(80,5,latin1('TT: '.$arrayMyTT["tema"]),0,L);
    }
    #Fetch data about associated terms (BT,RT,UF)
    //Relaciones
    $sqlRelaciones=SQLdirectTerms($arrayTerm["id_definitivo"]);

    $arrayRelacionesVisibles=array(2,3,4,5,6,7); // TG/TE/UP/TR
    $arrayRelacionesVisiblesUP=array(25,26,30,31,44); // SP/MS/AB/FT/H

    while($arrayRelaciones=$sqlRelaciones->FetchRow()){
        $this->SetTextColor(0,0,0);

        $acronimo=arrayReplace ( $arrayRelacionesVisibles,array(TR_acronimo,TG_acronimo,UP_acronimo,EQP_acronimo,EQ_acronimo,NEQ_acronimo),$arrayRelaciones["t_relacion"]);
        $acronimo_rr=arrayReplace ( $arrayRelacionesVisiblesUP,array('SP','MS','AB','FT','H'),$arrayRelaciones["rr_code"]);

        if($arrayRelaciones["t_relacion"]==4){
            # is UF and not hidden UF
            if (!in_array($acronimo_rr,$CFG["HIDDEN_EQ"])){
                $this->Write(5,$acronimo.$acronimo_rr.': ');
                $this->SetFont('','I');
                $this->MultiCell(80,5,latin1($arrayRelaciones["uf_tema"]),0,L);
                $this->SetFont('','');
            }
        }

        if($arrayRelaciones["t_relacion"]==3){
            if($arrayRelaciones["bt_tema"]){
                if ($arrayRelaciones["bt_isMetaTerm"]) $this->SetTextColor(108,101,101);
                $this->SetFont('','');
                $this->MultiCell(80,5,latin1(TG_acronimo/*.$arrayRelaciones["rr_code"]*/.': '.$arrayRelaciones["bt_tema"]),0,L);
                }
            }
            if($arrayRelaciones["nt_tema"]){
                if ($arrayRelaciones["nt_isMetaTerm"]) $this->SetTextColor(108,101,101);
                $this->SetFont('','');
                $this->MultiCell(80,5,latin1(TE_acronimo.$arrayRelaciones["rr_code"].': '.$arrayRelaciones["nt_tema"]),0,L);
                }
            if($arrayRelaciones["t_relacion"]==2){
            if($arrayRelaciones["rt_tema"]){
                if ($arrayRelaciones["rt_isMetaTerm"]) $this->SetTextColor(108,101,101);
                $this->SetFont('','');
                $this->MultiCell(80,5,latin1(TR_acronimo.$arrayRelaciones["rr_code"].': '.$arrayRelaciones["rt_tema"]),0,L);
                }
            }
    }


    //internal target terms
    $SQLiTargetTerms=SQLtermsInternalMapped($arrayTerm["id_definitivo"]);

    while($ARRAYiTargetTerms=$SQLiTargetTerms->FetchRow()){

        $acronimo=arrayReplace (array(5,6,7),array(EQP_acronimo,EQ_acronimo,NEQ_acronimo),$ARRAYiTargetTerms["t_relacion"]);
        $this->MultiCell(80,5,latin1(' '.$acronimo.': '.$ARRAYiTargetTerms["tema"].' ('.$ARRAYiTargetTerms["titulo"].')'),0,L);
    };

    //mapped target terms
    $SQLtargetTerms=SQLtargetTerms($arrayTerm["id_definitivo"]);
    while($arrayTargetT=$SQLtargetTerms->FetchRow()){
        $this->MultiCell(80,5,latin1(ucfirst($arrayTargetT["tvocab_label"].': '.$arrayTargetT["tterm_string"])),0,L);
    };

    //mapped URLs terms
    $SQLURI4term=SQLURIxterm($arrayTerm["id_definitivo"]);
    while($arrayURI4term=$SQLURI4term->FetchRow()){
        $this->MultiCell(80,5,latin1(ucfirst($arrayURI4term["uri_value"].': '.$arrayURI4term["uri"])),0,L);
    };

    $this->Ln(3);

}//end while t_relation (is prefered or alt)
}//end while term
    $this->SetCol(0);
}

}//fin clase

?>
