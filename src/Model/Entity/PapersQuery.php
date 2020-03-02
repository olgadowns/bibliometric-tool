<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PapersQuery Entity
 *
 * @property int $id
 * @property int $paper_id
 * @property int $query_id
 *
 * @property \App\Model\Entity\Paper $paper
 * @property \App\Model\Entity\Query $query
 */
class PapersQuery extends Entity
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
        'paper_id' => true,
        'query_id' => true,
        'paper' => true,
        'query' => true,
    ];
}
