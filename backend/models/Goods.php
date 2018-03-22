<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "goods".
 *
 * @property int $id
 * @property string $name 商品名称
 * @property string $sn 货号
 * @property string $logo 图像
 * @property int $goods_category_id 商品分类
 * @property int $brand_id 品牌
 * @property string $market_price 市场价格
 * @property string $shop_price 本店价格
 * @property int $stock 库存
 * @property int $status 状态 
 * @property int $sort 排 序
 * @property int $inputtime 录入时间
 *  @property int $images 录入时间
 */
class Goods extends \yii\db\ActiveRecord
{
    public $images;
    public static $get=[1=>'禁用',2=>'激活'];
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['inputtime'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }
    public function rules()
    {
        return [
            [['name', 'goods_category_id','goods_category_id', 'brand_id', 'stock', 'status', 'sort','logo','images'], 'required'],
            [['market_price','shop_price'],'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'sn' => '货号',
            'logo' => '图像',
            'goods_category_id' => '商品分类',
            'brand_id' => '品牌',
            'market_price' => '市场价格',
            'shop_price' => '本店价格',
            'stock' => '库存',
            'status' => '状态
',
            'sort' => '排
序',
            'inputtime' => '录入时间',
        ];
    }
}
