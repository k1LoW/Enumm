<?php
/**
 * EnummBehavior
 *
 */
class EnummBehavior extends ModelBehavior {

    /**
     * beforeValidate
     *
     */
    public function beforeValidate(Model $model, $options = array()){
        if (empty($model->enums)) {
            return true;
        }
        foreach ($model->enums as $fieldName => $values) {
            $values = $this->getEnum($model, $fieldName);
            if (empty($model->validate[$fieldName])) {
                $model->validate[$fieldName] = array();
            }

            // for Cakeplus
            $validateRules = $model->validate[$fieldName];
            if (isset($validateRules) && !is_array($validateRules)){
                $model->validate[$fieldName] = array($validateRules);
            }

            $model->validate[$fieldName]['inListEnumValidate'] = array(
                'rule' => array('inList', array_keys($values)),
                'allowEmpty' => true,
                'last' => true,
            );
        }
    }

    /**
     * getEnum
     *
     */
    public function getEnum(Model $model, $fieldName){
        $values = $model->enums[$fieldName];
        if (!is_array($values)) {
            $values = Configure::read($values);
        }
        return $values;
    }
}
