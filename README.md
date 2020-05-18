# php-graphs

## Functions for working with Graphs

```php
<?php

use function PhpGraphs\Graphs\makeJoints;
use function PhpGraphs\Graphs\buildTreeFromLeaf;
use function PhpGraphs\Graphs\sortJoints;
```

## Examples

```php
<?php

$tree = ['B', [
    ['D'],
    ['A', [
        ['C', [
            ['F'],
            ['E'],
        ]],
    ]],
]];

$joints = makeJoints($tree);
$transformed = buildTreeFromLeaf($joints, 'C');
// ['C', [
//     ['F'],
//     ['E'],
//     ['A', [
//         ['B', [
//             ['D'],
//         ]],
//     ]],
// ]];

sortTree($transformed);
// ['C', [
//     ['A', [
//         ['B', [
//             ['D'],
//         ]],
//     ]],
//     ['E'],
//     ['F'],
// ]];
```

[![Hexlet Ltd. logo](https://raw.githubusercontent.com/Hexlet/hexletguides.github.io/master/images/hexlet_logo128.png)](https://ru.hexlet.io/pages/about?utm_source=github&utm_medium=link&utm_campaign=php-eloquent-blog)

This repository is created and maintained by the team and the community of Hexlet, an educational project. [Read more about Hexlet (in Russian)](https://ru.hexlet.io/pages/about?utm_source=github&utm_medium=link&utm_campaign=php-eloquent-blog).
