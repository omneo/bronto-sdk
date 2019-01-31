<?php

namespace Omneo\Bronto\Serializers;

use Omneo\Bronto\Entities;

class DeliverySerializer
{
    /**
     * Serialize.
     *
     * @param Entities\Delivery $delivery
     * @return string
     */
    public function serialize(Entities\Delivery $delivery)
    {
        // trigger the entities jsonSerialize method
        $serialized = json_decode(json_encode($delivery));

        $serialized->start = $delivery->getStart()->toIso8601String();

        return json_encode($serialized);
    }
}