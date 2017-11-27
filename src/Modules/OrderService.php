<?php

namespace Arkade\Bronto\Modules;

use Arkade\Bronto\Entities\Order;
use Arkade\Bronto\Parsers;
use Illuminate\Support\Collection;

class OrderService extends AbstractRestModule
{
    /**
     * Order find.
     * Uses Bronto order ID
     *
     * @param $id
     * @return Order
     */
    public function find($id)
    {
        return (new Parsers\OrderParser)->parse(
            $this->client->get('orders/'.$id,['debug' => true])
        );
    }

    /**
     * Order search.
     * Uses customer order ID
     *
     * @param $id
     * @return Collection
     */
    public function findById($id)
    {
        $data = $this->client->get('orders?customerOrderId='.$id,['debug' => true]);

        $collection = new Collection;

        foreach($data as $item){
            $collection->push(
                (new Parsers\OrderParser)->parse($item)
            );
        }

        return $collection;
    }

    /**
     * Order add.
     *
     * @param Order $order
     * @param boolean $createContact
     * @param boolean $triggerEvents
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function add(Order $order, $createContact = false, $triggerEvents = false)
    {
        $query = 'createContact='.$createContact;
        $query .= 'triggerEvents='.$createContact;
        return $this->client->post('orders?'.$query, ['json' => $order, 'debug' => true]);
    }

    /**
     * Order update.
     * Uses Bronto order ID
     *
     * @param Order $order
     * @param boolean $createContact
     * @param boolean $triggerEvents
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(Order $order, $createContact = false, $triggerEvents = false)
    {
        $query = 'createContact='.$createContact;
        $query .= 'triggerEvents='.$createContact;
        return $this->client->post('orders/'.$order->getOrderId().'?'.$query, ['json' => $order, 'debug' => true]);
    }

    /**
     * Order update.
     * Uses customer order ID
     *
     * @param Order $order
     * @param boolean $createContact
     * @param boolean $triggerEvents
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateById(Order $order, $createContact = false, $triggerEvents = false)
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