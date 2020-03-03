<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

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

    public function _getPapers()
    {
        $papersTable = TableRegistry::getTableLocator()->get('Papers');
        $queryPapersTable = TableRegistry::getTableLocator()->get('PapersQueries');

        $paper_ids = $queryPapersTable->find()->where(['query_id' => $this->id]);
        //debug ($author_ids);

        $papers = [];

        foreach ($paper_ids as $id) {

            $as = $papersTable->find()->where(['id' => $id->paper_id])->first();

            //debug ($as);

            array_push($papers,
                [
                    'id' => $as->id,
                    'title' => $as->title,
                ]);

            if (sizeof($papers) > 100)
            {
                return $papers;
            }


        }

        return $papers;
        //return $authorsTable->find()->where([''])

    }

    public function _getTotalPapers()
    {

        $queryPapersTable = TableRegistry::getTableLocator()->get('PapersQueries');

        $keyword_ids = $queryPapersTable->find()->where(['query_id' => $this->id])->count();

        return $keyword_ids;

    }


    protected $_accessible = [
        'query' => true,
        'number_of_results' => true,
        'from_database' => true,
        'date_from' => true,
        'date_to' => true,
        'papers' => true,
    ];
}
