<?php
/**
 * File StringPrimitiveTraitTest.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Epfremmer\SwaggerBundle\Tests\Entity\Schemas\Primitives;

use Epfremmer\SwaggerBundle\Entity\Schemas\Primitives\StringPrimitive;

/**
 * Class StringPrimitiveTraitTest
 *
 * @package Epfremmer\SwaggerBundle
 * @subpackage Tests\Entity\Schemas\Primitives
 */
class StringPrimitiveTraitTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var StringPrimitive|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $mockTrait;

    /**
     * Mock Classname
     * @var string
     */
    protected $mockClass;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mockTrait = $this->getMockForTrait(StringPrimitive::class);
        $this->mockClass = get_class($this->mockTrait);
    }

    /**
     * @covers Epfremmer\SwaggerBundle\Entity\Schemas\Primitives\StringPrimitive::getMaxLength
     * @covers Epfremmer\SwaggerBundle\Entity\Schemas\Primitives\StringPrimitive::setMaxLength
     */
    public function testMaxLength()
    {
        $this->assertClassHasAttribute('maxLength', $this->mockClass);
        $this->assertInstanceOf($this->mockClass, $this->mockTrait->setMaxLength(5));
        $this->assertAttributeInternalType('integer', 'maxLength', $this->mockTrait);
        $this->assertAttributeEquals(5, 'maxLength', $this->mockTrait);
        $this->assertEquals(5, $this->mockTrait->getMaxLength());
    }

    /**
     * @covers Epfremmer\SwaggerBundle\Entity\Schemas\Primitives\StringPrimitive::getMinLength
     * @covers Epfremmer\SwaggerBundle\Entity\Schemas\Primitives\StringPrimitive::setMinLength
     */
    public function testMinLength()
    {
        $this->assertClassHasAttribute('minLength', $this->mockClass);
        $this->assertInstanceOf($this->mockClass, $this->mockTrait->setMinLength(2));
        $this->assertAttributeInternalType('integer', 'minLength', $this->mockTrait);
        $this->assertAttributeEquals(2, 'minLength', $this->mockTrait);
        $this->assertEquals(2, $this->mockTrait->getMinLength());
    }

    /**
     * @covers Epfremmer\SwaggerBundle\Entity\Schemas\Primitives\StringPrimitive::getPattern
     * @covers Epfremmer\SwaggerBundle\Entity\Schemas\Primitives\StringPrimitive::setPattern
     */
    public function testPattern()
    {
        $this->assertClassHasAttribute('pattern', $this->mockClass);
        $this->assertInstanceOf($this->mockClass, $this->mockTrait->setPattern('foo'));
        $this->assertAttributeInternalType('string', 'pattern', $this->mockTrait);
        $this->assertAttributeEquals('foo', 'pattern', $this->mockTrait);
        $this->assertEquals('foo', $this->mockTrait->getPattern());
    }
}
