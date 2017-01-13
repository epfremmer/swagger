<?php
namespace Epfremme\Swagger\Listener;

use Epfremme\Swagger\Entity\ExternalDocumentation;
use Epfremme\Swagger\Entity\Headers\AbstractHeader;
use Epfremme\Swagger\Entity\Headers\ArrayHeader;
use Epfremme\Swagger\Entity\Headers\BooleanHeader;
use Epfremme\Swagger\Entity\Headers\IntegerHeader;
use Epfremme\Swagger\Entity\Headers\NumberHeader;
use Epfremme\Swagger\Entity\Headers\StringHeader;
use Epfremme\Swagger\Entity\Info;
use Epfremme\Swagger\Entity\License;
use Epfremme\Swagger\Entity\Operation;
use Epfremme\Swagger\Entity\Response;
use Epfremme\Swagger\Entity\Tag;
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
        return [
            ['event' => Events::PRE_DESERIALIZE, 'method' => 'onDePreSerialize'],
            ['event' => Events::POST_SERIALIZE, 'method' => 'onPostSerialize'],
        ];
    }

    /**
     * @param PreDeserializeEvent $event
     */
    public function onDePreSerialize(PreDeserializeEvent $event)
    {
        if ($this->checkExpectedType($event, Info::class) ||
            $this->checkExpectedType($event, Response::class) ||
            $this->checkExpectedType($event, Operation::class) ||
            $this->checkExpectedType($event, Tag::class) ||
            $this->checkExpectedType($event, License::class) ||
            $this->checkExpectedType($event, ExternalDocumentation::class) ||
            $this->checkExpectedType($event, ArrayHeader::class) ||
            $this->checkExpectedType($event, BooleanHeader::class) ||
            $this->checkExpectedType($event, IntegerHeader::class) ||
            $this->checkExpectedType($event, NumberHeader::class) ||
            $this->checkExpectedType($event, StringHeader::class)
        ) {
            $data = $event->getData();
            $data['vendorExtensions'] = [];
            foreach ($data as $key => $value) {
                if ($this->isVendorExtensionField($key)) {
                    $data['vendorExtensions'][$key] = $value;
                    unset($data[$key]);
                }
            }
            $event->setData($data);
        }
        if ($this->checkExpectedType($event, 'Epfremme\Swagger\Entity\Path')
        ) {
            $outerData = $event->getData();
            $data = $outerData['data'];
            $outerData['vendorExtensions'] = [];
            foreach ($data as $key => $value) {
                if ($this->isVendorExtensionField($key)) {
                    $outerData['vendorExtensions'][$key] = $value;
                    unset($outerData['data'][$key]);
                }
            }
            $event->setData($outerData);
        }

    }

    /**
     * @param ObjectEvent $event
     */
    public function onPostSerialize(ObjectEvent $event)
    {
        $object = $event->getObject();
        /** @var GenericSerializationVisitor $visitor */
        $visitor = $event->getVisitor();
        if (method_exists($object, 'getVendorExtensions')) {
            $vendorExtensions = $object->getVendorExtensions();
            if ($vendorExtensions) {
                foreach ($vendorExtensions as $key => $value) {
                    $visitor->setData($key, $value);
                }
            }
        }
    }

    /**
     * @param $key
     * @return bool
     */
    private function isVendorExtensionField($key)
    {
        return strrpos($key, 'x-') !== false;
    }

    /**
     * @param PreDeserializeEvent $event
     * @param $expectedType
     * @return bool
     */
    private function checkExpectedType(PreDeserializeEvent $event, $expectedType)
    {
        return $expectedType == $event->getType()['name'];
    }

}