<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MasterCampaignsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MasterCampaignsTable Test Case
 */
class MasterCampaignsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MasterCampaignsTable
     */
    protected $MasterCampaigns;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.MasterCampaigns',
        'app.MasterUsers',
        'app.Systems',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MasterCampaigns') ? [] : ['className' => MasterCampaignsTable::class];
        $this->MasterCampaigns = $this->getTableLocator()->get('MasterCampaigns', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MasterCampaigns);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\MasterCampaignsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\MasterCampaignsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
