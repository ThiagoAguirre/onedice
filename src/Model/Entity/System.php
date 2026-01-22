<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * System Entity
 *
 * @property int $id
 * @property string $slug
 * @property bool $is_active
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\MasterCampaign[] $master_campaigns
 * @property \App\Model\Entity\SystemTranslation[] $system_translations
 */
class System extends Entity
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
        'slug' => true,
        'is_active' => true,
        'created' => true,
        'modified' => true,
        'master_campaigns' => true,
        'system_translations' => true,
    ];

    /**
     * Casts for database-backed fields. MariaDB stores booleans as TINYINT,
     * so keep the DB cast as integer and expose a boolean accessor below.
     *
     * @var array<string, string>
     */
    protected array $_casts = [
        'is_active' => 'integer',
    ];

    /**
     * Accessor: always return boolean for `is_active` even when stored as TINYINT.
     *
     * @param mixed $value Raw value from the entity/properties
     * @return bool
     */
    protected function _getIsActive($value): bool
    {
        return (bool)$value;
    }
}
