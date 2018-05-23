<?php

namespace GlueApps\Annotations\Tests;

use PHPUnit\Framework\TestCase;
use GlueApps\Annotations\Parser;
use GlueApps\Annotations\ParserInterface;

/**
 * @author Andy Daniel Navarro Taño <andaniel05@gmail.com>
 */
class ParserTest extends TestCase
{
    public function setUp()
    {
        $this->parser = new Parser;
    }

    public function testIsInstanceOfParserInterface()
    {
        $parser = $this->createMock(Parser::class);

        $this->assertInstanceOf(ParserInterface::class, $parser);
    }

    public function providerAnnotationWithoutAttributes()
    {
        return [
            [$name = uniqid('Annotation'), "@{$name}"],
            [$name = uniqid('Annotation'), "@{$name}()"],
        ];
    }

    /**
     * @dataProvider providerAnnotationWithoutAttributes
     */
    public function testAnnotationWithoutAttributes($name, $text)
    {
        $annotations = $this->parser->parse($text);
        $annotation = $annotations[0];

        $this->assertSame($name, $annotation->getName());
        $this->assertEmpty($annotation->getAttributes());
    }

    public function testAnnotationWithAttributes()
    {
        $name = uniqid('Annotation');
        $len = rand(2, 5);
        $attributes = $atts = [];
        for ($i = 0; $i <= $len; $i++) {
            $attr = uniqid('attr');
            $val = uniqid('val');
            $attributes[$attr] = $val;
            $atts[] = "{$attr}=\"{$val}\"";
        }
        $atts = implode(',', $atts);

        $text = "@{$name}({$atts})"; // @Annotation(attr1="val1", ...)
        $annotations = $this->parser->parse($text);
        $annotation = $annotations[0];

        $this->assertSame($name, $annotation->getName());
        $this->assertSame($attributes, $annotation->getAttributes());

        $firstAttr = array_keys($attributes)[0];
        $firstVal = array_values($attributes)[0];
        $this->assertSame($firstVal, $annotation->getAttribute($firstAttr));
    }

    public function testSeveralAnnotations()
    {
        $name1 = uniqid('Annotation');
        $name2 = uniqid('Annotation');
        $name3 = uniqid('Annotation');
        $attr = uniqid('attr');
        $val = uniqid('val');

        $annotations = $this->parser->parse("
            @{$name1}
            @{$name2}()
            @{$name3}({$attr}=\"{$val}\")
        ");

        $annotation1 = $annotations[0];
        $annotation2 = $annotations[1];
        $annotation3 = $annotations[2];

        $this->assertSame($name1, $annotation1->getName());
        $this->assertEmpty($annotation1->getAttributes());

        $this->assertSame($name2, $annotation2->getName());
        $this->assertEmpty($annotation2->getAttributes());

        $this->assertSame($name3, $annotation3->getName());
        $this->assertSame($val, $annotation3->getAttribute($attr));
    }
}
