<?php
/**
 * File BooleanType.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Epfremme\Swagger\Entity\Parameters\PathParameter;

use Epfremme\Swagger\Entity\Mixin\Primitives;
use Epfremme\Swagger\Entity\Parameters\AbstractTypedParameter;
use JMS\Serializer\Annotation as JMS;

/**
 * Class BooleanType
 *
 * @package Epfremme\Swagger
 * @subpackage Entity\Parameters\PathParameter
 */
class BooleanType extends AbstractTypedParameter
{
    use Primitives\BooleanPrimitiveTrait;

    /**
     * @JMS\Type("boolean")
     * @var string
     */
    protected $default;
}
