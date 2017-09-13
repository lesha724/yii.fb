<?php

/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 13.09.2017
 * Time: 17:02
 */
class AsuEAuthUserIdentity extends EAuthUserIdentity
{
    protected $attributes;

    public function authenticate()
    {
        if (parent::authenticate()){
            $this->attributes = $this->service->getAttributes();
            return true;
        }
        return false;
    }

    public function getAttributes() {
        return $this->attributes;
    }
}