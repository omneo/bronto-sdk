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
        /*
        $deliveryObject = $this->client->getClient()->getDeliveryObject();

        $delivery = $deliveryObject->createRow();
        $delivery->start      = date('c'); // Today
        $delivery->type       = \Bronto_Api_Delivery_Row::TYPE_TRANSACTIONAL;
        $delivery->messageId  = $message->id;
        $delivery->fromEmail  = 'user@example.com';
        $delivery->fromName   = 'Example Sender';
        $delivery->recipients = array(
            array(
                'type' => 'contact',
                'id'   => $contact->id,
            ),
        );

        // Save
        try {
            return $delivery->save();
        } catch (Exception $e) {
            // Handle error
        }
        */
    }

}