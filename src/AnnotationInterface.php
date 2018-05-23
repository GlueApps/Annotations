<?php

namespace GlueApps\Annotations;

/**
 * @author Andy Daniel Navarro Taño <andaniel05@gmail.com>
 */
interface AnnotationInterface
{
    public function getName(): string;

    public function getAttributes(): array;

    public function getAttribute(string $attribute);
}
