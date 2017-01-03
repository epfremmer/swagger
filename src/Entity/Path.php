<?php
/**
 * File Path.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Epfremme\Swagger\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\VisitorInterface;

/**
 * Class Path
 *
 * @package Epfremme\Swagger
 * @subpackage Entity
 */
class Path
{
    /**
     * @JMS\Inline()
     * @JMS\Since("2.0")
     * @JMS\SerializedName("data")
     * @JMS\Type("ArrayCollection<string,Epfremme\Swagger\Entity\Operation>")
     *
     * @var Operation[]|ArrayCollection
     */
    protected $operations;

    /**
     * @JMS\Since("2.0")
     * @JMS\Type("array")
     * @JMS\SerializedName("vendorExtensions")
     * @var string[]
     */
    protected $vendorExtensions;

    /**
     * @return Operation[]|ArrayCollection
     */
    public function getOperations()
    {
        return $this->operations;
    }

    /**
     * @param ArrayCollection $operations
     * @return Path
     */
    public function setOperations(ArrayCollection $operations)
    {
        $this->operations = $operations;
        return $this;
    }

    /**
     * @return \string[]
     */
    public function getVendorExtensions()
    {
        return $this->vendorExtensions;
    }

    /**
     * @param \string[] $vendorExtensions
     */
    public function setVendorExtensions($vendorExtensions)
    {
        $this->vendorExtensions = $vendorExtensions;
    }
}
