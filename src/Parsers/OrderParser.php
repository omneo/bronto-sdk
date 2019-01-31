<?php

namespace Omneo\Bronto\Parsers;

use Carbon\Carbon;
use Omneo\Bronto\Entities;

class OrderParser
{
    /**
     * Parse the given array to a Order entity.
     *
     * @param  array $payload
     * @return Order
     */
    public function parse($payload)
    {
        $order = (new Entities\Order)
            ->setCartId($payload->cartId)
            ->setCreatedDate(Carbon::parse((string) $payload->createdDate))
            ->setCurrency($payload->currency)
            ->setCustomerOrderId($payload->customerOrderId)
            ->setDiscountAmount($payload->discountAmount)
            ->setEmailAddress($payload->emailAddress)
            ->setGrandTotal($payload->grandTotal)
            ->setOrderId($payload->orderId)
            ->setOriginIp($payload->originIp)
            ->setOriginUserAgent($payload->originUserAgent)
            ->setShippingAmount($payload->shippingAmount)
            ->setShippingDate(null)
            ->setShippingDetails($payload->shippingDetails)
            ->setShippingTrackingUrl($payload->shippingTrackingUrl)
            ->setSubtotal($payload->subtotal)
            ->setTaxAmount($payload->taxAmount)
            ->setTrackingCookieName($payload->trackingCookieName)
            ->setTrackingCookieValue($payload->trackingCookieValue)
            ->setUpdatedDate(Carbon::parse((string) $payload->updatedDate))
            ->setStates(
                (new OrderStateParser)->parse($payload->states)
            );

        if(!is_null($payload->shippingDate)){
            $order->setShippingDate(Carbon::parse((string) $payload->shippingDate));
        }

        if(!is_null($payload->orderDate)){
            $order->setOrderDate(Carbon::parse((string) $payload->orderDate));
        }

        foreach($payload->lineItems as $item){
            $order->getLineItems()->push(
                (new LineItemParser)->parse($item)
            );
        }

        return $order;
    }
}