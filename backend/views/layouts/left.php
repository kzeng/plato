<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <!-- <div class="user-panel">
            <div class="pull-left image">

                <img src="library.png" class="img-circle" alt="User Image"/>

            </div>
            <div class="pull-left info">
                <p>
                <//?php
                    $user = common\models\User::findOne(['id' => Yii::$app->user->id]);
                    if(!empty($user))
                        echo $user->username;
                    else
                        echo "N/A";
                ?>
                </p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div> -->

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
                'items' => array_merge(\mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id), [
                    ['label' => '', 'options' => ['class' => 'header']],

                    //['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    //['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    //['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => '仪表盘', 'icon' => 'dashboard', 'url' => ['/dashboard']],
                    ['label' => '日历事件', 'icon' => 'calendar', 'url' => ['/events']],
                    [
                        'label' => '馆藏信息',
                        'icon' => 'university',
                        'url' => '#',
                        'items' => [
                            ['label' => '图书管理',  'icon' => 'angle-double-right', 'url' => ['/book']],
                            ['label' => '图书副本管理',  'icon' => 'angle-double-right', 'url' => ['/book-copy']],
 
                        ],
                    ],

                    [
                        'label' => '流通借阅',
                        'icon' => 'book',
                        'url' => '#',
                        'items' => [
                            ['label' => '借还书管理',  'icon' => 'angle-double-right', 'url' => ['/borrow-return-books']],
                            ['label' => '阅读室管理',  'icon' => 'angle-double-right', 'url' => ['/reading-room']],
                            ['label' => '阅读室签到',  'icon' => 'angle-double-right', 'url' => ['/reading-room-checkin']],
                        ],
                    ],

                    
                    [
                        'label' => '流通管理',
                        'icon' => 'user',
                        'url' => '#',
                        'items' => [
                            ['label' => '读者管理',  'icon' => 'angle-double-right', 'url' => ['/reader']],
                            ['label' => '缴纳欠费管理',  'icon' => 'angle-double-right', 'url' => ['/payment-of-debt']],
                        ],
                    ],

                    [
                        'label' => '服务数据',
                        'icon' => 'pie-chart ',
                        'url' => '#',
                        'items' => [
                            ['label' => '借阅排行榜',  'icon' => 'angle-double-right', 'url' => ['/common-pages/comingsoon']],
                            ['label' => '流通统计',  'icon' => 'angle-double-right', 'url' => ['/common-pages/comingsoon']],
                            ['label' => '馆藏统计',  'icon' => 'angle-double-right', 'url' => ['/common-pages/comingsoon']],

                        ],
                    ],

                    [
                        'label' => '系统管理',
                        'icon' => 'gear',
                        'url' => '#',
                        'items' => [
                            ['label' => '图书馆配置',  'icon' => 'angle-double-right', 'url' => ['/library']],
                            ['label' => '馆藏地管理',  'icon' => 'angle-double-right', 'url' => ['/collection-place']],
                            ['label' => '书商管理',  'icon' => 'angle-double-right', 'url' => ['/bookseller']],
                            ['label' => '违章类型管理',  'icon' => 'angle-double-right', 'url' => ['/violation-type']],
                            ['label' => '流通类型管理',  'icon' => 'angle-double-right', 'url' => ['/circulation-type']],
                            //['label' => '读者类型管理',  'icon' => 'angle-double-right', 'url' => ['/reader-type']],
                            ['label' => '借阅规则配置',  'icon' => 'angle-double-right', 'url' => ['/borrowing-rules']],
                            ['label' => '条码号序列设置',  'icon' => 'angle-double-right', 'url' => ['/bar-code']],
                            ['label' => '索书号管理',  'icon' => 'angle-double-right', 'url' => ['/call-number-rules']],
                        ],
                    ],

                    [
                        'label' => '管理权限',
                        'icon' => 'exclamation-triangle',
                        'url' => '#',
                        'items' => [
                            ['label' => '馆员配置',  'icon' => 'angle-double-right', 'url' => ['/user1']],
                            ['label' => '权限配置', 'icon' => 'exclamation-triangle', 'url' => ['/admin']],
                        ],
                    ],

                    // 新增菜单条目，END
                    // [
                    //     'label' => 'Some tools',
                    //     'icon' => 'share',
                    //     'url' => '#',
                    //     'items' => [
                    //         ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                    //         ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                    //         [
                    //             'label' => 'Level One',
                    //             'icon' => 'circle-o',
                    //             'url' => '#',
                    //             'items' => [
                    //                 ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                    //                 [
                    //                     'label' => 'Level Two',
                    //                     'icon' => 'circle-o',
                    //                     'url' => '#',
                    //                     'items' => [
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                     ],
                    //                 ],
                    //             ],
                    //         ],
                    //     ],
                    // ]


                ])
            ]
        ) ?>

    </section>

</aside>
