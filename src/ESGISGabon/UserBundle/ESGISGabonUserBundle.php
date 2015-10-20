<?php

namespace ESGISGabon\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ESGISGabonUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
