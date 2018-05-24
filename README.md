## Usage

```php
<?php

use GlueApps\Annotations\Parser;

$text = '
@Annotation1
@Annotation2()
@Annotation3(attr1="val1", attr2="val2")
';

$annotations = (new Parser)->parse($text);
$annotation1 = $annotations[0];
$annotation2 = $annotations[1];
$annotation3 = $annotations[2];

$annotation1->getName(); // Annotation1
$annotation1->getAttributes(); // []

$annotation2->getName(); // Annotation2
$annotation2->getAttributes(); // []

$annotation3->getName(); // Annotation3
$annotation3->getAttributes(); // ['attr1' => 'val1', 'attr2' => 'val2']
$annotation3->getAttribute('attr1'); // val1

```
