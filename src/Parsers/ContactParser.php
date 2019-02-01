<?php

namespace Omneo\Bronto\Parsers;

use Omneo\Bronto\Entities\Contact;
use Carbon\Carbon;
use Omneo\Bronto\Entities;
use Illuminate\Support\Collection;

class ContactParser
{
    /**
     * Parse the given array to a Contact entity.
     *
     * @param  array $payload
     * @param  array $fieldMappings
     * @param  array $contactMappings
     * @return Contact
     */
    public function parse($payload, $fieldMappings, $contactMappings)
    {
        $contact = (new Entities\Contact)
            ->setId($payload->id)
            ->setEmail($payload->email)
            ->setMobileNumber($payload->mobileNumber)
            ->setStatus($payload->status);

        $attributes = [];

        foreach($payload->fields as $field){
            if(!empty($field['content']) && in_array($field['fieldId'], $fieldMappings)){
                $fieldMapping = array_search($field['fieldId'], $fieldMappings);
                if(in_array($fieldMapping, $contactMappings)) {
                    $contactMapping = array_search($fieldMapping, $contactMappings);
                    $methodName = 'set'. ucfirst($contactMapping);
                    if(method_exists($contact, $methodName)){
                        if($methodName === 'setBirthday' || $methodName === 'setCreationDate'){
                            $contact->{$methodName}(Carbon::parse($field['content']));
                        }else{
                            $contact->{$methodName}($field['content']);
                        }
                    }else{
                        $attributes[$contactMapping] = $field['content'];
                    }
                }
            }
        }

        $contact->setAttributes(new Collection($attributes));

        return $contact;
    }
}