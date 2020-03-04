<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PaperDetail Entity
 *
 * @property int $id
 * @property int $paper_id
 * @property string $paper_title
 * @property string $methodology
 * @property int $bias_score
 * @property int $rating
 * @property string $notes
 * @property \Cake\I18n\FrozenTime $updated
 *
 * @property \App\Model\Entity\Paper $paper
 */
class PaperDetail extends Entity
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
        'paper_title' => true,
        'methodology' => true,
        'bias_score' => true,
        'rating' => true,
        'notes' => true,
        'updated' => true,
        'paper' => true,
    ];
}
