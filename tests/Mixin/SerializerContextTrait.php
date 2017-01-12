<?php
/**
 * File SerializerContextTrait.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Epfremme\Swagger\Tests\Mixin;

use Epfremme\Swagger\Listener\SerializationSubscriber;
use JMS\Serializer\EventDispatcher\EventDispatcher;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;
use JMS\Serializer\GenericSerializationVisitor;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

/**
 * Class SerializerContextTrait
 *
 * Adds static pre-configured JMS serializer to test class.
 *
 * @package Epfremme\Swagger
 * @subpackage Tests\Entity
 */
trait SerializerContextTrait
{
    /**
     * @var Serializer
     */
    protected static $serializer;

    /**
     * {@inheritdoc}
     */
    public static function setUpBeforeClass()
    {
        $builder = SerializerBuilder::create();

        $builder->configureListeners(function (EventDispatcher $eventDispatcher) {
            $eventDispatcher->addSubscriber(new SerializationSubscriber());
            $eventDispatcher->addSubscriber(new MyEventSubscriber());
        });

        self::$serializer = $builder->build();
    }

    /**
     * Return the serializer
     *
     * @return Serializer
     */
    public function getSerializer()
    {
        if (!self::$serializer) {
            self::setUpBeforeClass();
        }

        return self::$serializer;
    }
}

class MyEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            ['event' => 'serializer.pre_deserialize', 'method' => 'onDePreSerialize'],
            ['event' => 'serializer.post_serialize', 'method' => 'onPostSerialize'],
        );
    }

    public function onDePreSerialize(PreDeserializeEvent $event)
    {
        $data = $event->getData();
        if ('Epfremme\Swagger\Entity\Info' == $event->getType()['name']) {

            $data['vendorExtensions'] = [];
            foreach ($data as $key => $value) {
                if (strrpos($key, 'x-') !== false) {
                    $data['vendorExtensions'][$key] = $value;
                }

            }
        }
        $event->setData($data);
    }

    public function onPostSerialize(ObjectEvent $event)
    {
        $object = $event->getObject();
        /** @var GenericSerializationVisitor $visitor */
        $visitor = $event->getVisitor();
        if(method_exists($object, 'getVendorExtensions')){
            $vendorExtensions = $object->getVendorExtensions();
            if($vendorExtensions){
                foreach($vendorExtensions as $key => $value){
                    $visitor->setData($key, $value);
                }
            }
        }
    }

}