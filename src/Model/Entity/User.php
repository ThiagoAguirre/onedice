<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string|null $display_name
 * @property string|null $bio
 * @property string|null $age_range
 * @property string|null $experience_level
 * @property string|null $role_preference
 * @property string|null $play_style
 * @property string $password
 * @property string $email
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 */
class User extends Entity
{
    /**
     * Hash password before saving to database
     *
     * @param string $password The password to hash
     * @return string|null The hashed password or null
     */
    protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
        return null;
    }

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'username' => true,
        'display_name' => true,
        'bio' => true,
        'age_range' => true,
        'experience_level' => true,
        'role_preference' => true,
        'play_style' => true,
        'password' => true,
        'password_confirm' => true,
        'email' => true,
        'created' => true,
        'modified' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected array $_hidden = [
        'password',
    ];
}
