<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QueriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QueriesTable Test Case
 */
class QueriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\QueriesTable
     */
    protected $Queries;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Queries',
        'app.Papers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Queries') ? [] : ['className' => QueriesTable::class];
        $this->Queries = TableRegistry::getTableLocator()->get('Queries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Queries);

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
}
