<?php
/**
 * File FileType.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Epfremme\Swagger\Entity\Parameters\FormParameter;

use Epfremme\Swagger\Entity\Parameters\AbstractTypedParameter;
use Epfremme\Swagger\Type\FileTypeInterface;
use Epfremme\Swagger\Type\FormParameterInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * Class FileType
 *
 * @package Epfremme\Swagger
 * @subpackage Entity\Parameters\FormParameter
 */
class FileType extends AbstractTypedParameter implements FormParameterInterface, FileTypeInterface
{
    /**
     * @JMS\Type("string")
     * @var string
     */
    protected $default;
}
