<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PapersQueriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PapersQueriesTable Test Case
 */
class PapersQueriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PapersQueriesTable
     */
    protected $PapersQueries;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.PapersQueries',
        'app.Papers',
        'app.Queries',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PapersQueries') ? [] : ['className' => PapersQueriesTable::class];
        $this->PapersQueries = TableRegistry::getTableLocator()->get('PapersQueries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->PapersQueries);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
