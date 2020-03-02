<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Keyword Entity
 *
 * @property int $id
 * @property string $word
 *
 * @property \App\Model\Entity\Paper[] $papers
 */
class Keyword extends Entity
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

     public function _getPapers()
     {
       $papersTable = TableRegistry::getTableLocator()->get('Papers');
       $keywordsPapersTable = TableRegistry::getTableLocator()->get('PapersKeywords');

       $keyword_ids = $keywordsPapersTable->find()->where(['keyword_id' => $this->id]);
       //debug ($author_ids);

       $papers = [];

       foreach ($keyword_ids as $id) {

           $as = $papersTable->find()->where(['id' => $id->paper_id])->first();

           array_push($papers,
           [
             'id' => $as->id,
             'title' => $as->title,
           ]);

       }

       return $papers;
       //return $authorsTable->find()->where([''])

     }

     public function _getTotalPapers()
     {

         $keywordsPapersTable = TableRegistry::getTableLocator()->get('PapersKeywords');

         $keyword_ids = $keywordsPapersTable->find()->where(['keyword_id' => $this->id])->count();

         return $keyword_ids;

     }


    protected $_accessible = [
        'word' => true,
        'papers' => true,
    ];
}
