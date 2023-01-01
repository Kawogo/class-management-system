<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%assignment}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%ass_cat}}`
 */
class m220601_131208_add_ass_cat_column_to_assignment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%assignment}}', 'ass_cat', $this->integer(11)->notNull());

        // creates index for column `ass_cat`
        $this->createIndex(
            '{{%idx-assignment-ass_cat}}',
            '{{%assignment}}',
            'ass_cat'
        );

        // add foreign key for table `{{%ass_cat}}`
        $this->addForeignKey(
            '{{%fk-assignment-ass_cat}}',
            '{{%assignment}}',
            'ass_cat',
            '{{%ass_cat}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%ass_cat}}`
        $this->dropForeignKey(
            '{{%fk-assignment-ass_cat}}',
            '{{%assignment}}'
        );

        // drops index for column `ass_cat`
        $this->dropIndex(
            '{{%idx-assignment-ass_cat}}',
            '{{%assignment}}'
        );

        $this->dropColumn('{{%assignment}}', 'ass_cat');
    }
}
