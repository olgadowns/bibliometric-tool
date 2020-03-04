<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaperDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaperDetailsTable Test Case
 */
class PaperDetailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PaperDetailsTable
     */
    protected $PaperDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.PaperDetails',
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
        $config = TableRegistry::getTableLocator()->exists('PaperDetails') ? [] : ['className' => PaperDetailsTable::class];
        $this->PaperDetails = TableRegistry::getTableLocator()->get('PaperDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->PaperDetails);

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
