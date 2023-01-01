<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attendance}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 * - `{{%tasks}}`
 */
class m220601_130953_create_attendance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%attendance}}', [
            'id' => $this->primaryKey(),
            'student_id' => $this->integer(11)->notNull(),
            'teacher_id' => $this->integer(11)->notNull(),
            'status' => $this->boolean()->notNull(),
            'task_id' => $this->integer(11)->notNull(),
        ]);

        // creates index for column `student_id`
        $this->createIndex(
            '{{%idx-attendance-student_id}}',
            '{{%attendance}}',
            'student_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-attendance-student_id}}',
            '{{%attendance}}',
            'student_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `teacher_id`
        $this->createIndex(
            '{{%idx-attendance-teacher_id}}',
            '{{%attendance}}',
            'teacher_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-attendance-teacher_id}}',
            '{{%attendance}}',
            'teacher_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `task_id`
        $this->createIndex(
            '{{%idx-attendance-task_id}}',
            '{{%attendance}}',
            'task_id'
        );

        // add foreign key for table `{{%tasks}}`
        $this->addForeignKey(
            '{{%fk-attendance-task_id}}',
            '{{%attendance}}',
            'task_id',
            '{{%tasks}}',
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
            '{{%fk-attendance-student_id}}',
            '{{%attendance}}'
        );

        // drops index for column `student_id`
        $this->dropIndex(
            '{{%idx-attendance-student_id}}',
            '{{%attendance}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-attendance-teacher_id}}',
            '{{%attendance}}'
        );

        // drops index for column `teacher_id`
        $this->dropIndex(
            '{{%idx-attendance-teacher_id}}',
            '{{%attendance}}'
        );

        // drops foreign key for table `{{%tasks}}`
        $this->dropForeignKey(
            '{{%fk-attendance-task_id}}',
            '{{%attendance}}'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            '{{%idx-attendance-task_id}}',
            '{{%attendance}}'
        );

        $this->dropTable('{{%attendance}}');
    }
}
