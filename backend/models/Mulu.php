<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mulu".
 *
 * @property int $id
 * @property string $name
 * @property string $ico  图标
 * @property string $url
 * @property int $parent_id 父类ID
 */
class Mulu extends \yii\db\ActiveRecord
{

    public function rules()
    {
        return [
            [['parent_id'], 'required'],
            [['name', 'ico', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'ico' => ' 图标',
            'url' => 'Url',
            'parent_id' => '父类ID',
        ];
    }
    //声明一个静态方法
    public static function menu(){
//       $menu=[
//           [
//           'label' => '商品管理',
//           'icon' => 'share',
//           'url' => '#',
//           'items' => [
//               ['label' => '商品列表', 'icon' => 'file-code-o', 'url' => ['/goods/index'],],
//               ['label' => '添加商品', 'icon' => 'dashboard', 'url' => ['/goods/add'],],
//           ],
//       ],
//        ];
       //得到所有一级目录


       $menus=self::find()->where(['parent_id'=>0])->all();
        $menuAll=[];
       foreach ($menus as $menu){
           $newmenu=[];
           $newmenu['label']=$menu->name;
           $newmenu['icon']=$menu->ico;
           $newmenu['url']=$menu->url;

           //通过一级菜单找到二级菜单

           $menusSon=self::find()->where(['parent_id'=>$menu->id])->all();
           foreach ($menusSon as $menuSon){
               //用来存二级菜单
                $newMenuSon=[];
               //分别赋值
               $newMenuSon['label']=$menuSon->name;
               $newMenuSon['icon']=$menuSon->ico;
               $newMenuSon['url']=$menuSon->url;
               //扔到一级菜单下面去
               $newmenu['items'][]=$newMenuSon;
//               var_dump($newmenu);exit;
           }
           //最后的菜单
       $menuAll[]=$newmenu;

       }

       return $menuAll;
    }
}
