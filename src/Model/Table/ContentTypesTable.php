<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContentTypes Model
 *
 * @property \App\Model\Table\PapersTable&\Cake\ORM\Association\HasMany $Papers
 *
 * @method \App\Model\Entity\ContentType newEmptyEntity()
 * @method \App\Model\Entity\ContentType newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ContentType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ContentType get($primaryKey, $options = [])
 * @method \App\Model\Entity\ContentType findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ContentType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ContentType[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ContentType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContentType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContentType[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ContentType[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ContentType[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ContentType[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ContentTypesTable extends Table
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

        $this->setTable('content_types');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Papers', [
            'foreignKey' => 'content_type_id',
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
            ->scalar('content_type')
            ->maxLength('content_type', 255)
            ->requirePresence('content_type', 'create')
            ->notEmptyString('content_type');

        return $validator;
    }
}
