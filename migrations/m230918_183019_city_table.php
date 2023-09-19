<?php

use yii\db\Migration;

/**
 * Class m230918_183019_city_table
 */
class m230918_183019_city_table extends Migration
{

    const TABLE_NAME = 'city';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = [
            'id' => 'INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'name' => 'VARCHAR(32) NOT NULL',
            'code' => 'INT(11) NOT NULL',
            'suffix' => 'VARCHAR(16) NOT NULL',
        ];
        $this->createTable(self::TABLE_NAME, $columns);
        $this->insert(self::TABLE_NAME, ['name' => 'Москва', 'code' => 0, 'suffix' => 'moscow']);
        $this->insert(self::TABLE_NAME, ['name' => 'Санкт-Петербург', 'code' => 1, 'suffix' => 'piter']);
        $this->insert(self::TABLE_NAME, ['name' => 'Самара', 'code' => 2, 'suffix' => 'samara']);
        $this->insert(self::TABLE_NAME, ['name' => 'Саратов', 'code' => 3, 'suffix' => 'saratov']);
        $this->insert(self::TABLE_NAME, ['name' => 'Казань', 'code' => 4, 'suffix' => 'kazan']);
        $this->insert(self::TABLE_NAME, ['name' => 'Новосибирск', 'code' => 5, 'suffix' => 'novosib']);
        $this->insert(self::TABLE_NAME, ['name' => 'Челябинск', 'code' => 6, 'suffix' => 'chelaba']);
        $this->insert(self::TABLE_NAME, ['name' => 'Деловые линии Челябинск', 'code' => 7, 'suffix' => 'lines']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
