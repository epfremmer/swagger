<?php
/**
 * File NumberType.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Epfremme\Swagger\Entity\Parameters\FormParameter;

use Epfremme\Swagger\Entity\Mixin\Primitives;
use Epfremme\Swagger\Entity\Parameters\AbstractTypedParameter;
use Epfremme\Swagger\Type\FormParameterInterface;
use Epfremme\Swagger\Type\NumericTypeInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * Class NumberType
 *
 * @package Epfremme\Swagger
 * @subpackage Entity\Parameters\FormParameter
 */
class NumberType extends AbstractTypedParameter implements FormParameterInterface, NumericTypeInterface
{
    use Primitives\NumericPrimitiveTrait;

    /**
     * @JMS\Type("double")
     * @var double
     */
    protected $default;
}
