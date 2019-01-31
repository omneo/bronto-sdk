<?php

namespace Omneo\Bronto\Modules;

use Omneo\Bronto;

class OrderService extends AbstractRestModule
{
    /**
     * Order search.
     *
     * @param $id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function findById($id)
    {
        return $this->client->get('orders',['customerOrderId' => $id]);
    }

    /**
     * Order add.
     *
     * @param $id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function add(Bronto\Order $order)
    {
        return $this->client->post('orders',['customerOrderId' => $id]);
    }
}