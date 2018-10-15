<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemsFile[]|\Cake\Collection\CollectionInterface $itemsFiles
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Items File'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemsFiles index large-9 medium-8 columns content">
    <h3><?= __('Items Files') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('file_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itemsFiles as $itemsFile): ?>
            <tr>
                <td><?= $this->Number->format($itemsFile->id) ?></td>
                <td><?= $itemsFile->has('item') ? $this->Html->link($itemsFile->item->name, ['controller' => 'Items', 'action' => 'view', $itemsFile->item->id]) : '' ?></td>
                <td><?= $itemsFile->has('file') ? $this->Html->link($itemsFile->file->name, ['controller' => 'Files', 'action' => 'view', $itemsFile->file->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $itemsFile->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemsFile->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemsFile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemsFile->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
