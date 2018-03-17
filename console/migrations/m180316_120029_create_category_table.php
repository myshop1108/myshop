<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m180316_120029_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull()->comment('名称'),
            'intro'=>$this->text()->comment('简介'),
            'status'=>$this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
            'sort'=>$this->integer()->notNull()->defaultValue(100)->comment('排序'),
            'is_help'=>$this->smallInteger()->notNull()->defaultValue(1)->comment('是不是帮助类')

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category');
    }
}
