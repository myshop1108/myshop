<?php

use yii\db\Migration;

/**
 * Handles the creation of table `articl`.
 */
class m180317_045342_create_articl_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('articl', [
            'id' => $this->primaryKey(),
            'title'=>$this->string()->notNull()->comment('标题'),
            'intro'=>$this->text()->comment('简介'),
            'sort'=>$this->smallInteger()->notNull()->defaultValue(100)->comment('排序'),
            'status'=>$this->smallInteger()->notNull()->defaultValue(100)->comment('状态'),
            'cate_id'=>$this->integer()->comment('分类ID'),
            'create_time'=>$this->integer()->comment('分类时间'),
            'update_time'=>$this->integer()->comment("更新时间")
        ]);
        //创建文章详情表
        $this->createTable('articl_content',[
            'id' => $this->primaryKey(),
            'detail'=>$this->text()->comment('内容'),
            'article_id'=>$this->integer()->comment('文章ID')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('articl');
    }
}
