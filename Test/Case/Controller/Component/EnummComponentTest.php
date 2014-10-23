<?php
App::uses('Controller', 'Controller');
App::uses('EnummComponent', 'Enumm.Controller/Component');

/**
 * EnummPost
 *
 */
class EnummPost extends CakeTestModel{

    public $name = 'EnummPost';

}

/**
 * EnummPostsController
 *
 */
class EnummPostsController extends Controller{

    public $name = 'EnummPosts';

    public $components = array(
        'Enumm.Enumm',
    );

}

/**
 * EnummComponentTest
 *
 */
class EnummComponentTest extends CakeTestCase{

    public $fixtures = array(
        'plugin.enumm.enumm_post'
    );

    public function setUp() {
        parent::setUp();
        $this->Controller = new EnummPostsController();
        $collection = new ComponentCollection();
        $collection->init($this->Controller);
    }

    public function tearDown() {
        unset($this->Controller);
        ClassRegistry::flush();
    }

    /**
     * testSetEnums
     *
     */
    public function testSetEnums(){
        $this->Controller->EnummPost->enums = array(
            'category' => array(
                'daily' => 'Daily',
                'news' => 'News',
            ),
        );
        $this->Controller->Enumm->initialize($this->Controller);
        $this->assertTrue(array_key_exists('categories', $this->Controller->viewVars));
    }

    /**
     * testSetEnumsWithConfigure
     *
     */
    public function testSetEnumsWithConfigure(){
        Configure::write('Enumm.cateogries', array(
            'daily' => 'Daily',
            'news' => 'News',
        ));
        $this->Controller->EnummPost->enums = array(
            'category' => 'Enumm.cateogries',
        );
        $this->Controller->Enumm->initialize($this->Controller);
        $this->assertTrue(array_key_exists('categories', $this->Controller->viewVars));
    }

}
