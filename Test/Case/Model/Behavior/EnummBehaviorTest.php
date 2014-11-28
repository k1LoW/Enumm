<?php
App::uses('Model', 'Model');
App::uses('AppModel', 'Model');

class EnummPost extends CakeTestModel{

    public $name = 'EnummPost';

    public $actsAs = array('Enumm.Enumm');

    public $enums = array(
        'category' => array(
            'dairy' => 'My Diary',
            'news' => 'News Topic',
        ),
    );
}

class EnummTestCase extends CakeTestCase{

    public $fixtures = array(
        'plugin.enumm.enumm_post'
    );

    public function setUp() {
        $this->EnummPost = new EnummPost();
    }

    public function tearDown() {
        unset($this->EnummPost);
    }

    /**
     * testEnumInListValidate
     *
     * jpn: EnummPost::enumsをみて自動でinList Validationを設定する
     */
    public function testEnumInListValidate(){
        $data = array(
            'EnummPost' => array(
                'category' => 'invalid',
                'title' => 'Title',
                'body' => 'Enumm Test',
            ),
        );
        $result = $this->EnummPost->save($data);
        $this->assertFalse($result);

        $this->assertTrue(array_key_exists('category', $this->EnummPost->validationErrors));
    }

    /**
     * testEnumInListValidateAllowEmpty
     *
     * jpn: allowEmpty = true
     */
    public function testEnumInListValidateAllowEmpty(){
        $data = array(
            'EnummPost' => array(
                'category' => '',
                'title' => 'Title',
                'body' => 'Enumm Test',
            ),
        );
        $result = $this->EnummPost->save($data);
        $this->assertTrue(is_array($result));
    }

}
