<?php

namespace Arkade\Bronto\Serializers;

use Arkade\Bronto\Entities;

class OrderSerializer
{
    /**
     * Serialize.
     *
     * @param  Entities\Order $order
     * @return string
     */
    public function serialize(Entities\Order $order)
    {
        // trigger the entities jsonSerialize method
        $serialized = json_decode(json_encode($order));

        // these can never be set when sending to bronto
        // only populated with a parsed response from bronto
        unset($serialized->orderId);
        unset($serialized->createdDate);
        unset($serialized->updatedDate);

        // tracking cookie params cannot be null
        if(is_null($serialized->trackingCookieName)) unset($serialized->trackingCookieName);
        if(is_null($serialized->trackingCookieValue)) unset($serialized->trackingCookieValue);

        return json_encode($serialized);
    }
}