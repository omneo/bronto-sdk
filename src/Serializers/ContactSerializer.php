<?php

namespace Arkade\Bronto\Serializers;

use Arkade\Bronto\Entities;

class ContactSerializer
{
    /**
     * Serialize.
     *
     * @param Entities\Order $order
     * @return string
     */
    public function serialize(Entities\Contact $contact)
    {
        // trigger the entities jsonSerialize method
        $serialized = json_decode(json_encode($contact));

        // flatten attributes
        if(isset($serialized->attributes)){
            $vars = get_object_vars($serialized->attributes);
            foreach ($vars as $key => $value){
                $serialized->$key = $value;
            }
            unset($serialized->attributes);
        }

        return json_encode($serialized);
    }
}