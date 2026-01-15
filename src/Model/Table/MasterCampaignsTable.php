<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MasterCampaigns Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $MasterUsers
 * @property \App\Model\Table\SystemsTable&\Cake\ORM\Association\BelongsTo $Systems
 *
 * @method \App\Model\Entity\MasterCampaign newEmptyEntity()
 * @method \App\Model\Entity\MasterCampaign newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MasterCampaign> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MasterCampaign get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MasterCampaign findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MasterCampaign patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MasterCampaign> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MasterCampaign|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MasterCampaign saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MasterCampaign>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MasterCampaign>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MasterCampaign>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MasterCampaign> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MasterCampaign>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MasterCampaign>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MasterCampaign>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MasterCampaign> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MasterCampaignsTable extends Table
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

        $this->setTable('master_campaigns');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MasterUsers', [
            'foreignKey' => 'master_user_id',
            'className' => 'Users',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Systems', [
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
            ->notEmptyString('master_user_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 150)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('cover_image')
            ->maxLength('cover_image', 255)
            ->allowEmptyFile('cover_image');

        $validator
            ->boolean('is_public')
            ->notEmptyString('is_public');

        $validator
            ->integer('max_players')
            ->requirePresence('max_players', 'create')
            ->notEmptyString('max_players');

        $validator
            ->date('start_date')
            ->allowEmptyDate('start_date');

        $validator
            ->scalar('invite_code')
            ->maxLength('invite_code', 20)
            ->allowEmptyString('invite_code')
            ->add('invite_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->notEmptyString('status');

        $validator
            ->allowEmptyString('system_id');

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
        $rules->add($rules->isUnique(['invite_code'], ['allowMultipleNulls' => true]), ['errorField' => 'invite_code']);
        $rules->add($rules->existsIn(['master_user_id'], 'MasterUsers'), ['errorField' => 'master_user_id']);
        $rules->add($rules->existsIn(['system_id'], 'Systems'), ['errorField' => 'system_id']);

        return $rules;
    }
}
