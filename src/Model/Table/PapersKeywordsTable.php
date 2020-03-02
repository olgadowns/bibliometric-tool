<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PapersKeywords Model
 *
 * @property \App\Model\Table\PapersTable&\Cake\ORM\Association\BelongsTo $Papers
 * @property \App\Model\Table\KeywordsTable&\Cake\ORM\Association\BelongsTo $Keywords
 *
 * @method \App\Model\Entity\PapersKeyword newEmptyEntity()
 * @method \App\Model\Entity\PapersKeyword newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PapersKeyword[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PapersKeyword get($primaryKey, $options = [])
 * @method \App\Model\Entity\PapersKeyword findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PapersKeyword patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PapersKeyword[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PapersKeyword|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PapersKeyword saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PapersKeyword[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PapersKeyword[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PapersKeyword[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PapersKeyword[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PapersKeywordsTable extends Table
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

        $this->setTable('papers_keywords');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Papers', [
            'foreignKey' => 'paper_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Keywords', [
            'foreignKey' => 'keyword_id',
            'joinType' => 'INNER',
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
        $rules->add($rules->existsIn(['paper_id'], 'Papers'));
        $rules->add($rules->existsIn(['keyword_id'], 'Keywords'));

        return $rules;
    }
}
