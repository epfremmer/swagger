<?php
/**
 * File BooleanType.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Epfremme\Swagger\Entity\Parameters\PathParameter;

use Epfremme\Swagger\Entity\Mixin\Primitives;
use Epfremme\Swagger\Entity\Parameters\AbstractTypedParameter;
use Epfremme\Swagger\Type\BooleanTypeInterface;
use Epfremme\Swagger\Type\PathParameterInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * Class BooleanType
 *
 * @package Epfremme\Swagger
 * @subpackage Entity\Parameters\PathParameter
 */
class BooleanType extends AbstractTypedParameter implements PathParameterInterface, BooleanTypeInterface
{
    use Primitives\BooleanPrimitiveTrait;

    /**
     * @JMS\Type("boolean")
     * @var boolean
     */
    protected $default;
}
