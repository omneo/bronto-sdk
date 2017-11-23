<?php

namespace Arkade\Bronto\Entities;

class AbstractEntity implements \JsonSerializable
{

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}
