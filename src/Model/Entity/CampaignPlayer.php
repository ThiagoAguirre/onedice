<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CampaignPlayer Entity
 *
 * @property int $id
 * @property int $campaign_id
 * @property int $user_id
 * @property string $status
 * @property \Cake\I18n\DateTime|null $invited_at
 * @property \Cake\I18n\DateTime|null $responded_at
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\MasterCampaign $campaign
 * @property \App\Model\Entity\User $user
 */
class CampaignPlayer extends Entity
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
        'campaign_id' => true,
        'user_id' => true,
        'status' => true,
        'invited_at' => true,
        'responded_at' => true,
        'created' => true,
        'modified' => true,
        'campaign' => true,
        'user' => true,
    ];
}
