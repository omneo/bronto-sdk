<?php

namespace Arkade\Bronto\Serializers;

use Arkade\Bronto\Entities;

class ProductSerializer
{
    /**
     * Serialize.
     *
     * @param  Entities\Order $order
     * @return string
     */
    public function serialize(Entities\Product $product)
    {
        // trigger the entities jsonSerialize method
        $serialized = json_decode(json_encode($product));

        // tracking cookie params cannot be null
        /*
        if(is_null($serialized->trackingCookieName)) unset($serialized->trackingCookieName);
        if(is_null($serialized->trackingCookieValue)) unset($serialized->trackingCookieValue);
        */

        return json_encode($serialized);
    }
}