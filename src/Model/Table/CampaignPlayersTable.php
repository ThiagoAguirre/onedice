<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CampaignPlayers Model
 *
 * @property \App\Model\Table\MasterCampaignsTable&\Cake\ORM\Association\BelongsTo $Campaigns
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\CampaignPlayer newEmptyEntity()
 * @method \App\Model\Entity\CampaignPlayer newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\CampaignPlayer> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CampaignPlayer get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\CampaignPlayer findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\CampaignPlayer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\CampaignPlayer> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CampaignPlayer|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\CampaignPlayer saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\CampaignPlayer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CampaignPlayer>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CampaignPlayer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CampaignPlayer> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CampaignPlayer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CampaignPlayer>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CampaignPlayer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CampaignPlayer> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CampaignPlayersTable extends Table
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

        $this->setTable('campaign_players');
        $this->setDisplayField('status');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Campaigns', [
            'foreignKey' => 'campaign_id',
            'className' => 'MasterCampaigns',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->notEmptyString('campaign_id');

        $validator
            ->notEmptyString('user_id');

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->notEmptyString('status');

        $validator
            ->dateTime('invited_at')
            ->allowEmptyDateTime('invited_at');

        $validator
            ->dateTime('responded_at')
            ->allowEmptyDateTime('responded_at');

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
        $rules->add($rules->isUnique(['campaign_id', 'user_id']), ['errorField' => 'campaign_id']);
        $rules->add($rules->existsIn(['campaign_id'], 'Campaigns'), ['errorField' => 'campaign_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
