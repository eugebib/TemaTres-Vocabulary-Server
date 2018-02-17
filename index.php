<?php

####################################################################
# TemaTres : aplicación para la gestión de lenguajes documentales  #
#                                                                  #
# Copyright (C) 2004-2017 Diego Ferreyra tematres@r020.com.ar      #
# Distribuido bajo Licencia GNU Public License, versión 2          #
# (de junio de 1.991) Free Software Foundation                     #
#                                                                  #
####################################################################

require 'common/include/functions.php';

require 'config/config.vocs.php';

require 'config/config.db.php';

require 'config/config.tematres.php';

if ($page != 'install') {
    require 'config/config.session.php';
}

require('vocab/' . $page . '.php');
