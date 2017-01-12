<?php
namespace Epfremme\Swagger\Listener;

use JMS\Serializer\EventDispatcher\Events;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;
use JMS\Serializer\GenericSerializationVisitor;

/**
 * Class VendorExtensionListener
 * @package Epfremme\Swagger\Listener
 */
class VendorExtensionListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            ['event' => Events::PRE_DESERIALIZE, 'method' => 'onDePreSerialize'],
            ['event' => Events::POST_SERIALIZE, 'method' => 'onPostSerialize'],
        );
    }

    /**
     * @param PreDeserializeEvent $event
     */
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

    /**
     * @param ObjectEvent $event
     */
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