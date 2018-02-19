<?php
/**
 * File StringType.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Epfremme\Swagger\Entity\Parameters\FormParameter;

use Epfremme\Swagger\Entity\Mixin\Primitives;
use Epfremme\Swagger\Entity\Parameters\AbstractTypedParameter;
use Epfremme\Swagger\Type\FormParameterInterface;
use Epfremme\Swagger\Type\StringTypeInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * Class StringType
 *
 * @package Epfremme\Swagger
 * @subpackage Entity\Parameters\FormParameter
 */
class StringType extends AbstractTypedParameter implements FormParameterInterface, StringTypeInterface
{
    use Primitives\StringPrimitiveTrait;

    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $default;
}
