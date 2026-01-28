<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\User> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\User> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('CampaignPlayers', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsToMany('Countries', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'country_id',
            'joinTable' => 'users_countries',
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
            ->scalar('username')
            ->maxLength('username', 50)
            ->requirePresence('username', 'create')
            ->notEmptyString('username');

        $validator
            ->scalar('display_name')
            ->maxLength('display_name', 100)
            ->allowEmptyString('display_name');

        $validator
            ->scalar('bio')
            ->allowEmptyString('bio');

        $validator
            ->scalar('age_range')
            ->maxLength('age_range', 20)
            ->allowEmptyString('age_range');

        $validator
            ->scalar('experience_level')
            ->maxLength('experience_level', 20)
            ->allowEmptyString('experience_level');

        $validator
            ->scalar('role_preference')
            ->maxLength('role_preference', 20)
            ->allowEmptyString('role_preference');

        $validator
            ->scalar('play_style')
            ->maxLength('play_style', 20)
            ->allowEmptyString('play_style');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password', __('Password is required.'))
            ->minLength('password', 8, __('Password must be at least 8 characters long.'))
            ->add('password', 'hasUppercase', [
                'rule' => function ($value, $context) {
                    return is_string($value) && (bool)preg_match('/[A-Z]/', $value);
                },
                'message' => __('Password must contain at least one uppercase letter.'),
            ])
            ->add('password', 'hasNumber', [
                'rule' => function ($value, $context) {
                    return is_string($value) && (bool)preg_match('/[0-9]/', $value);
                },
                'message' => __('Password must contain at least one number.'),
            ])
            ->add('password', 'hasSymbol', [
                'rule' => function ($value, $context) {
                    return is_string($value) && (bool)preg_match('/[^A-Za-z0-9]/', $value);
                },
                'message' => __('Password must contain at least one symbol.'),
            ]);

        $validator
            ->requirePresence('password_confirm', 'create')
            ->notEmptyString('password_confirm', __('Please confirm your password.'))
            ->add('password_confirm', 'compareWith', [
                'rule' => ['compareWith', 'password'],
                'message' => __('Passwords must match.'),
            ]);

        $validator
            ->email('email', false, __('Please provide a valid email address.'))
            ->requirePresence('email', 'create')
            ->notEmptyString('email', __('Email is required.'));

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
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);

        return $rules;
    }
}
