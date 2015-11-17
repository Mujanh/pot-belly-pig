<?php

namespace Anax\DI;


/**
* Anax class extending CDIFactoryDefault
*/

class CDIFactory extends CDIFactoryDefault
{
    public function __construct()
    {
        parent::__construct();

        $this->set('form', '\Mos\HTMLForm\CForm');
    }
}
