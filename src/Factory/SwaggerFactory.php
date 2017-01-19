<?php
/**
 * File SwaggerFactory.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Epfremme\Swagger\Factory;

use Epfremme\Swagger\Entity\Swagger;
use Epfremme\Swagger\Parser\FileParser;
use Epfremme\Swagger\Parser\JsonStringParser;
use Epfremme\Swagger\Parser\SwaggerParser;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\EventDispatcher\EventDispatcher;
use Epfremme\Swagger\Listener\SerializationSubscriber;

/**
 * Class SwaggerFactory
 *
 * @package Epfremme\Swagger
 * @subpackage Factory
 */
class SwaggerFactory
{
    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * Constructor
     */
    public function __construct()
    {
        $serializerBuilder = new SerializerBuilder();

        $serializerBuilder->configureListeners(function(EventDispatcher $eventDispatcher) {
            $eventDispatcher->addSubscriber(new SerializationSubscriber());
        });

        $this->serializer = $serializerBuilder->build();
    }

    /**
     * Build Swagger document from parser interface
     *
     * @param string $file
     * @return Swagger
     */
    public function build($file)
    {
        $swagger = new FileParser($file);

        return $this->buildFromParser($swagger);
    }

    /**
     * Build Swagger document from parser interface
     *
     * @param string $json
     * @return Swagger
     */
    public function buildFromJsonString($json)
    {
        $swagger = new JsonStringParser($json);

        return $this->buildFromParser($swagger);
    }

    /**
     * Return serialized Swagger document
     *
     * @param Swagger $swagger
     * @return string
     */
    public function serialize(Swagger $swagger)
    {
        $context = new SerializationContext();

        $context->setVersion(
            $swagger->getVersion()
        );

        return $this->serializer->serialize($swagger, 'json', $context);
    }

    /**
     * @param SwaggerParser $swagger
     * @return array|\JMS\Serializer\scalar|object
     * @throws \LogicException
     */
    private function buildFromParser(SwaggerParser $swagger)
    {
        $context = new DeserializationContext();

        $context->setVersion(
            $swagger->getVersion()
        );

        return $this->serializer->deserialize($swagger, Swagger::class, 'json', $context);
    }
}
