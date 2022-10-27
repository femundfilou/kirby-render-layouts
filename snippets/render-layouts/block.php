<?php
$options = $options ?? option('femundfilou.render-layouts.defaults')
?>
<div id="<?= $block->id() ?>" class="<?= $options['blockClass']?> <?= $options['blockClass']?>-type-<?= $block->type() ?>" data-block-type="<?= $block->type() ?>">
  <?php snippet('blocks/' . $block->type(), ['block' => $block]) ?>
</div>