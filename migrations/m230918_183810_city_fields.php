<?php

use yii\db\Migration;

/**
 * Class m230918_183810_city_fields
 */
class m230918_183810_city_fields extends Migration
{

    const PRODUCT_TABLE_NAME = 'product';
    const CITY_TABLE_NAME = 'city';
    const QUANTITY_PREFIX = 'quantity_';
    const PRICE_PREFIX = 'price_';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'SELECT * FROM ' . self::CITY_TABLE_NAME . ' ORDER BY id';
        $connection = $this->getDb();
        $cities = $connection->createCommand($sql)->queryAll();
        foreach ($cities as $city) {
            $quantityName = self::QUANTITY_PREFIX . $city['suffix'];
            $priceName = self::PRICE_PREFIX . $city['suffix'];
            $this->addColumn(self::PRODUCT_TABLE_NAME, $quantityName, 'INT(11) NOT NULL DEFAULT 0');
            $this->addColumn(self::PRODUCT_TABLE_NAME, $priceName, 'INT(11) NOT NULL DEFAULT 0');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = 'SELECT * FROM ' . self::CITY_TABLE_NAME . ' ORDER BY id';
        $connection = $this->getDb();
        $cities = $connection->createCommand($sql)->queryAll();
        foreach ($cities as $city) {
            $quantityName = self::QUANTITY_PREFIX . $city['suffix'];
            $priceName = self::PRICE_PREFIX . $city['suffix'];
            $this->dropColumn(self::PRODUCT_TABLE_NAME, $quantityName);
            $this->dropColumn(self::PRODUCT_TABLE_NAME, $priceName);
        }
    }
}
