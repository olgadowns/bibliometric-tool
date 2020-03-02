<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Paper Entity
 *
 * @property int $id
 * @property string $title
 * @property string $abstract
 * @property string $url
 * @property int $has_fulltext
 * @property int $is_peer_reviewed
 * @property int $content_type_id
 * @property string $issn
 * @property string $eissn
 * @property string $doi
 * @property string $pqid
 * @property string $ssid
 * @property \Cake\I18n\FrozenDate $publication_date
 * @property int $include
 * @property int $rating
 * @property string $language
 *
 * @property \App\Model\Entity\ContentType $content_type
 * @property \App\Model\Entity\PapersQuery[] $papers_queries
 * @property \App\Model\Entity\Keyword[] $keywords
 */
class Paper extends Entity
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

     public function _getAuthors()
     {
       $authorsTable = TableRegistry::getTableLocator()->get('Authors');
       $authorsPapersTable = TableRegistry::getTableLocator()->get('AuthorsPapers');

       $author_ids = $authorsPapersTable->find()->where(['paper_id' => $this->id]);
       //debug ($author_ids);

       $authors = [];

       foreach ($author_ids as $id) {
           $as = $authorsTable->find()->where(['id' => $id->author_id])->first();

           array_push($authors,
           [
             'id' => $as->id,
             'name' => $as->name,
           ]);

       }

       return $authors;
       //return $authorsTable->find()->where([''])

     }

     public function _getKeywords()
     {
       $keywordsTable = TableRegistry::getTableLocator()->get('Keywords');
       $keywordsPapersTable = TableRegistry::getTableLocator()->get('PapersKeywords');

       $keyword_ids = $keywordsPapersTable->find()->where(['paper_id' => $this->id]);

       $keywords = [];

       foreach ($keyword_ids as $id) {
           $as = $keywordsTable->find()->where(['id' => $id->keyword_id])->first();

           array_push($keywords,
           [
             'id' => $as->id,
             'word' => $as->word,
           ]);

       }

       return $keywords;
       //return $authorsTable->find()->where([''])

     }


    protected $_accessible = [
        'title' => true,
        'abstract' => true,
        'url' => true,
        'has_fulltext' => true,
        'is_peer_reviewed' => true,
        'content_type_id' => true,
        'issn' => true,
        'eissn' => true,
        'doi' => true,
        'pqid' => true,
        'ssid' => true,
        'publication_date' => true,
        'include' => true,
        'rating' => true,
        'language' => true,
        'content_type' => true,
        'papers_queries' => true,
        'keywords' => true,
    ];
}
