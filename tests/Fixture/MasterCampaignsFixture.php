<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MasterCampaignsFixture
 */
class MasterCampaignsFixture extends TestFixture
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
                'master_user_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'cover_image' => 'Lorem ipsum dolor sit amet',
                'is_public' => 1,
                'max_players' => 1,
                'start_date' => '2026-01-15',
                'invite_code' => 'Lorem ipsum dolor ',
                'status' => 'Lorem ipsum dolor ',
                'created' => 1768440506,
                'modified' => 1768440506,
                'system_id' => 1,
            ],
        ];
        parent::init();
    }
}
