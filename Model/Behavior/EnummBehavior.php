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
            if (!is_array($values)) {
                $values = Configure::read($values);
            }
            $model->validate[$fieldName]['inListEnumValidate'] = array(
                'rule' => array('inList', array_keys($values)),
                'allowEmpty' => true,
                'last' => true,
            );
        }
    }
}
