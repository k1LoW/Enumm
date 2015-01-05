<?php
/**
 * EnummComponent
 *
 */
class EnummComponent extends Component {

    /**
     * __construct
     *
     * @param ComponentCollection $collection instance for the ComponentCollection
     * @param array $settings Settings to set to the component
     * @return void
     */
    public function __construct(ComponentCollection $collection, $settings = array()) {
        $this->controller = $collection->getController();
        parent::__construct($collection, $settings);
    }

    /**
     * initialize
     *
     * @param $controller
     * @return
     */
    public function initialize(Controller $controller) {
        $this->setEnums();
    }

    /**
     * setEnums
     *
     */
    public function setEnums(){
        if (empty($this->controller->modelClass) || empty($this->controller->uses)) {
            return;
        }
        $model = ClassRegistry::init($this->controller->modelClass);
        if (empty($model->enums)) {
            return;
        }
        foreach ($model->enums as $fieldName => $values) {
            if (!is_array($values)) {
                $values = Configure::read($values);
            }

            $varName = Inflector::variable(
                Inflector::pluralize(preg_replace('/_id$/', '', $fieldName))
            );
            $this->controller->set($varName, $values);
        }
    }

}
