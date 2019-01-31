<?php

namespace Omneo\Bronto\Entities;

class OrderState extends AbstractEntity
{
    /**
     * @var boolean
     */
    protected $processed = false;

    /**
     * @var boolean
     */
    protected $shipped = false;

    /**
     * @return bool
     */
    public function getProcessed()
    {
        return $this->processed;
    }

    /**
     * @param bool $processed
     * @return OrderState
     */
    public function setProcessed($processed)
    {
        $this->processed = $processed;
        return $this;
    }

    /**
     * @return string
     */
    public function getShipped()
    {
        return $this->shipped;
    }

    /**
     * @param string $shipped
     * @return OrderState
     */
    public function setShipped($shipped)
    {
        $this->shipped = $shipped;
        return $this;
    }



}
