<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SystemTranslationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SystemTranslationsTable Test Case
 */
class SystemTranslationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SystemTranslationsTable
     */
    protected $SystemTranslations;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.SystemTranslations',
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
        $config = $this->getTableLocator()->exists('SystemTranslations') ? [] : ['className' => SystemTranslationsTable::class];
        $this->SystemTranslations = $this->getTableLocator()->get('SystemTranslations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->SystemTranslations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\SystemTranslationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\SystemTranslationsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
