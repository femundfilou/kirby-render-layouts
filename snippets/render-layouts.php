<?php
$defaultConfig = [
    'columns' => 12,
    'additionalColumnClasses' => [],
    'classes' => [
        'section' => 'section',
        'container' => 'container',
        'columns' => 'columns',
        'column' => 'column',
        'columnPrefix' => 'is-',
    ],
];

if (isset($config)) {
    $config = array_merge($defaultConfig, $config);
} else {
    $config = $defaultConfig;
}

foreach ($field->toLayouts() as $layout):
    $layoutSectionClass = isset($sectionClass) ? $sectionClass . ' ' . $layout->sectionClass() : $layout->sectionClass();
    $layoutContainerClass = isset($containerClass) ? $containerClass . ' ' . $layout->containerClass() : $layout->containerClass();
    $layoutColumnsClass = isset($columnsClass) ? $columnsClass . ' ' . $layout->columnsClass() : $layout->columnsClass();
    $layoutBackground = isset($background) ? $background . ' ' . $layout->background() : $layout->background();
    $layoutPadding = isset($padding) ? $padding . ' ' . $layout->padding() : $layout->padding();
    ?>

<section <?= $layout->navtitle()->isNotEmpty() ? 'data-nav="' . $layout->navtitle() . '"' : '' ;?>
  class="<?=$config['classes']['section']?> <?= $layoutSectionClass; ?> <?= $layoutPadding; ?> <?= $layoutBackground; ?>"
  id="<?= $layout->id()?>">
  <div class="<?=$config['classes']['container']?> <?= $layoutContainerClass; ?>">
    <div class="<?=$config['classes']['columns']?> <?= $layoutColumnsClass; ?>">
      <?php foreach ($layout->columns() as $column):?>
      <div class="<?=$config['classes']['column']?> <?= getColumnClasses($column->span($config['columns']), $config)?>">
        <?php foreach ($column->blocks() as $block): ?>
        <div id="<?= $block->id() ?>" class="block block-type-<?= $block->type() ?>" data-block-type="<?= $block->type() ?>">
          <?php snippet('blocks/' . $block->type(), [
              'block' => $block,
          ]) ?>
        </div>
        <?php endforeach ?>
      </div>
      <?php endforeach?>
    </div>
  </div>
</section>
<?php endforeach;?>