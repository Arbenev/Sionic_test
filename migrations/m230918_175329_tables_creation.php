<?php

use yii\db\Migration;

/**
 * Class m230918_175329_tables_creation
 */
class m230918_175329_tables_creation extends Migration
{

    const TABLE_NAME = 'product';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = [
            'id' => 'INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'name' => 'VARCHAR(250) NOT NULL',
            'code' => 'INT(11) NOT NULL',
            'weight' => 'FLOAT NOT NULL DEFAULT 0',
            'usage' => 'TEXT NOT NULL DEFAULT \'\'',
        ];
        $this->createTable(self::TABLE_NAME, $columns);
        $this->createIndex('UN_product_code', self::TABLE_NAME, 'code', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
