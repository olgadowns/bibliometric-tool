<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Author Entity
 *
 * @property int $id
 * @property string $name
 *
 * @property \App\Model\Entity\Paper[] $papers
 */
class Author extends Entity
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

     public function _getTotalPapers()
     {

       $authorsPapersTable = TableRegistry::getTableLocator()->get('AuthorsPapers');

       $papers_ids = $authorsPapersTable->find()->where(['author_id' => $this->id]);

       return $papers_ids->count();
       //return $authorsTable->find()->where([''])

     }


     public function _getPapers()
     {
       $papersTable = TableRegistry::getTableLocator()->get('Papers');
       $authorsPapersTable = TableRegistry::getTableLocator()->get('AuthorsPapers');

       $papers_ids = $authorsPapersTable->find()->where(['author_id' => $this->id]);
       //debug ($author_ids);

       $papers = [];

       foreach ($papers_ids as $id) {

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

    protected $_accessible = [
        'name' => true,
        'papers' => true,
    ];
}
