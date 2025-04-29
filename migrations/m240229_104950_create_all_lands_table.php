<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%all_lands}}`.
 */
class m240229_104950_create_all_lands_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%all_lands}}', [
            'id' => $this->primaryKey(),
            'street_and_num'=>$this->string(),
            'name_owner'=>$this->string(),
            'email'=>$this->string()->defaultValue(null),
            'debt_str'=>$this->string(),
            'debt_int'=>$this->integer()->defaultValue(0),
            'tel'=>$this->integer()->defaultValue(0),
            'photo'=>$this->string()->defaultValue(null),
            'date'=>$this->integer()->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%all_lands}}');
    }
}
