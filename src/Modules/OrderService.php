<?php

namespace Arkade\Bronto\Modules;

use Arkade\Bronto\Entities;
use Arkade\Bronto\Parsers;

class OrderService extends AbstractRestModule
{
    /**
     * Order find.
     * Uses Bronto order ID
     *
     * @param $id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function find($id)
    {
        return (new Parsers\OrderParser)->parse(
            (new Parsers\PayloadParser)->parse($this->client->get('orders/'.$id,['debug' => true]))
        );
    }

    /**
     * Order search.
     * Uses customer order ID
     *
     * @param $id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function findById($id)
    {
        return $this->client->get('orders?customerOrderId='.$id,['debug' => true]);
    }

    /**
     * Order add.
     *
     * @param Bronto\Entities\Order $order
     * @param boolean $createContact
     * @param boolean $triggerEvents
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function add(Bronto\Entities\Order $order, $createContact = false, $triggerEvents = false)
    {
        $query = 'createContact='.$createContact;
        $query .= 'triggerEvents='.$createContact;
        return $this->client->post('orders?'.$query, ['json' => $order, 'debug' => true]);
    }

    /**
     * Order update.
     * Uses Bronto order ID
     *
     * @param Bronto\Entities\Order $order
     * @param boolean $createContact
     * @param boolean $triggerEvents
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(Bronto\Entities\Order $order, $createContact = false, $triggerEvents = false)
    {
        $query = 'createContact='.$createContact;
        $query .= 'triggerEvents='.$createContact;
        return $this->client->post('orders/'.$order->getOrderId().'?'.$query, ['json' => $order, 'debug' => true]);
    }

    /**
     * Order update.
     * Uses customer order ID
     *
     * @param Bronto\Entities\Order $order
     * @param boolean $createContact
     * @param boolean $triggerEvents
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateById(Bronto\Entities\Order $order, $createContact = false, $triggerEvents = false)
    {
        $query = 'createContact='.$createContact;
        $query .= 'triggerEvents='.$createContact;
        return $this->client->post('orders/customerOrderId/'.$order->getCustomerOrderId().'?'.$query, ['json' => $order, 'debug' => true]);
    }

    /**
     * Order delete.
     * Uses Bronto order ID
     *
     * @param string $id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function delete($id)
    {
        return $this->client->delete('orders/'.$id, ['debug' => true]);
    }

    /**
     * Order delete.
     * Uses customer order ID
     *
     * @param string $id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteById($id)
    {
        return $this->client->delete('orders/customerOrderId/'.$id,['debug' => true]);
    }
}