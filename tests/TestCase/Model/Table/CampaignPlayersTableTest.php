<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CampaignPlayersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CampaignPlayersTable Test Case
 */
class CampaignPlayersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CampaignPlayersTable
     */
    protected $CampaignPlayers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.CampaignPlayers',
        'app.Campaigns',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CampaignPlayers') ? [] : ['className' => CampaignPlayersTable::class];
        $this->CampaignPlayers = $this->getTableLocator()->get('CampaignPlayers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CampaignPlayers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\CampaignPlayersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\CampaignPlayersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
