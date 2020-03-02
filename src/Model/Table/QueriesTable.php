<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Queries Model
 *
 * @property \App\Model\Table\PapersTable&\Cake\ORM\Association\BelongsToMany $Papers
 *
 * @method \App\Model\Entity\Query newEmptyEntity()
 * @method \App\Model\Entity\Query newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Query[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Query get($primaryKey, $options = [])
 * @method \App\Model\Entity\Query findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Query patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Query[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Query|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Query saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Query[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Query[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Query[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Query[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class QueriesTable extends Table
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

        $this->setTable('queries');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Papers', [
            'foreignKey' => 'query_id',
            'targetForeignKey' => 'paper_id',
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
            ->scalar('query')
            ->maxLength('query', 16777215)
            ->requirePresence('query', 'create')
            ->notEmptyString('query');

        $validator
            ->integer('number_of_results')
            ->requirePresence('number_of_results', 'create')
            ->notEmptyString('number_of_results');

        $validator
            ->scalar('from_database')
            ->maxLength('from_database', 255)
            ->requirePresence('from_database', 'create')
            ->notEmptyString('from_database');

        $validator
            ->date('date_from')
            ->requirePresence('date_from', 'create')
            ->notEmptyDate('date_from');

        $validator
            ->date('date_to')
            ->requirePresence('date_to', 'create')
            ->notEmptyDate('date_to');

        return $validator;
    }
}
