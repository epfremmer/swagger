<?php
/**
 * File ArrayType.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Epfremme\Swagger\Entity\Parameters\HeaderParameter;

use Epfremme\Swagger\Entity\Mixin\Primitives;
use Epfremme\Swagger\Entity\Parameters\AbstractTypedParameter;
use Epfremme\Swagger\Type\ArrayTypeInterface;
use Epfremme\Swagger\Type\HeaderParameterInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * Class ArrayType
 *
 * @package Epfremme\Swagger
 * @subpackage Entity\Parameters\HeaderParameter
 */
class ArrayType extends AbstractTypedParameter implements HeaderParameterInterface, ArrayTypeInterface
{
    use Primitives\ArrayPrimitiveTrait;

    /**
     * @JMS\Type("array")
     * @var array
     */
    protected $default;
}
