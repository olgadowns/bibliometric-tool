<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PaperDetails Model
 *
 * @property \App\Model\Table\PapersTable&\Cake\ORM\Association\BelongsTo $Papers
 *
 * @method \App\Model\Entity\PaperDetail newEmptyEntity()
 * @method \App\Model\Entity\PaperDetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PaperDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PaperDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\PaperDetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PaperDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PaperDetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PaperDetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaperDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaperDetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PaperDetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PaperDetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PaperDetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PaperDetailsTable extends Table
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

        $this->setTable('paper_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Papers', [
            'foreignKey' => 'paper_id',
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

        $validator
            ->scalar('paper_title')
            ->maxLength('paper_title', 16777215)
            ->requirePresence('paper_title', 'create')
            ->notEmptyString('paper_title');

        $validator
            ->scalar('methodology')
            ->maxLength('methodology', 255)
            ->requirePresence('methodology', 'create')
            ->notEmptyString('methodology');

        $validator
            ->integer('bias_score')
            ->notEmptyString('bias_score');

        $validator
            ->integer('rating')
            ->notEmptyString('rating');

        $validator
            ->scalar('notes')
            ->maxLength('notes', 4294967295)
            ->requirePresence('notes', 'create')
            ->notEmptyString('notes');

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

        return $rules;
    }
}
