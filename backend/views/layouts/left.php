<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
            	<!--
                <img src="<//?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                -->
                <img src="library.png" class="img-circle" alt="User Image"/>
                
            </div>
            <div class="pull-left info">
                <p>
                <?php
                    $user = common\models\User::findOne(['id' => Yii::$app->user->id]);
                    if(!empty($user))
                        echo $user->username;
                    else
                        echo "N/A";
                ?>
                </p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> -->

        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => '主菜单', 'options' => ['class' => 'header']],

                    //['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    //['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    //['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

                    // 新增菜单条目，测试用
                    [
                        'label' => '临时入口',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '用户管理', 'icon' => 'file-code-o', 'url' => ['/user1']],
                            ['label' => '图书馆配置', 'icon' => 'file-code-o', 'url' => ['/library']],
                            ['label' => '读者管理', 'icon' => 'file-code-o', 'url' => ['/reader']],
                            ['label' => '欠费缴纳管理', 'icon' => 'file-code-o', 'url' => ['/payment-of-debt']],
                            ['label' => '图书管理', 'icon' => 'file-code-o', 'url' => ['/book']],
                            ['label' => '图书副本管理', 'icon' => 'file-code-o', 'url' => ['/book-copy']],
                            ['label' => '馆藏地管理', 'icon' => 'file-code-o', 'url' => ['/collection-place']],
                            ['label' => '书商管理', 'icon' => 'file-code-o', 'url' => ['/bookseller']],
                            ['label' => '阅读室管理', 'icon' => 'file-code-o', 'url' => ['/reading-room']],
                            ['label' => '违章类型管理', 'icon' => 'file-code-o', 'url' => ['/violation-type']],
                            ['label' => '流通类型管理', 'icon' => 'file-code-o', 'url' => ['/circulation-type']],
                            ['label' => '读者类型管理', 'icon' => 'file-code-o', 'url' => ['/reader-type']],
                            ['label' => '借阅规则配置', 'icon' => 'file-code-o', 'url' => ['/borrowing-rules']],
                            ['label' => '条码号管理', 'icon' => 'file-code-o', 'url' => ['/bar-code']],
                            ['label' => '索书号管理', 'icon' => 'file-code-o', 'url' => ['/call-number-rules']],

   

                            ['label' => '权限配置', 'icon' => 'file-code-o', 'url' => ['/admin']],
                        ],
                    ],
                    // 新增菜单条目，END
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],



                ],
            ]
        ) ?>

    </section>

</aside>
