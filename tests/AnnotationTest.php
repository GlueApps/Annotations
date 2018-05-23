<?php

namespace GlueApps\Annotations\Tests;

use PHPUnit\Framework\TestCase;
use GlueApps\Annotations\Annotation;
use GlueApps\Annotations\AnnotationInterface;

/**
 * @author Andy Daniel Navarro Taño <andaniel05@gmail.com>
 */
class AnnotationTest extends TestCase
{
    public function testIsInstanceOfAnnotationInterface()
    {
        $annotation = $this->createMock(Annotation::class);

        $this->assertInstanceOf(AnnotationInterface::class, $annotation);
    }
}
