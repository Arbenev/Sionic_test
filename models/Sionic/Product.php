<?php

namespace app\models\Sionic;

/**
 * @property int $id Primary
 * @property int $code Product code
 * @property string $name Product name
 * @property float $weight Product weight
 * @property string $usage Usages
 */
class Product extends \yii\db\ActiveRecord
{

    public function rules()
    {
        $rules = [
            [['id', 'code'], 'integer'],
            [['name', 'usage'], 'string'],
            ['weight', 'double'],
            [['quantity_moscow', 'price_moscow', 'quantity_piter', 'price_piter', 'quantity_samara', 'price_samara', 'quantity_saratov', 'price_saratov', 'quantity_kazan', 'price_kazan', 'quantity_novosib', 'price_novosib', 'quantity_chelaba', 'price_chelaba', 'quantity_lines', 'price_lines',], 'integer'],
        ];
        // Замена последнего правила. Правильно, но не эффективно
//        $cities = City::find()->asArray()->all();
//        foreach ($cities as $city) {
//            $rules[] = ['quantity_' . $city['suffix'], 'integer'];
//            $rules[] = ['price_' . $city['suffix'], 'integer'];
//        }

        return $rules;
    }

    public static function saveProduct($info)
    {
        if (!isset($info['code'])) {
            throw new \yii\base\Exception('No code for a product');
        }
        $code = $info['code'];
//        $db = self::getDb();
//        $fields = [];
//        $values = [];
//        $updates = [];
//        foreach ($info as $field => $value) {
//            $fields[] = '`' . $field . '`';
//            $values[] = '"' . addslashes($value) . '"';
//            $updates[] = '`' . $field . '`="' . addslashes($value) . '"';
//        }
//        $sql = 'INSERT INTO ' . self::tableName() . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $values) . ') ON DUPLICATE KEY UPDATE ' . implode(',', $updates);
//        $db->createCommand($sql)
//                ->execute()
//                ;
//
//
//        $product = $db->createCommand('SELECT * FROM ' . self::tableName() . ' WHERE `code`=' . $code)
//                ->queryOne()
//        ;
//        unset($product);
//        print_r($product);
//
//        $product = self::findByCondition(['code' => $code])->asArray()->one();
//        if (!$product) {
//            self::getDb()->createCommand()->insert(self::tableName(), $info);
//        }else{
//            self::getDb()->createCommand()->update(self::tableName(), $info);
//        }
        $product = self::findOne(['code' => $code]);
        if (!$product) {
            $product = new self();
        }
        $product->setAttributes($info);
        $product->save();
    }
}
