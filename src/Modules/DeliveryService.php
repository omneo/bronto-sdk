<?php

namespace Arkade\Bronto\Modules;

use Arkade\Bronto\Entities\Delivery;
use Arkade\Bronto\Serializers\DeliverySerializer;
use Arkade\Bronto\Exceptions;
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

        $deliveryArray = array_filter(json_decode((new DeliverySerializer())->serialize($delivery),true));

        if(isset($deliveryArray['start'])) $deliveryRow->start = $deliveryArray['start'];
        if(isset($deliveryArray['type'])) $deliveryRow->type = $deliveryArray['type'];
        if(isset($deliveryArray['messageId'])) $deliveryRow->messageId = $deliveryArray['messageId'];
        if(isset($deliveryArray['fromEmail'])) $deliveryRow->fromEmail = $deliveryArray['fromEmail'];
        if(isset($deliveryArray['fromName'])) $deliveryRow->fromName = $deliveryArray['fromName'];
        if(isset($deliveryArray['recipients'])) $deliveryRow->recipients = $deliveryArray['recipients'];
        if(isset($deliveryArray['optin'])) $deliveryRow->optin = $deliveryArray['optin'];
        if(isset($deliveryArray['throttle'])) $deliveryRow->throttle = $deliveryArray['throttle'];
        if(isset($deliveryArray['replyEmail'])) $deliveryRow->replyEmail = $deliveryArray['replyEmail'];
        if(isset($deliveryArray['authentication'])) $deliveryRow->authentication = $deliveryArray['authentication'];
        if(isset($deliveryArray['messageRuleId'])) $deliveryRow->messageRuleId = $deliveryArray['messageRuleId'];

        $delivery->getFields()->each(function($field) use($deliveryRow){
            $deliveryRow->setField($field->getName(), $field->getContent(), $field->getType());
        });

        // Save
        try {
            return $deliveryRow->save();
        } catch (Exception $e) {
            throw new Exceptions\UnexpectedException((string)$e->getResponse()->getBody(),
                $e->getResponse()->getStatusCode());
        }
    }

}