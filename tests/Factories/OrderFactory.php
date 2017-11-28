<?php

namespace Arkade\Bronto\Factories;

use Arkade\Bronto\Entities\OrderState;
use Arkade\Bronto\Entities\LineItem;
use Arkade\Bronto\Entities\Order;
use Carbon\Carbon;

class OrderFactory
{
    /**
     * Make an order entity.
     *
     * @return Entities\Order
     */
    public function make()
    {
        $orderState = new OrderState();
        $orderState->setProcessed(true);
        $orderState->setShipped(false);

        $orderItem1 = new LineItem();
        $orderItem1->setName('someItemName1');
        $orderItem1->setDescription('item description');
        $orderItem1->setQuantity(1);
        $orderItem1->setSku('AS1210000');
        $orderItem1->setSalePrice('90.00');
        $orderItem1->setTotalPrice('100.00');

        $orderItem2 = new LineItem();
        $orderItem2->setName('someItemName2');
        $orderItem2->setDescription('item description');
        $orderItem2->setQuantity(1);
        $orderItem2->setSku('AS3420000');
        $orderItem2->setSalePrice('40.00');
        $orderItem2->setTotalPrice('50.00');

        $order = new Order();
        $order->setGrandTotal('160.00');
        $order->setOrderDate(Carbon::parse('2017-05-12T00:00:00.000Z'));
        $order->setTaxAmount('15.00');
        $order->setCurrency('AUD');
        $order->setCustomerOrderId('ORDER-123456789');

        $order->setLineItems(collect([$orderItem1,$orderItem2]));
        $order->setStates($orderState);

        return $order;
    }
}