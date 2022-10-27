<?php

use Kirby\Exception\InvalidArgumentException;

if(!isset($field)) {
    throw new InvalidArgumentException('$field is missing');
}

$options = option('femundfilou.render-layouts.defaults');

if(isset($columns)) {
    $options['columns'] = $columns;
}
if(isset($sectionClass)) {
    $options['sectionClass'] = $sectionClass;
}
if(isset($containerClass)) {
    $options['containerClass'] = $containerClass;
}
if(isset($columnsClass)) {
    $options['columnsClass'] = $columnsClass;
}
if(isset($columnClass)) {
    $options['columnClass'] = $columnClass;
}
if(isset($blockClass)) {
    $options['blockClass'] = $blockClass;
}
if(isset($columnWidthClass)) {
    $options['columnWidthClass'] = $columnWidthClass;
}

foreach ($field->toLayouts() as $layout):
    snippet('render-layouts/layout', ['layout' => $layout, 'options' => $options]);
endforeach;
