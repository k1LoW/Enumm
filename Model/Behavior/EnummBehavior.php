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
}
