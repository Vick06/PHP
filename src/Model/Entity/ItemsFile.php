<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItemsFile Entity
 *
 * @property int $id
 * @property int $item_id
 * @property int $file_id
 *
 * @property \App\Model\Entity\Item $item
 * @property \App\Model\Entity\File $file
 */
class ItemsFile extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'item_id' => true,
        'file_id' => true,
        'item' => true,
        'file' => true
    ];
}
