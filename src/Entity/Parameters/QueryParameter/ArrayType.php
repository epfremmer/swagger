<?php
/**
 * File ArrayType.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Epfremme\Swagger\Entity\Parameters\QueryParameter;

use Epfremme\Swagger\Entity\Mixin\Primitives;
use Epfremme\Swagger\Entity\Parameters\AbstractTypedParameter;
use Epfremme\Swagger\Type\ArrayTypeInterface;
use Epfremme\Swagger\Type\QueryParameterInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * Class ArrayType
 *
 * @package Epfremme\Swagger
 * @subpackage Entity\Parameters\QueryParameter
 */
class ArrayType extends AbstractTypedParameter implements QueryParameterInterface, ArrayTypeInterface
{
    use Primitives\ArrayPrimitiveTrait;

    /**
     * @JMS\Type("array")
     * @var array
     */
    protected $default;
}
