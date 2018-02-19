<?php
/**
 * File IntegerType.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Epfremme\Swagger\Entity\Parameters\PathParameter;

use Epfremme\Swagger\Entity\Mixin\Primitives;
use Epfremme\Swagger\Entity\Parameters\AbstractTypedParameter;
use Epfremme\Swagger\Type\NumericTypeInterface;
use Epfremme\Swagger\Type\PathParameterInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * Class IntegerType
 *
 * @package Epfremme\Swagger
 * @subpackage Entity\Parameters\PathParameter
 */
class IntegerType extends AbstractTypedParameter implements PathParameterInterface, NumericTypeInterface
{
    use Primitives\NumericPrimitiveTrait;

    /**
     * @JMS\Type("integer")
     * @var integer
     */
    protected $default;
}
