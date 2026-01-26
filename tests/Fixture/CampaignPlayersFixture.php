<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CampaignPlayersFixture
 */
class CampaignPlayersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'campaign_id' => 1,
                'user_id' => 1,
                'status' => 'Lorem ipsum dolor ',
                'invited_at' => 1769226369,
                'responded_at' => 1769226369,
                'created' => 1769226369,
                'modified' => 1769226369,
            ],
        ];
        parent::init();
    }
}
