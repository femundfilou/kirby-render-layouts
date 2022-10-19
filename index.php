<?php

Kirby\Cms\App::plugin('fhr/render-layouts', [
    'snippets' => [
        'render-layouts' => __DIR__ . '/snippets/render-layouts.php',
    ]
]);


function getColumnClasses($columnSpan, $config)
{
    $baseClass = $config['classes']['columnPrefix'] . $columnSpan;
    $extra =
      isset($config['additionalColumnClasses']) &&
      isset($config['additionalColumnClasses'][$columnSpan])
        ? ' ' . $config['additionalColumnClasses'][$columnSpan]
        : '';
    return $baseClass . $extra;
}
