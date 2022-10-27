<?php

use Kirby\Cms\App;

App::plugin('femundfilou/render-layouts', [
    'options' => [
        'defaults' => [
            'columns' => 12,
            'sectionClass' => 'section',
            'containerClass' => 'container',
            'columnsClass' => 'columns',
            'columnClass' => 'column',
            'blockClass' => 'block',
            'columnWidthClass' => function (int $columnSpan) {
                return  'is-' . $columnSpan;
            }
        ],
    ],
    'snippets' => [
        'render-layouts' => __DIR__ . '/snippets/render-layouts.php',
        'render-layouts/layout' => __DIR__ . '/snippets/render-layouts/layout.php',
        'render-layouts/column' => __DIR__ . '/snippets/render-layouts/column.php',
        'render-layouts/block' => __DIR__ . '/snippets/render-layouts/block.php',
    ]
]);
