<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Papers Model
 *
 * @property \App\Model\Table\ContentTypesTable&\Cake\ORM\Association\BelongsTo $ContentTypes
 * @property \App\Model\Table\KeywordsTable&\Cake\ORM\Association\BelongsToMany $Keywords
 *
 * @method \App\Model\Entity\Paper newEmptyEntity()
 * @method \App\Model\Entity\Paper newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Paper[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Paper get($primaryKey, $options = [])
 * @method \App\Model\Entity\Paper findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Paper patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Paper[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Paper|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Paper saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Paper[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Paper[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Paper[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Paper[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PapersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('papers');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsTo('ContentTypes', [
            'foreignKey' => 'content_type_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('Authors', [
            'foreignKey' => 'paper_id',
            'targetForeignKey' => 'author_id',
            'joinTable' => 'authors_papers',
        ]);
        $this->belongsToMany('Keywords', [
            'foreignKey' => 'paper_id',
            'targetForeignKey' => 'keyword_id',
            'joinTable' => 'papers_keywords',
        ]);
        $this->belongsToMany('Queries', [
            'foreignKey' => 'paper_id',
            'targetForeignKey' => 'query_id',
            'joinTable' => 'papers_queries',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 16777215)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('abstract')
            ->maxLength('abstract', 4294967295)
            ->requirePresence('abstract', 'create')
            ->notEmptyString('abstract');

        $validator
            ->scalar('url')
            ->maxLength('url', 16777215)
            ->requirePresence('url', 'create')
            ->notEmptyString('url');

        $validator
            ->integer('has_fulltext')
            ->requirePresence('has_fulltext', 'create')
            ->notEmptyString('has_fulltext');

        $validator
            ->integer('is_peer_reviewed')
            ->requirePresence('is_peer_reviewed', 'create')
            ->notEmptyString('is_peer_reviewed');

        $validator
            ->scalar('issn')
            ->maxLength('issn', 255)
            ->requirePresence('issn', 'create')
            ->notEmptyString('issn');

        $validator
            ->scalar('eissn')
            ->maxLength('eissn', 255)
            ->requirePresence('eissn', 'create')
            ->notEmptyString('eissn');

        $validator
            ->scalar('doi')
            ->maxLength('doi', 255)
            ->requirePresence('doi', 'create')
            ->notEmptyString('doi');

        $validator
            ->scalar('pqid')
            ->maxLength('pqid', 255)
            ->requirePresence('pqid', 'create')
            ->notEmptyString('pqid');

        $validator
            ->scalar('ssid')
            ->maxLength('ssid', 255)
            ->requirePresence('ssid', 'create')
            ->notEmptyString('ssid');

        $validator
            ->date('publication_date')
            ->requirePresence('publication_date', 'create')
            ->notEmptyDate('publication_date');

        $validator
            ->integer('include')
            ->notEmptyString('include');

        $validator
            ->integer('rating')
            ->requirePresence('rating', 'create')
            ->notEmptyString('rating');

        $validator
            ->scalar('language')
            ->maxLength('language', 255)
            ->requirePresence('language', 'create')
            ->notEmptyString('language');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['content_type_id'], 'ContentTypes'));

        return $rules;
    }
}
