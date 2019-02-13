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
     * @param  Collection $mappings
     * @return Contact
     */
    public function parse($payload, $mappings)
    {
        $contact = (new Entities\Contact)
            ->setId($payload->id)
            ->setEmail($payload->email)
            ->setMobileNumber($payload->mobileNumber)
            ->setStatus($payload->status);

        $attributes = [];

        foreach($payload->fields as $field){
            $mappings->each(function($mapping) use(&$attributes, $field){
                if($field['fieldId'] === $mapping['bronto_id']){
                    $attributes[$mapping['bronto_name']] = $field['content'];
                }
            });
        }

        $contact->setAttributes(new Collection($attributes));

        return $contact;
    }
}