<?php

namespace app\models\Sionic;

/**
 * @property int $id Primary
 * @property string $name City name
 * @property int $code City code
 * @property string $suffix Suffix for field name
 */
class City extends \yii\db\ActiveRecord
{

    public function rules()
    {
        return [
            [['id', 'code',], 'integer'],
            [['name', 'suffix'], 'string'],
        ];
    }
}
