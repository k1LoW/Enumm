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
                'dairy' => 'My Diary',
                'news' => 'News Topic',
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
            'dairy' => 'My Diary',
            'news' => 'News Topic',
        ));
        $this->Controller->EnummPost->enums = array(
            'category' => 'Enumm.cateogries',
        );
        $this->Controller->Enumm->initialize($this->Controller);
        $this->assertTrue(array_key_exists('categories', $this->Controller->viewVars));
    }

    /**
     * testUnderscoreFieldEnum
     *
     */
    public function testUnderscoreFieldEnum(){
        $this->Controller->EnummPost->enums = array(
            'programing_language' => array(
                'php' => 'PHP',
                'js' => 'JavaScript',
            ),
        );
        $this->Controller->Enumm->initialize($this->Controller);
        $this->assertTrue(array_key_exists('programingLanguages', $this->Controller->viewVars));
    }

}
