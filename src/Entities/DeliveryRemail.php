<?php

namespace Arkade\Bronto\Entities;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class DeliveryRemail extends AbstractEntity
{
    /**
     * @var int
     */
    protected $days;

    /**
     * @var Carbon
     */
    protected $time;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $messageId;

    /**
     * @var string
     */
    protected $activity;

    /**
     * @return int
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * The number of days until the remail will trigger.
     * @param int $days
     * @return DeliveryRemail
     */
    public function setDays($days)
    {
        $this->days = $days;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * The time at which the remail will trigger. The time should be in 24 hour format: HH:MM:SS
     * Note: Do not add a time zone offset for the remail time.
     * The time for the remail will use the time zone specified for the delivery object.
     * @param Carbon $time
     * @return DeliveryRemail
     */
    public function setTime(Carbon $time = null)
    {
        $this->time = $time;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return DeliveryRemail
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @param string $messageId
     * @return DeliveryRemail
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;
        return $this;
    }

    /**
     * The activity that will trigger the remail. Valid values are: noopen, opennoclick, or clicknoconvert
     * @return string
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * @param string $activity
     * @return DeliveryRemail
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;
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
