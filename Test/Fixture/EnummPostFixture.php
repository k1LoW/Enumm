<?php
class EnummPostFixture extends CakeTestFixture {
    public $name = 'EnummPost';

    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'primary'),
        'category' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'title' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'body' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
        'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    );

    public $records = array(
        array(
            'id' => 1,
            'category' => 'daily',
            'title' => 'Title',
            'body' => 'Enumm Test',
            'created' => '2014-08-23 17:44:58',
            'modified' => '2014-08-23 12:05:02'
        ),
        array(
            'id' => 2,
            'category' => 'news',
            'title' => 'Title2',
            'body' => 'Enumm Test2',
            'created' => '2014-08-23 17:44:58',
            'modified' => '2014-08-23 12:05:02'
        ),
    );
}
