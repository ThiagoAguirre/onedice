<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SystemTranslation Entity
 *
 * @property int $id
 * @property int $system_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 *
 * @property \App\Model\Entity\System $system
 */
class SystemTranslation extends Entity
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
        'system_id' => true,
        'locale' => true,
        'name' => true,
        'description' => true,
        'system' => true,
    ];
}
