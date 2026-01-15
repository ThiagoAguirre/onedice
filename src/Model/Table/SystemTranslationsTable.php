<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SystemTranslations Model
 *
 * @property \App\Model\Table\SystemsTable&\Cake\ORM\Association\BelongsTo $Systems
 *
 * @method \App\Model\Entity\SystemTranslation newEmptyEntity()
 * @method \App\Model\Entity\SystemTranslation newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\SystemTranslation> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SystemTranslation get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\SystemTranslation findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\SystemTranslation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\SystemTranslation> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SystemTranslation|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\SystemTranslation saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\SystemTranslation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SystemTranslation>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\SystemTranslation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SystemTranslation> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\SystemTranslation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SystemTranslation>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\SystemTranslation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SystemTranslation> deleteManyOrFail(iterable $entities, array $options = [])
 */
class SystemTranslationsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('system_translations');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Systems', [
            'foreignKey' => 'system_id',
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
            ->notEmptyString('system_id');

        $validator
            ->scalar('locale')
            ->maxLength('locale', 10)
            ->requirePresence('locale', 'create')
            ->notEmptyString('locale');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

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
        $rules->add($rules->isUnique(['system_id', 'locale']), ['errorField' => 'system_id']);
        $rules->add($rules->existsIn(['system_id'], 'Systems'), ['errorField' => 'system_id']);

        return $rules;
    }
}
