<?php

namespace yii2mod\editable;

use Yii;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\web\BadRequestHttpException;

/**
 * Class EditableAction
 *
 * @package yii2mod\editable
 */
class EditableAction extends Action
{
    /**
     * @var string the class name to handle
     */
    public $modelClass;

    /**
     * @var string the scenario to be used (optional)
     */
    public $scenario = Model::SCENARIO_DEFAULT;

    /**
     * @var \Closure a function to be called previous saving model. The anonymous function is preferable to have the
     * model passed by reference. This is useful when we need to set model with extra data previous update
     */
    public $preProcess;

    /**
     * @var bool whether to create a model if a primary key parameter was not found
     */
    public $forceCreate = false;

    /**
     * @var string default pk column name
     */
    public $pkColumn = 'id';

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->modelClass === null) {
            throw new InvalidConfigException('The "modelClass" property must be set.');
        }
    }

    /**
     * Runs the action
     *
     * @return bool
     *
     * @throws BadRequestHttpException
     */
    public function run()
    {
        $model = $this->findModelOrCreate();
        $attribute = $this->getModelAttribute();
        $value = Yii::$app->request->post('value');

        if ($this->preProcess && is_callable($this->preProcess, true)) {
            call_user_func($this->preProcess, $model);
        }

        $model->setScenario($this->scenario);
        $model->$attribute = $value;

        if ($model->validate([$attribute])) {
            return $model->save(false);
        } else {
            throw new BadRequestHttpException($model->getFirstError($attribute));
        }
    }

    /**
     * @return array|mixed
     *
     * @throws BadRequestHttpException
     */
    private function getModelAttribute()
    {
        $attribute = Yii::$app->request->post('name');

        if ($attribute === null) {
            throw new BadRequestHttpException('Attribute cannot be empty.');
        }

        if (strpos($attribute, '.')) {
            $attributePath = explode('.', $attribute);

            return array_pop($attributePath);
        }

        return $attribute;
    }

    /**
     * @return yii\db\ActiveRecord
     *
     * @throws BadRequestHttpException
     */
    private function findModelOrCreate()
    {
        $pk = unserialize(base64_decode(Yii::$app->request->post('pk')));
        $class = $this->modelClass;
        $model = $class::findOne(is_array($pk) ? $pk : [$this->pkColumn => $pk]);

        if (!$model) {
            if ($this->forceCreate) {
                $model = new $class();
            } else {
                throw new BadRequestHttpException('Entity not found by primary key ' . $pk);
            }
        }

        $attribute = Yii::$app->request->post('name');

        if (strpos($attribute, '.')) {
            $attributePath = explode('.', $attribute);

            $related = $model[array_shift($attributePath)];

            while ((count($attributePath) > 1)) {
                $related = $model[array_shift($attributePath)];
            }

            return $related;
        }

        return $model;
    }
}
