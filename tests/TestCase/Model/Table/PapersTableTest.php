<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PapersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PapersTable Test Case
 */
class PapersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PapersTable
     */
    protected $Papers;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Papers',
        'app.ContentTypes',
        'app.PapersQueries',
        'app.Keywords',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Papers') ? [] : ['className' => PapersTable::class];
        $this->Papers = TableRegistry::getTableLocator()->get('Papers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Papers);

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
