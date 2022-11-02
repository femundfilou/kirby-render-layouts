# Kirby Render Layouts

This plugin adds a snippet to render layout fields in structured way. By default, it uses [bulma.io](https://bulma.io) classes to do so.

## Installation

The best way is to install it via composer.

```sh
composer require femundfilou/kirby-render-layouts
```

## Usage

Whenever you are using a `type: layouts` field in your blueprint, you can use the provided snippet to render your field.

```php
snippet('render-layouts', ['field' => $page->myLayoutFieldName()]);
```

This will render the following basic markup for each layout you add in the panel.

```html
<section class="section">
  <div class="container">
    <div class="columns">
      <div class="column is-[fraction]">
        <div class="block block-type-[myblock]" data-block-type="[myblock]">
          ...
        </div>
      </div>
    </div>
  </div>
</section>
```

## Configuration

You can override the default configuration inside your `config.php` as well as on each snippet itself.

### Override in `config.php`

```php
return [
  'femundfilou.render-layouts.defaults' => [
    'columns' => 12, // Defines the max columns count, used to calculate each columns fraction.
    'sectionClass' => 'section', // Default class used for section
    'containerClass' => 'container', // Default class used for container
    'columnsClass' => 'columns', // Default class used for columns
    'columnClass' => 'column', // Default class used for column
    'blockClass' => 'block',  // Default class uses for block
    'columnWidthClass' => function(int $columnSpan) {
        // Return a string which is used on each indidual column as a width class
        return  'is-' . $columnSpan;
    }
  ],
];
```

### Override in snippet

```php
snippet('render-layouts', ['field' => $page->myLayoutFieldName(), 'columnsClass' => 'grid']);
```

which will result in the following markup on this page.

```html
<section class="section">
  <div class="container">
    <div class="grid">
      <div class="column is-[fraction]">
        <div class="block block-type-[myblock]" data-block-type="[myblock]">
          ...
        </div>
      </div>
    </div>
  </div>
</section>
```

## Custom attributes & layout settings

To further customize each layout, this plugin provides an easy way to use fields defined as [layout settings](https://getkirby.com/docs/reference/panel/fields/layout#layout-settings).

### Predefined fields

There are three reserved field names you can use to add classes to the different wrappers. Simply use them inside your layout settings fields like this:

```yml
mylayoutfield:
  label: Layout
  type: layout
  layouts:
    - "1/1"
    - "1/2, 1/2"
  settings:
    fields:
      sectionClass:
        label: Section
        type: select
        options:
          'my-section-class' : 'Example'
        ...
      containerClass:
        ...
      columnsClass:
        ...

```

### Use your own fields and attributes

Beside the predefined fields, you can use any of your own fields to add **attributes** to the `section`.
First add the fields to your layout field, e.g.

```yml
mylayoutfield:
  label: Layout
  type: layout
  layouts:
    - "1/1"
    - "1/2, 1/2"
  settings:
    fields:
      spacingclass:
        label: Spacing
        type: select
        options:
          '' : Default
          'is-medium': Medium
          'is-large': Large
      background:
        label: Background color
        type: toggles
        default: ''
        options:
          'transparent' : No background
          '#000' : Black
          '#fff' : White
```

Then define the fields you want to use inside your `config.php`. In the `femundfilou.render-layouts.fields` array define the **field name** that should be used as key and the **attribute** or a function returning an associative array as value.

```php
return [
'femundfilou.render-layouts.fields' => [
    // Provide an field name and attribute
    'spacingclass' => 'class'
    // Or use a function to go crazy. You event get access to the current layout.
    'background' => function($layout) {
      // Return attribute and value
      return ['style' => '--background-color: ' . $layout->background(). ';'];
    },
  }
]
```

This will result in the following markup.

```html
<section class="section is-medium" style="--background-color: #000;">
  <div class="container">
    <div class="columns">
      <div class="column is-[fraction]">
        <div class="block block-type-[myblock]" data-block-type="[myblock]">
          ...
        </div>
      </div>
    </div>
  </div>
</section>
```