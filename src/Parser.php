<?php

namespace GlueApps\Annotations;

/**
 * @author Andy Daniel Navarro Taño <andaniel05@gmail.com>
 */
class Parser implements ParserInterface
{
    public function parse(string $text): array
    {
        $annotations = [];

        $pattern = '/@([a-zA-Z]\w*)( *\(.*\))?/';
        $matches = [];
        preg_match_all($pattern, $text, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $name = $match[1];
            $atts = [];

            if (isset($match[2])) {
                $attsPattern = '/([a-zA-Z]\w*)="([\w\.\,]*)"/';
                $attsMatches = [];
                preg_match_all($attsPattern, $match[2], $attsMatches, PREG_SET_ORDER);
                foreach ($attsMatches as $attrMatch) {
                    $atts[$attrMatch[1]] = $attrMatch[2];
                }
            }

            $annotations[] = new Annotation($name, $atts);
        }

        return $annotations;
    }
}
