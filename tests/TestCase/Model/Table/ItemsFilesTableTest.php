<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemsFilesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemsFilesTable Test Case
 */
class ItemsFilesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemsFilesTable
     */
    public $ItemsFiles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.items_files',
        'app.items',
        'app.files'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ItemsFiles') ? [] : ['className' => ItemsFilesTable::class];
        $this->ItemsFiles = TableRegistry::getTableLocator()->get('ItemsFiles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemsFiles);

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
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
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
