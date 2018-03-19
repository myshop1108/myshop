<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m180319_070147_create_goods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('goods', [
                'id' => $this->primaryKey(),
                'name'=>$this->string()->notNull()->comment('商品名称'),
                'sn'=>$this->char(15)->comment('货号'),
                'logo'=>$this->string()->comment('图像'),
                'goods_category_id'=>$this->integer()->notNull()->comment("商品分类"),
            'brand_id'=>$this->smallInteger()->comment('品牌'),
            'market_price'=>$this->decimal()->comment('市场价格'),
            'shop_price'=>$this->decimal()->comment('本店价格'),
            'stock'=>$this->integer()->comment('库存'),
           'status'=>$this->integer()->notNull()->defaultValue(1)->comment('状态
'),
            'sort'=>$this->integer()->notNull()->defaultValue(100)->comment('排
序'),
            'inputtime'=>$this->integer()->comment('录入时间'),
        ]);
        //创建商品详情表
        $this->createTable('goods_intro',[
            'id' => $this->primaryKey(),
            'goods_id'=>$this->integer()->comment('商品ID'),
            'content'=>$this->text()->comment('商品内容')
        ]);
        //商品地址表
        $this->createTable('goods_gallery',[
            'id' => $this->primaryKey(),
            'goods_id'=>$this->integer()->comment('商品ID'),
            'path'=>$this->string()->comment('商品图片地址')
        ]);
        //创建了多少商品表
        $this->createTable('goods_day_count',[
            'id' => $this->primaryKey(),
            'day'=>$this->integer()->comment('日期'),
            'count'=>$this->integer()->comment('商品内容')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('goods');
    }
}
