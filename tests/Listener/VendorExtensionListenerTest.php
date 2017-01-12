<?php
namespace Epfremme\Swagger\Tests\Listener;

use Epfremme\Swagger\Listener\VendorExtensionListener;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\EventDispatcher\Events;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;


/**
 * Class VendorExtensionListenerTest
 * @package Epfremme\Swagger\Tests\Listener
 */
class VendorExtensionListenerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function shouldReturnEventToWhichIsSubscribed()
    {
        $events = VendorExtensionListener::getSubscribedEvents();

        $this->assertEquals([
            ['event' => Events::PRE_DESERIALIZE, 'method' => 'onDePreSerialize'],
            ['event' => Events::POST_SERIALIZE, 'method' => 'onPostSerialize'],
        ], $events);
    }

    /**
     * @test
     */
    public function shouldSetVendorExtensionsOnInfoObject()
    {
        $lister = new VendorExtensionListener();

        $event = new PreDeserializeEvent(
            new DeserializationContext(),
            [
                'foo' => 'bar',
                'x-field1' => 'foo1',
                'x-field2' => ['foo2']
            ],
            ['name' => 'Epfremme\Swagger\Entity\Info', 'params' => []]
        );
        $lister->onDePreSerialize($event);

        $modifiedData = $event->getData();

        $expected = [
            'foo' => 'bar',
            'vendorExtensions' => [
                'x-field1' => 'foo1',
                'x-field2' => ['foo2']
            ]
        ];
        $this->assertEquals($expected, $modifiedData);
    }
}
