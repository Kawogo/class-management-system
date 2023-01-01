<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%assignment}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m220601_125730_create_assignment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%assignment}}', [
            'id' => $this->primaryKey(),
            'student_id' => $this->integer(11)->notNull(),
            'teacher_id' => $this->integer(11)->notNull(),
            'assignment' => $this->string(255)->notNull(),
            'tittle' => $this->string(255),
        ]);

        // creates index for column `student_id`
        $this->createIndex(
            '{{%idx-assignment-student_id}}',
            '{{%assignment}}',
            'student_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-assignment-student_id}}',
            '{{%assignment}}',
            'student_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `teacher_id`
        $this->createIndex(
            '{{%idx-assignment-teacher_id}}',
            '{{%assignment}}',
            'teacher_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-assignment-teacher_id}}',
            '{{%assignment}}',
            'teacher_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-assignment-student_id}}',
            '{{%assignment}}'
        );

        // drops index for column `student_id`
        $this->dropIndex(
            '{{%idx-assignment-student_id}}',
            '{{%assignment}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-assignment-teacher_id}}',
            '{{%assignment}}'
        );

        // drops index for column `teacher_id`
        $this->dropIndex(
            '{{%idx-assignment-teacher_id}}',
            '{{%assignment}}'
        );

        $this->dropTable('{{%assignment}}');
    }
}
