<?php
use Kirby\Exception\InvalidArgumentException;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Str;

$options = $options ?? option('femundfilou.render-layouts.defaults');

$customAttributes = [];
if($fields = option('femundfilou.render-layouts.fields')) {
    foreach($fields as $key => $value) {
        if(is_callable($value) && $userfield = $value($layout)) {
            if(!A::isAssociative($userfield)) {
                throw new InvalidArgumentException("Error in custom layout field. Field '$key' must return an associative array.");
            }
            $customAttributes = A::extend($customAttributes, $userfield);
        } else {
            $customAttributes[$value] = $layout->$key()->value();
        }
    }
}

$attributes = A::map(A::extend(
    $customAttributes,
    ['class' => $options['sectionClass']],
    ['class' => $layout->sectionClass()->isNotEmpty() ? $layout->sectionClass()->value() : '']
), fn ($item) => is_array($item) ? Str::trim(A::join($item, ' ')) : $item);
?>
<section <?= attr($attributes)?> id="<?= $layout->id() ?>">
  <div class="<?= $options['containerClass']?><?= e($layout->containerClass()->isNotEmpty(), ' ' . $layout->containerClass())?>">
    <div class="<?= $options['columnsClass']?><?= e($layout->columnsClass()->isNotEmpty(), ' ' . $layout->columnsClass())?>">
      <?php foreach($layout->columns() as $column):
          snippet('render-layouts/column', ['column' => $column]);
      endforeach; ?>
    </div>
  </div>
</section>