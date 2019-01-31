<?php

namespace Omneo\Bronto\Serializers;

use Omneo\Bronto\Entities;
use Carbon\Carbon;

class ProductSerializer
{
    /**
     * Serialize.
     *
     * @param  Entities\Product $product
     * @return string
     */
    public function serialize(Entities\Product $product)
    {
        // trigger the entities jsonSerialize method
        $serialized = json_decode(json_encode($product));

        // dates to bronto need to be in ISO 8601
        if(!is_null($serialized->salePriceEffectiveStartDate)) $serialized->salePriceEffectiveStartDate = (new Carbon($serialized->salePriceEffectiveStartDate))->toIso8601String();
        if(!is_null($serialized->salePriceEffectiveEndDate)) $serialized->salePriceEffectiveEndDate = (new Carbon($serialized->salePriceEffectiveEndDate))->toIso8601String();
        if(!is_null($serialized->availabilityDate)) $serialized->availabilityDate = (new Carbon($serialized->availabilityDate))->toIso8601String();

        // bronto product fields are stored in snake case
        $vars = get_object_vars($serialized);
        $serialized = [];
        foreach ($vars as $key => $value){
            $serialized[snake_case($key)] = $value;
        }

        return json_encode($serialized);
    }
}