<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Query Entity
 *
 * @property int $id
 * @property string $query
 * @property int $number_of_results
 * @property string $from_database
 * @property \Cake\I18n\FrozenDate $date_from
 * @property \Cake\I18n\FrozenDate $date_to
 *
 * @property \App\Model\Entity\Paper[] $papers
 */
class Query extends Entity
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
        'query' => true,
        'number_of_results' => true,
        'from_database' => true,
        'date_from' => true,
        'date_to' => true,
        'papers' => true,
    ];
}
