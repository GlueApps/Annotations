<?php

namespace GlueApps\Annotations;

/**
 * @author Andy Daniel Navarro Taño <andaniel05@gmail.com>
 */
class Annotation implements AnnotationInterface
{
    protected $name;
    protected $attributes;

    public function __construct(string $name, array $attributes = [])
    {
        $this->name = $name;
        $this->attributes = $attributes;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getAttribute(string $attribute)
    {
        return $this->attributes[$attribute] ?? null;
    }
}
