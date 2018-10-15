<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemsTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemsTagsTable Test Case
 */
class ItemsTagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemsTagsTable
     */
    public $ItemsTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.items_tags',
        'app.items',
        'app.tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ItemsTags') ? [] : ['className' => ItemsTagsTable::class];
        $this->ItemsTags = TableRegistry::getTableLocator()->get('ItemsTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemsTags);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
