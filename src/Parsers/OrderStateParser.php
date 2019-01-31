<?php

namespace Omneo\Bronto\Parsers;

use Omneo\Bronto\Entities;

class OrderStateParser
{
    /**
     * Parse the given array to a OrderState entity.
     *
     * @param  array $payload
     * @return Entities\OrderState
     */
    public function parse($payload)
    {
        $orderState = (new Entities\OrderState())
            ->setProcessed($payload->processed)
            ->setShipped($payload->shipped);

        return $orderState;
    }
}