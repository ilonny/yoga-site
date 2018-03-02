<?php
/**
 * Created date: 28.06.2016 14:35
 * @author yamilramilev <yamilramilev@gmail.com>
 */

namespace app\modules\edit\models;


use yii\bootstrap\ButtonDropdown;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\StringHelper;

class Field extends \app\models\Field
{

    /**
     * @return bool
     */
    private function fieldIsDate()
    {
        return ($this->edit_type_id !== null) && in_array($this->type->name, ['datetime', 'date', 'time']);
    }
    /**
     * @return int|string
     */
    public function getValidatorName()
    {
        if ($this->fieldIsDate()) {
            return 'string';
        }
        return in_array($this->php_type, ['string', 'double', 'integer']) ? $this->php_type : 'string';
    }


    /**
     * @return array
     */
    public function getValidatorOption()
    {
        if (($this->php_type == 'string') && ($this->data_type == 'string') && ($this->size !== null)) {
            return ['max' => $this->size];
        }
        return [];
    }

    /**
     * @param Table $table
     * @param DynamicModel $searchModel
     * @return array
     */
    public static function getColumns(Table $table, $searchModel)
    {
        $columns = [];
        /** @var Field[] $fields */
        $fields = Field::find()->where(['table_id' => $table->id, 'is_visible_in_list' => true, 'name' => \Yii::$app->dbFrontEnd->getTableSchema($table->name)->columnNames])->all();
        $galleries = $table->getGalleries();
        foreach ($fields as $field) {
            $format = $field->getFieldFormat();
            $label = $field->alias;
            $value = $field->name;
            switch ($format) {
                case 'text':
                    $columns[] = [
                        'attribute' => $value,
                        'label' => $label,
                        'format' => $format,
                        'value' => function ($data) use ($value) {
                            return StringHelper::truncate($data[$value], 200);
                        }
                    ];
                    break;
                case 'html':
                    $columns[] = [
                        'attribute' => $field->name,
                        'label' => $label,
                        'format' => $format,
                        'value' => function ($data) use ($value) {
                            return \Yii::$app->formatter->asHtml(StringHelper::truncate($data[$value], 200, '...', 'UTF-8', true));
                        }
                    ];
                    break;
                case 'image':
                    $columns[] = [
                        'label' => $label,
                        'format' => 'raw',
                        'value' => function($data) use ($value, $field) {
                            return Html::img($data[$value], Json::decode($field->showType->params));
                        },
                    ];
                    break;
                case 'relation':
                    $relation = Relation::findOne($field->relation_id);
                    if ($relation === null) {
                        $columns[] = "$value:$format:$label";
                    } else {
                        /** @var Relation $relation */
                        $columns[] = [
                            'attribute' => $value,
                            'label' => $label,
                            'format' => 'text',
                            'value' => function($data) use ($value, $field, $relation) {
                                return $relation->getValue($data[$value]);
                            },
                            'filter' => Html::activeDropDownList($searchModel, $value, $relation->getAllData(),['class'=>'form-control','prompt' => "Все"]),
                        ];
                    }
                    break;
                case 'boolean':
                    $columns[] = [
                        'attribute' => $value,
                        'label' => $label,
                        'format' => 'boolean',
                        'filter' => [1 =>'Да', 0 => 'Нет'],
                    ];
                    break;
                default:
                    $columns[] = "$value:$format:$label";
                    break;
            }
        }

        return ArrayHelper::merge($columns, [
            [
                'label' => '',
                'format' => 'raw',
                'value' => function ($data) use ($table, $galleries) {
                    $row_id = $data['id'];
                    return
                        Html::a('Редактировать', ['edit', 'id' => $row_id, 'table' => $table->id], ['class' => 'btn btn-info btn-xs']) .
                        (count($galleries) > 0
                            ? ButtonDropdown::widget([
                                'label' => 'Фотогалереи',
                                'options' => [
                                    'class' => 'btn-xs'
                                ],
                                'dropdown' => [
                                    'items' => ArrayHelper::getColumn($galleries, function ($data) use ($table, $row_id) {
                                        return [
                                            'label' => $data->name,
                                            'url' => ['upload-gallery', 'id' => $row_id, 'table' => $table->id, 'gallery' => $data->id]
                                        ];
                                    })
                                ]
                            ])
                            : ''
                        ) .
                    Html::a('Удалить', ['delete', 'id' => $row_id, 'table' => $table->id], ['class' => 'btn btn-danger btn-xs', 'data-confirm' => 'Действительно хотите удалить запись?']);
                }
            ],
        ]);
    }

    /**
     * @return string
     */
    public function getFieldFormat()
    {
        if ($this->show_type_id === null) {
            return 'text';
        }
        return $this->showType->format;
    }
}