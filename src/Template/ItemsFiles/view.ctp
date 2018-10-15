<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemsFile $itemsFile
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Items File'), ['action' => 'edit', $itemsFile->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Items File'), ['action' => 'delete', $itemsFile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemsFile->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Items Files'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Items File'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemsFiles view large-9 medium-8 columns content">
    <h3><?= h($itemsFile->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= $itemsFile->has('item') ? $this->Html->link($itemsFile->item->name, ['controller' => 'Items', 'action' => 'view', $itemsFile->item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File') ?></th>
            <td><?= $itemsFile->has('file') ? $this->Html->link($itemsFile->file->name, ['controller' => 'Files', 'action' => 'view', $itemsFile->file->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemsFile->id) ?></td>
        </tr>
    </table>
</div>
