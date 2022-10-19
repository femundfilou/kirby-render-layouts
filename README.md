# Kirby render layouts

This plugin adds a snippet to render layout fields in structured way. By default, it uses [bulma.io](https://bulma.io) classes to do so.

## Installation

The best way is to install it via composer.

```
composer require femundfilou/kirby-render-layouts
```

## Usage

Whenever you are using a `type: layouts` field in your blueprint, render it using the provided snippet.

```
<?= snippet('render-layouts', ['field' => $page->myLayoutFieldName()]); ?>
```

## Possible field settings

You can add some fields to your blueprint layout settings to further modify the rendered result. Each layout can have the following settings fields.
The best user experience for your panel users may occur when using select options for these fields.
All of these fields may also be provided as snippet parameters, if you wish to add those classes to all layouts.

| key              |  type  | description                                                                    |
| :--------------- | :----: | :----------------------------------------------------------------------------- |
| `padding`        | string | Add a padding class to your **section**.                                       |
| `background`     | string | Add a background class to your **section**.                                    |
| `sectionClass`   | string | Add an abitrary class to your **section**.                                     |
| `containerClass` | string | Add a abitrary class to your **container**.                                    |
| `columnsClass`   | string | Add a abitrary class to your **columns**.                                      |
| `navTitle`       | string | Add a `data-Attribute` added to your **section**, used for on page navigation. |

### Example: Add global columnsClass to all layouts

```
<?= snippet('render-layouts', ['field' => $page->myLayoutFieldName(), 'columnsClass' => 'is-vcentered']); ?>
```

## Options

You can pass on `$options` object to the snippet, to modify it's behavior.
The following options are available.

| key                       |  type  | default | description                                                                                                   |
| :------------------------ | :----: | :-----: | :------------------------------------------------------------------------------------------------------------ |
| `columns`                 | number |  `12`   | number of columns in your grid                                                                                |
| `additionalColumnClasses` | object |  `[]`   | Add additional column classes based on the columns size. This is useful for responsive classes. (see example) |
| `classes`                 | object |  `[]`   | Overwrite the default bulma classes with your own. (see example)                                              |

### Example: Add responsive classes

You can pass an object named `additionalColumnClasses` to your `$config` to add additional classes on columns. The object needs to be keyed by the column size, you want this classes to be added.

```
<?php
  $config = [
    "additionalColumnClasses" => [
      "6" => "is-10-tablet"
    ]
  ];
?>
<?= snippet('render-layouts', ['field' => $page->myLayoutFieldName(), 'config' => $config]); ?>

```

This will add `is-10-tablet` to the `column is-6` element.

### Example: Overwrite default classes

You can pass an object named `classes` to your `$config` to overwrite the default classes used in the snippet with your own. This is useful, if you're planning to use a different grid system than bulma.io.

```
<?php
  $config = [
    "classes" => [
      "section" => "my-section",
      "container" => "my-container",
      "columns" => "grid",
      "column" => "grid__cell",
      "columnPrefix" => "grid__cell--"
    ]
  ];
?>
<?= snippet('render-layouts', ['field' => $page->myLayoutFieldName(), 'config' => $config]); ?>
```
