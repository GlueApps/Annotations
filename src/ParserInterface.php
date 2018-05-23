<?php

namespace GlueApps\Annotations;

/**
 * @author Andy Daniel Navarro Taño <andaniel05@gmail.com>
 */
interface ParserInterface
{
    public function parse(string $text): array;
}
