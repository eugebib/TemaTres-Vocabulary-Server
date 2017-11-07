<?php

############################################################################
#                                                                          #
#   TemaTres : aplicación para la gestión de lenguajes documentales        #
#                                                                          #
#   Copyright (C) 2004-2017 Diego Ferreyra tematres@r020.com.ar            #
#   Distribuido bajo Licencia GNU Public License, versión 2 (de junio de   #
#   1.991) Free Software Foundation                                        #
#                                                                          #
############################################################################

if ((stristr( $_SERVER['REQUEST_URI'], "session.php") ) || ( !defined('T3_ABSPATH') )) die("no access");

#
# Buscador general según string
#
function APISQLbuscaSimple($texto)
{
    GLOBAL $DBCFG;

    $texto = trim($texto);
    $texto = preg_replace('/[^A-Za-z0-9\-]/', '', $texto);
    $words = explode(' ', $texto);

    foreach ($words as $key => $word) {
        if ($key == 0) {
            $text = '"%'.$word.'%"';
        } else {
            $text .= ' and tema.tema like "%'.$word.'%"';
        }
    }

    //Check is include or not meta terms
    $where.=(CFG_SEARCH_METATERM==0) ? " and tema.isMetaTerm=0 " : "";

    $sql=SQL("select","
            if(temasPreferidos.tema_id is not null,relaciones.id_menor,tema.tema_id) id_definitivo,
            tema.tema_id,
            tema.tema,
            tema.code,
            tema.estado_id,
            relaciones.t_relacion,
            temasPreferidos.tema as termino_preferido,
            tema.isMetaTerm,
            tema.notEquivalent,
            tema.notApplicable,
            if($text=tema.tema,1,0) as rank,
            i.indice,
            v.value_id as rel_rel_id,
            v.value as rr_value,
            v.value_code as rr_code
        from
            $DBCFG[DBprefix]tema as tema
        left join
            $DBCFG[DBprefix]tabla_rel as relaciones
        on
            relaciones.id_mayor=tema.tema_id
            and relaciones.t_relacion in (4,5,6,7)
        left join
            $DBCFG[DBprefix]tema as temasPreferidos
        on
            temasPreferidos.tema_id=relaciones.id_menor
            and tema.tema_id=relaciones.id_mayor
        left join
            $DBCFG[DBprefix]indice i
        on
            i.tema_id=tema.tema_id
        left join
            $DBCFG[DBprefix]values v
        on
            v.value_id = relaciones.rel_rel_id
        where
            tema.tema like $text
            and tema.estado_id='13'
            $where
        group by
            id_definitivo
        order by
        rank desc,lower(tema.tema)"
    );

    return $sql;
}


#
# ARRAY de cada términos sin relaciones
# Retrive simple term data for id
#
function APIARRAYverTerminoBasico($tema_id)
{
    GLOBAL $DBCFG;

    $tema_id=secure_data($tema_id,"int");

    $sql=SQL("select","
            tema.tema_id, tema.tema_id as idTema,
            tema.code,
            tema.tema titTema,
            tema.tema,
            tema.estado_id,
            tema.cuando_estado,
            tema.cuando,
            tema.cuando_final,
            tema.notEquivalent,
            tema.notApplicable,
            c.idioma,
            c.titulo
        FROM
            $DBCFG[DBprefix]tema as tema,
            $DBCFG[DBprefix]config as c
        WHERE
            tema.tema_id='$tema_id'
            and c.id=tema.tesauro_id
            and tema.estado_id='13'
        ");

    return $sql->FetchRow();
}
