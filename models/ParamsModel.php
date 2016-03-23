<?php

namespace fgh151\modules\params\models;

use fgh151\modules\params\Module;
use yii\helpers\VarDumper;

class ParamsModel extends \yii\base\Model{
    
    private $_attributes=[];
    public $paramsFilePathAlias;

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init() {
        if(!isset($this->paramsFilePath))
        {
            throw new \yii\base\InvalidConfigException(Module::t('system','$paramsFilePathAlias variable must be set when creating the object'));
        }
        $this->loadFromFile();
        return parent::init();
    }

    /**
     * @return array
     */
    public function attributes() {
        $attributes = [];
        foreach ($this->_attributes as $name => $value) {
            if(is_string($value))
            {
                $attributes[]=$name;
            }
        }
        return $attributes;
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

    protected function loadFromFile()
    {
        $this->_attributes = require $this->paramsFilePath;
    }

    protected function saveToFile()
    {
        file_put_contents($this->paramsFilePath,  "<?php\nreturn " . VarDumper::export($this->_attributes). ";\n",LOCK_EX);
    }

    /**
     * @param string $name
     * @return mixed
     * @throws \yii\base\UnknownPropertyException
     */
    public function __get($name) {
        if(key_exists($name, $this->_attributes))
        {
            $result = $this->_attributes[$name];
        }
            else{
                $result=parent::__get($name);
            }
        return $result;
    }

    /**
     * @param array $values
     * @param bool|false $safeOnly
     */
    public function setAttributes($values, $safeOnly = false) {
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
}
