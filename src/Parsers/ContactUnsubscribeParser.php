<?php

namespace Arkade\Bronto\Parsers;

use Arkade\Bronto\Entities;
use Illuminate\Support\Collection;

class ContactUnsubscribeParser
{
    /**
     * Parse the given array to a Contact entity.
     *
     * @param  array $payload
     * @return Collection
     */
    public function parse($payload)
    {
        $result = collect([]);

        foreach($payload as $item){
            $contact = (new Entities\Contact)
                ->setId($item->id)
                ->setEmail($item->email)
                ->setStatus($item->status);

            $result->push($contact);
        }

        return $result;
    }
}