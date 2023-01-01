<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ass_cat}}`.
 */
class m220601_125855_create_ass_cat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ass_cat}}', [
            'id' => $this->primaryKey(),
            'cat_name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ass_cat}}');
    }
}
