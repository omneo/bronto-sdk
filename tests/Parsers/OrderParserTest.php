<?php

namespace Arkade\Bronto\Parsers;

use Carbon\Carbon;
use Arkade\Bronto\Entities\Order;
use Arkade\Bronto\Entities\LineItem;
use Arkade\Bronto\Entities\OrderState;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Collection;

class OrderParserTest extends TestCase
{
    /**
     * @test
     */
    public function returns_populated_order()
    {
        $order = (new OrderParser)->parse(
            json_decode(file_get_contents(__DIR__.'/../Stubs/Orders/order.json'))
        );

        $this->assertInstanceOf(Order::class, $order);

        $this->assertEquals(0, $order->getDiscountAmount());
        $this->assertEquals(null, $order->getEmailAddress());
        $this->assertEquals('160.00', $order->getGrandTotal());
        $this->assertEquals(null, $order->getOriginIp());
        $this->assertEquals(0, $order->getShippingAmount());
        $this->assertEquals(null, $order->getShippingDate());
        $this->assertEquals(null, $order->getShippingDetails());
        $this->assertEquals(null, $order->getShippingTrackingUrl());
        $this->assertEquals(0, $order->getSubtotal());
        $this->assertEquals('15.00', $order->getTaxAmount());
        $this->assertEquals(null, $order->getTrackingCookieName());
        $this->assertEquals(null, $order->getTrackingCookieValue());
        $this->assertEquals(null, $order->getTid());
        $this->assertEquals(null, $order->getCartId());
        $this->assertEquals('ORDER-123456789', $order->getCustomerOrderId());
        $this->assertEquals(Carbon::parse('2017-05-12T00:00:00.000Z'), $order->getOrderDate());
        $this->assertEquals('AUD', $order->getCurrency());
        $this->assertEquals('52e2ba9d-b339-4859-aeec-43a79cf6bfd7', $order->getOrderId());
        $this->assertEquals(Carbon::parse('2017-11-28T03:53:14.322Z'), $order->getCreatedDate());
        $this->assertEquals(Carbon::parse('2017-11-28T03:53:14.322Z'), $order->getUpdatedDate());

    }

    /**
     * @test
     */
    public function returns_populated_order_line_items()
    {
        $order = (new OrderParser)->parse(
            json_decode(file_get_contents(__DIR__.'/../Stubs/Orders/order.json'))
        );

        $this->assertInstanceOf(Collection::class, $order->getLineItems());
        $this->assertEquals(2, $order->getLineItems()->count());

        $lineItem = $order->getLineItems()->first();

        $this->assertInstanceOf(LineItem::class, $lineItem);

        $this->assertEquals('someItemName1', $lineItem->getName());
        $this->assertEquals('item description', $lineItem->getDescription());
        $this->assertEquals('AS1210000', $lineItem->getSku());
        $this->assertEquals(null, $lineItem->getOther());
        $this->assertEquals(null, $lineItem->getImageUrl());
        $this->assertEquals(null, $lineItem->getCategory());
        $this->assertEquals(null, $lineItem->getProductUrl());
        $this->assertEquals(1, $lineItem->getQuantity());
        $this->assertEquals('90.00', $lineItem->getSalePrice());
        $this->assertEquals('100.00', $lineItem->getTotalPrice());
        $this->assertEquals(0, $lineItem->getUnitPrice());

    }

    /**
     * @test
     */
    public function returns_populated_order_states()
    {
        $order = (new OrderParser)->parse(
            json_decode(file_get_contents(__DIR__.'/../Stubs/Orders/order.json'))
        );

        $states = $order->getStates();

        $this->assertInstanceOf(OrderState::class, $states);

        $this->assertEquals(true, $states->getProcessed());
        $this->assertEquals(false, $states->getShipped());

    }
}
