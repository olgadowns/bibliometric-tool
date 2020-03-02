<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PapersKeywordsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PapersKeywordsTable Test Case
 */
class PapersKeywordsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PapersKeywordsTable
     */
    protected $PapersKeywords;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.PapersKeywords',
        'app.Papers',
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
        $config = TableRegistry::getTableLocator()->exists('PapersKeywords') ? [] : ['className' => PapersKeywordsTable::class];
        $this->PapersKeywords = TableRegistry::getTableLocator()->get('PapersKeywords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->PapersKeywords);

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
