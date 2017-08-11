<?php

namespace fgh151\modules\params\models;

use fgh151\modules\params\Module;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\helpers\VarDumper;
use yii\validators\Validator;

/**
 * Class ParamsModel
 * @package fgh151\modules\params\models
 *
 * @param string $paramsFilePath ;
 */
class ParamsModel extends Model
{

    public $paramsFilePathAlias;
    private $_attributes = [];

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        if (!isset($this->paramsFilePath)) {
            throw new InvalidConfigException(Module::t('app', '$paramsFilePathAlias variable must be set when creating the object'));
        }
        $this->loadFromFile();
        return parent::init();
    }

    protected function loadFromFile()
    {
        $this->_attributes = require $this->paramsFilePath;
    }

    /**
     * @return bool|string
     */
    public function getParamsFilePath()
    {
        return \Yii::getAlias($this->paramsFilePathAlias);
    }


    public function save()
    {
        $this->saveToFile();
    }

    protected function saveToFile()
    {
        file_put_contents($this->paramsFilePath, "<?php\nreturn " . VarDumper::export($this->_attributes) . ";\n", LOCK_EX);
    }

    /**
     * @param string $name
     * @return mixed
     * @throws \yii\base\UnknownPropertyException
     */
    public function __get($name)
    {
        if (key_exists($name, $this->_attributes)) {
            $result = $this->_attributes[$name];
        } else {
            $result = parent::__get($name);
        }
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function __set($name, $value)
    {
        $this->_attributes[$name] = $value;
    }

    /**
     * @param array $values
     * @param bool|false $safeOnly
     */
    public function setAttributes($values, $safeOnly = false)
    {
        if (is_array($values)) {
            $attributes = array_flip($safeOnly ? $this->safeAttributes() : $this->attributes());
            foreach ($values as $name => $value) {
                if (isset($attributes[$name])) {
                    $this->_attributes[$name] = $value;
                } elseif ($safeOnly) {
                    $this->onUnsafeAttribute($name, $value);
                }
            }
        }
    }

    /**
     * @return array
     */
    public function attributes()
    {
        $attributes = [];
        foreach ($this->_attributes as $name => $value) {
            if (is_string($value)) {
                $attributes[] = $name;
            }
        }
        return $attributes;
    }

    /**
     * Adds a validation rule to this model.
     * You can also directly manipulate [[validators]] to add or remove validation rules.
     * This method provides a shortcut.
     * @param string|array $attributes the attribute(s) to be validated by the rule
     * @param mixed $validator the validator for the rule.This can be a built-in validator name,
     * a method name of the model class, an anonymous function, or a validator class name.
     * @param array $options the options (name-value pairs) to be applied to the validator
     * @return $this the model itself
     */
    public function addRule($attributes, $validator, $options = [])
    {
        $validators = $this->getValidators();
        $validators->append(Validator::createValidator($validator, $this, (array)$attributes, $options));

        return $this;
    }

    /**
     * @param $key
     */
    public function deleteKey($key)
    {
        unset($this->_attributes[$key]);
    }
}
