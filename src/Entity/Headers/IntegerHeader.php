<?php
/**
 * File IntegerHeader.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Epfremme\Swagger\Entity\Headers;

use Epfremme\Swagger\Entity\Mixin\Primitives;

/**
 * Class IntegerHeader
 *
 * @package Epfremme\Swagger
 * @subpackage Entity\Headers
 */
class IntegerHeader extends AbstractHeader
{
    use Primitives\NumericPrimitiveTrait;

    /**
     * {@inheritdoc}
     */
    protected $type = AbstractHeader::INTEGER_TYPE;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return AbstractHeader::INTEGER_TYPE;
    }
}
