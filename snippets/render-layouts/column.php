<?php
$options = $options ?? option('femundfilou.render-layouts.defaults');
$columnSpan = $column->span($options['columns']);
?>
<div class="<?= $options['columnClass'] ?> <?= $options['columnWidthClass']($columnSpan) ?>">
  <?php foreach ($column->blocks() as $block):
      snippet('render-layouts/block', ['block' => $block]);
  endforeach; ?>
</div>