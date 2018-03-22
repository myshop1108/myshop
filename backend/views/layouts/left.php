<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>源码商城后台</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

<!--        <!-- search form -->-->
<!--        <form action="#" method="get" class="sidebar-form">-->
<!--            <div class="input-group">-->
<!--                <input type="text" name="q" class="form-control" placeholder="Search..."/>-->
<!--              <span class="input-group-btn">-->
<!--                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>-->
<!--                </button>-->
<!--              </span>-->
<!--            </div>-->
<!--        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
//                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
//                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
//                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    [
                        'label' => '商品管理',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '商品列表', 'icon' => 'file-code-o', 'url' => ['/goods/index'],],
                            ['label' => '添加商品', 'icon' => 'dashboard', 'url' => ['/goods/add'],],
                        ],
                    ],
                    [
                        'label' => '商品分类管理',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '分类管理列表', 'icon' => 'file-code-o', 'url' => ['/categorry/index'],],
                            ['label' => '添加分类', 'icon' => 'dashboard', 'url' => ['/categorry/add'],],
                        ],
                    ],
                    [
                        'label' => '文章分类管理',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '文章管理列表', 'icon' => 'file-code-o', 'url' => ['/category/index'],],
                            ['label' => '添加文章分类', 'icon' => 'dashboard', 'url' => ['/category/add'],],
                        ],
                    ],
                    [
                        'label' => '文章管理',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '文章列表', 'icon' => 'file-code-o', 'url' => ['/articl/index'],],
                            ['label' => '添加文章', 'icon' => 'dashboard', 'url' => ['/articl/add'],],
                        ],
                    ],
                    [
                        'label' => '品牌管理',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '品牌列表', 'icon' => 'file-code-o', 'url' => ['/brand/index'],],
                            ['label' => '添加品牌', 'icon' => 'dashboard', 'url' => ['/brand/add'],],
                        ],
                    ],
                    [
                        'label' => '管理员列表',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '管理员列表', 'icon' => 'file-code-o', 'url' => ['/admin/index'],],
                            ['label' => '管理员注册', 'icon' => 'dashboard', 'url' => ['/admin/add'],],

                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
