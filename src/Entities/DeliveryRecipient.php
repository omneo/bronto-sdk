<?php

namespace Omneo\Bronto\Entities;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class DeliveryRecipient extends AbstractEntity
{
    /**
     * @var string
     */
    protected $deliveryType;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $type;

    /**
     * @return string
     */
    public function getDeliveryType()
    {
        return $this->deliveryType;
    }

    /**
     * Valid values are:
     * eligible - Indicates that the contact, list, keyword, or segment specified in this object are eligible to receive the message being sent to it.
     * ineligible - Indicates that the contact, list, keyword, or segment specified in this object are not eligible to receive the message being sent to it.
     * uselected - (Default)
     * @param string $deliveryType
     * @return DeliveryRecipient
     */
    public function setDeliveryType($deliveryType)
    {
        $this->deliveryType = $deliveryType;
        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * The unique id of the recipient receiving the delivery. Depending on the type specified,
     * the id will be for a contact, a list, an smsKeyword, or a segment.
     * @param string $id
     * @return DeliveryRecipient
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Whether the contact is receiving the message as part of a list, segment, SMS keyword, or as an individual contact.
     * Valid values are: contact, list, segment or keyword (SMS Only – Use with addSMSDeliveries)
     * @param string $type
     * @return DeliveryRecipient
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return Array
     */
    public function jsonSerialize()
    {
        $result = get_object_vars($this);

        return $result;
    }

}
