<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SystemsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SystemsTable Test Case
 */
class SystemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SystemsTable
     */
    protected $Systems;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Systems',
        'app.MasterCampaigns',
        'app.SystemTranslations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Systems') ? [] : ['className' => SystemsTable::class];
        $this->Systems = $this->getTableLocator()->get('Systems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Systems);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\SystemsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\SystemsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
