<?php
/**
 * File BooleanHeader.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Epfremme\Swagger\Entity\Headers;

use Epfremme\Swagger\Entity\Mixin\Primitives;


/**
 * Class BooleanHeader
 *
 * @package Epfremme\Swagger
 * @subpackage Entity\Headers
 */
class BooleanHeader extends AbstractHeader
{
    use Primitives\BooleanPrimitiveTrait;

    /**
     * {@inheritdoc}
     */
    protected $type = AbstractHeader::BOOLEAN_TYPE;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return AbstractHeader::BOOLEAN_TYPE;
    }
}
