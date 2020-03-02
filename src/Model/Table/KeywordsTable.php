<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Keywords Model
 *
 * @property \App\Model\Table\PapersTable&\Cake\ORM\Association\BelongsToMany $Papers
 *
 * @method \App\Model\Entity\Keyword newEmptyEntity()
 * @method \App\Model\Entity\Keyword newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Keyword[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Keyword get($primaryKey, $options = [])
 * @method \App\Model\Entity\Keyword findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Keyword patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Keyword[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Keyword|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Keyword saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Keyword[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Keyword[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Keyword[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Keyword[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class KeywordsTable extends Table
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

        $this->setTable('keywords');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Papers', [
            'foreignKey' => 'keyword_id',
            'targetForeignKey' => 'paper_id',
            'joinTable' => 'papers_keywords',
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
            ->scalar('word')
            ->requirePresence('word', 'create')
            ->notEmptyString('word');

        return $validator;
    }
}
