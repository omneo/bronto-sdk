<?php

namespace Omneo\Bronto\Serializers;

use Omneo\Bronto\Entities;

class ContactSerializer
{
    /**
     * Serialize.
     *
     * @param Entities\Contact $contact
     * @return string
     */
    public function serialize(Entities\Contact $contact)
    {
        // trigger the entities jsonSerialize method
        $serialized = json_decode(json_encode($contact));

        // flatten attributes
        if(isset($serialized->attributes)){
            foreach ($serialized->attributes as $attribute){
                $vars = get_object_vars($attribute);
                foreach($vars as $key=>$value){
                    $serialized->$key = $value;
                }
            }
            unset($serialized->attributes);
        }

        return json_encode($serialized);
    }
}