<?php

namespace Omneo\Bronto\Modules;

use Omneo\Bronto\Entities\Order;
use Omneo\Bronto\Parsers\OrderParser;
use Omneo\Bronto\Serializers\OrderSerializer;
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
        return (new OrderParser)->parse(
            $this->client->get('orders/'.$id,['debug' => env('APP_DEBUG')])
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
        $data = $this->client->get('orders?customerOrderId='.$id,['debug' => env('APP_DEBUG')]);

        $collection = new Collection;

        if(!count($data)) return $collection;

        foreach($data as $item){
            $collection->push(
                (new OrderParser)->parse($item)
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

        return (new OrderParser)->parse(
            $this->client->post(
                'orders?'.$query,
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => (new OrderSerializer)->serialize($order),
                    'debug' => env('APP_DEBUG')
                ]
            )
        );
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

        return (new OrderParser)->parse(
            $this->client->post(
                'orders/'.$order->getOrderId().'?'.$query,
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => (new OrderSerializer)->serialize($order),
                    'debug' => env('APP_DEBUG')
                ]
            )
        );
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

        return (new OrderParser)->parse(
            $this->client->post(
                'orders/customerOrderId/'.$order->getCustomerOrderId().'?'.$query,
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => (new OrderSerializer)->serialize($order),
                    'debug' => env('APP_DEBUG')
                ]
            )
        );
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
        return $this->client->delete('orders/'.$id, ['debug' => env('APP_DEBUG')]);
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
        return $this->client->delete('orders/customerOrderId/'.$id,['debug' => env('APP_DEBUG')]);
    }
}