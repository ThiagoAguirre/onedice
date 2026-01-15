<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MasterCampaign Entity
 *
 * @property int $id
 * @property int $master_user_id
 * @property string $name
 * @property string|null $description
 * @property string|null $cover_image
 * @property bool $is_public
 * @property int $max_players
 * @property \Cake\I18n\Date|null $start_date
 * @property string|null $invite_code
 * @property string $status
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property int|null $system_id
 *
 * @property \App\Model\Entity\User $master_user
 * @property \App\Model\Entity\System $system
 */
class MasterCampaign extends Entity
{
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
        'master_user_id' => true,
        'name' => true,
        'description' => true,
        'cover_image' => true,
        'is_public' => true,
        'max_players' => true,
        'start_date' => true,
        'invite_code' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'system_id' => true,
        'master_user' => true,
        'system' => true,
    ];
}
