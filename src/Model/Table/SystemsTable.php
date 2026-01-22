<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Systems Model
 *
 * @property \App\Model\Table\MasterCampaignsTable&\Cake\ORM\Association\HasMany $MasterCampaigns
 * @property \App\Model\Table\SystemTranslationsTable&\Cake\ORM\Association\HasMany $SystemTranslations
 *
 * @method \App\Model\Entity\System newEmptyEntity()
 * @method \App\Model\Entity\System newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\System> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\System get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\System findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\System patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\System> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\System|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\System saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\System>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\System>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\System>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\System> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\System>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\System>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\System>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\System> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SystemsTable extends Table
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

        $this->setTable('systems');
        $this->setDisplayField('slug');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('MasterCampaigns', [
            'foreignKey' => 'system_id',
        ]);
        $this->hasMany('SystemTranslations', [
            'foreignKey' => 'system_id',
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
            ->scalar('slug')
            ->maxLength('slug', 50)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->add('is_active', 'inList', [
                'rule' => ['inList', [0, 1, '0', '1', true, false, 'true', 'false']],
                'message' => 'Por favor, informe um valor válido para is_active.'
            ]);

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
        $rules->add($rules->isUnique(['slug']), ['errorField' => 'slug']);

        return $rules;
    }
}
