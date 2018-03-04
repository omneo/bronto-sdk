<?php

namespace Arkade\Bronto\Modules;

use Arkade\Bronto\Entities\Delivery;
use Arkade\Bronto\Serializers\DeliverySerializer;
use Carbon\Carbon;

class DeliveryService extends AbstractSoapModule
{
    /**
     * Send an email delivery
     *
     * @param Delivery
     * @return Delivery
     */
    public function send(Delivery $delivery)
    {
        $deliveryObject = $this->client->getClient()->getDeliveryObject();

        $deliveryRow = $deliveryObject->createRow();
        $deliveryRow->start = $delivery->getStart()->toIso8601String();
        $deliveryRow->type = $delivery->getType();
        $deliveryRow->messageId = $delivery->getMessageId();
        $deliveryRow->fromEmail = $delivery->getFromEmail();
        $deliveryRow->fromName = $delivery->getFromName();
        $deliveryRow->recipients = json_decode($delivery->getRecipients()->toJson());

        // Save
        try {
            return $deliveryRow->save();
        } catch (Exception $e) {
            // Handle error
        }
    }

}