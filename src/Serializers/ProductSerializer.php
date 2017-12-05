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

        if(!is_null($serialized->salePriceEffectiveDateStart)) $serialized->salePriceEffectiveDateStart = (new Carbon($serialized->salePriceEffectiveDateStart))->toIso8601String();
        if(!is_null($serialized->salePriceEffectiveDateEnd)) $serialized->salePriceEffectiveDateEnd = (new Carbon($serialized->salePriceEffectiveDateEnd))->toIso8601String();
        if(!is_null($serialized->availabilityDate)) $serialized->availabilityDate = (new Carbon($serialized->availabilityDate))->toIso8601String();

        return json_encode($serialized);
    }
}