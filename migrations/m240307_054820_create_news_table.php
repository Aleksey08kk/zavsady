<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m240307_054820_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
            'title'=>$this->string(),
            'content'=>$this->string(),
            'photo'=>$this->string()->defaultValue(null),
            'author'=>$this->string(),
            'like'=>$this->integer()->defaultValue(0),
            'views'=>$this->integer()->defaultValue(0),
            'date'=>$this->integer()->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%news}}');
    }
}
