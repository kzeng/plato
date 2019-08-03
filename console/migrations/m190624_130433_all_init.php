<?php

use yii\db\Migration;
use yii\helpers\Console;
use yii\helpers\FileHelper;

/**
 * Class m190624_130433_all_init
 */
class m190624_130433_all_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE=InnoDB';
        }

        //------------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%user}}")->execute();
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(32)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'access_token' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'email' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            // kzeng added 
            'verification_token' => $this->string()->defaultValue(null),
            'mobile' => $this->string()->defaultValue(null),
            'library_id' => $this->integer()->defaultValue(0),
            'user_id' => $this->integer()->defaultValue(0),
            'pid' => $this->integer()->defaultValue(0),
            //kzeng added end
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addCommentOnTable('{{%user}}', '用户表');

        //------------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%library}}")->execute();
        $this->createTable('{{%library}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull()->comment('名称'),
            'mobile' => $this->string(32)->comment('电话'),
            'address' => $this->string(128)->comment('地址'),
            'logo_img' => $this->string(256)->defaultValue(null)->comment('Logo'),
            'description' => $this->text()->defaultValue(null)->comment('简介'),
            'pid' => $this->integer()->notNull()->defaultValue(1)->comment('父ID'),
            'user_id' => $this->integer()->notNull()->defaultValue(1)->comment('操作员ID'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
        ], $tableOptions);
        $this->addCommentOnTable('{{%library}}', '图书馆表');
        //------------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%reader}}")->execute();
        $this->createTable('{{%reader}}', [
            'id' => $this->primaryKey(),
            'card_number' => $this->string(64)->notNull()->comment('卡号'),
            'card_status' => $this->integer()->notNull()->defaultValue(0)->comment('证件状态'),
            'reader_name' => $this->string(64)->notNull()->comment('姓名'),
            'validity' => $this->integer()->notNull()->comment('有效期限'),
            'id_card' => $this->string(64)->notNull()->comment('身份证'),
            'reader_type_id' => $this->integer()->notNull()->comment('读者类型'),
            'gender' => $this->integer()->notNull()->comment('性别'),
            'deposit' => $this->decimal(10,2)->comment('押金(元)'),
            'creditmoney' => $this->decimal(10,2)->comment('欠费金额(元)'),
            'mobile' => $this->string(32)->comment('电话'),
            'address' => $this->string(32)->comment('地址'),
            'library_id' => $this->integer()->notNull()->comment('图书馆ID'),
            'user_id' => $this->integer()->notNull()->defaultValue(1)->comment('操作员ID'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
        ], $tableOptions);
        $this->addCommentOnTable('{{%reader}}', '读者表');
        //------------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%payment_of_debt}}")->execute();
        $this->createTable('{{%payment_of_debt}}', [
            'id' => $this->primaryKey(),
            'reader_id' => $this->integer()->notNull()->comment('读者ID'),
            'violation_type_id' => $this->integer()->notNull()->comment('违章类型'),
            'payment_status' => $this->integer()->notNull()->comment('缴费状态'),
            'penalty' => $this->decimal(10,2)->comment('罚金(元)'),
            'description' => $this->string(256)->notNull()->comment('描述'),
            'library_id' => $this->integer()->notNull()->comment('图书馆ID'),
            'user_id' => $this->integer()->notNull()->defaultValue(1)->comment('操作员ID'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
        ], $tableOptions);
        $this->addCommentOnTable('{{%payment_of_debt}}', '缴纳欠费表');
        //-----------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%book}}")->execute();
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull()->comment('题名'),
            'isbn' => $this->string(64)->notNull()->comment('ISBN'),
            'cover_img' => $this->string(256)->notNull()->comment('封面'),
            'description' => $this->string(1024)->comment('简介'),
            'author' => $this->string(64)->notNull()->comment('作者'),
            'price' => $this->decimal(10,2)->comment('价格(元)'),
            'price1' => $this->string(64)->comment('价格(元)'),
            'copy_number' => $this->integer()->comment('复本数'),
            'class_number' => $this->string(64)->comment('分类号'),
            'call_number' => $this->string(64)->comment('索书号'),
            'publisher' => $this->string(64)->comment('出版社'),
            'publication_place' => $this->string(64)->comment('出版地'),
            'publish_date' => $this->string(64)->comment('出版年月'),
            'series_title' => $this->string(64)->comment('从书名'),
            'library_id' => $this->integer()->notNull()->comment('图书馆ID'),
            'user_id' => $this->integer()->notNull()->defaultValue(1)->comment('操作员ID'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
        ], $tableOptions);
        $this->addCommentOnTable('{{%book}}', '图书表');
        //-----------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%book_copy}}")->execute();
        $this->createTable('{{%book_copy}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull()->defaultValue(0)->comment('图书ID'),
            'bar_code' => $this->string(128)->notNull()->comment('条码号'),
            'bookseller_id' => $this->integer()->notNull()->comment('书商'),
            'price1' => $this->decimal(10,2)->comment('实洋(元)'),
            'price2' => $this->decimal(10,2)->comment('码洋(元)'),
            'collection_place_id' => $this->integer()->notNull()->comment('馆藏地'),
            'circulation_type_id' => $this->integer()->notNull()->comment('流通类型'),
            'call_number_rules_id' => $this->integer()->notNull()->comment('索书号规则'),
            'library_id' => $this->integer()->notNull()->comment('图书馆ID'),
            'user_id' => $this->integer()->notNull()->defaultValue(1)->comment('操作员ID'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
        ], $tableOptions);
        $this->addCommentOnTable('{{%book_copy}}', '图书副本表');
        //-----------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%collection_place}}")->execute();
        $this->createTable('{{%collection_place}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull()->comment('名称'),
            'description' => $this->string(256)->notNull()->comment('说明'),
            'library_id' => $this->integer()->notNull()->comment('图书馆ID'),
            'user_id' => $this->integer()->notNull()->defaultValue(1)->comment('操作员ID'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
        ], $tableOptions);
        $this->addCommentOnTable('{{%collection_place}}', '馆藏地点表');
        //-----------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%bookseller}}")->execute();
        $this->createTable('{{%bookseller}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull()->comment('名称'),
            'address' => $this->string(128)->comment('地址'),
            'contact' => $this->string(128)->comment('联系人姓名'),
            'mobile' => $this->string(32)->comment('电话'),
            'discount' => $this->decimal(10,2)->comment('折扣'),
            'library_id' => $this->integer()->notNull()->comment('图书馆ID'),
            'user_id' => $this->integer()->notNull()->defaultValue(1)->comment('操作员ID'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
        ], $tableOptions);
        $this->addCommentOnTable('{{%bookseller}}', '书商表');
        //-----------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%reading_room}}")->execute();
        $this->createTable('{{%reading_room}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull()->comment('名称'),
            'description' => $this->string(256)->comment('说明'),
            'library_id' => $this->integer()->notNull()->comment('图书馆ID'),
            'user_id' => $this->integer()->notNull()->defaultValue(1)->comment('操作员ID'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
        ], $tableOptions);
        $this->addCommentOnTable('{{%reading_room}}', '阅览室表');
        //-----------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%reading_room_checkin}}")->execute();
        $this->createTable('{{%reading_room_checkin}}', [
            'id' => $this->primaryKey(),
            'reader_id' => $this->integer()->notNull()->comment('读者ID'),
            'card_number' => $this->string(64)->notNull()->comment('读者证卡号'),
            'reading_room_id' => $this->integer()->notNull()->comment('阅览室ID'),
            'library_id' => $this->integer()->notNull()->comment('图书馆ID'),
            'user_id' => $this->integer()->notNull()->defaultValue(1)->comment('操作员ID'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
        ], $tableOptions);
        $this->addCommentOnTable('{{%reading_room_checkin}}', '阅览室签到表');
        //-----------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%violation_type}}")->execute();
        $this->createTable('{{%violation_type}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull()->comment('名称'),
            'description' => $this->string(256)->comment('说明'),
            'library_id' => $this->integer()->notNull()->comment('图书馆ID'),
            'user_id' => $this->integer()->notNull()->defaultValue(1)->comment('操作员ID'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
        ], $tableOptions);
        $this->addCommentOnTable('{{%violation_type}}', '违章类型表');
        //-----------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%circulation_type}}")->execute();
        $this->createTable('{{%circulation_type}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull()->comment('名称'),
            'description' => $this->string(256)->comment('说明'),
            'library_id' => $this->integer()->notNull()->comment('图书馆ID'),
            'user_id' => $this->integer()->notNull()->defaultValue(1)->comment('操作员ID'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
        ], $tableOptions);
        $this->addCommentOnTable('{{%circulation_type}}', '流通类型表');
        //-----------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%reader_type}}")->execute();
        $this->createTable('{{%reader_type}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull()->comment('名称'),
            'max_borrowing_number' => $this->integer()->notNull()->comment('最大借阅量（本）'),
            'max_debt_limit' => $this->integer()->notNull()->comment('最大欠费额度（元）'),
            'max_return_time' => $this->integer()->notNull()->comment('最大还书时间（天）'),
            'library_id' => $this->integer()->notNull()->comment('图书馆ID'),
            'user_id' => $this->integer()->notNull()->defaultValue(1)->comment('操作员ID'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
        ], $tableOptions);
        $this->addCommentOnTable('{{%reader_type}}', '读者类型表');
        //-----------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%borrowing_rules}}")->execute();
        $this->createTable('{{%borrowing_rules}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull()->comment('名称'),
            'general_loan_period' => $this->integer()->notNull()->comment('一般借期(天)'),
            'extended_period_impunity' => $this->integer()->notNull()->comment('超期免罚期限(天)'),
            'first_term_of_punishment' => $this->integer()->notNull()->comment('首罚期限(天)'),
            'first_penalty_unit_price' => $this->decimal(10,2)->comment('首罚单价(元)'),
            'other__unit_price' => $this->decimal(10,2)->comment('其它单价(元)'),
            'reader_type_ids' => $this->string(128)->comment('适用读者类型'),
            'circulation_type_ids' => $this->string(128)->comment('适用流通类型'),
            'library_id' => $this->integer()->notNull()->comment('图书馆ID'),
            'user_id' => $this->integer()->notNull()->defaultValue(1)->comment('操作员ID'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
        ], $tableOptions);
        $this->addCommentOnTable('{{%borrowing_rules}}', '借阅规则表');      
        //-----------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%bar_code}}")->execute();
        $this->createTable('{{%bar_code}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull()->comment('名称'),
            'prefix' => $this->string(64)->comment('前缀'),
            'number_length' => $this->integer()->notNull()->comment('数字长度'),
            'min_number' => $this->integer()->notNull()->comment('数字最小值'),
            'max_number' => $this->integer()->notNull()->comment('数字最大值'),
            'description' => $this->string(256)->comment('说明'),
            'library_id' => $this->integer()->notNull()->comment('图书馆ID'),
            'user_id' => $this->integer()->notNull()->defaultValue(1)->comment('操作员ID'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
        ], $tableOptions);
        $this->addCommentOnTable('{{%bar_code}}', '条码号表');                  
        //-----------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%call_number_rules}}")->execute();
        $this->createTable('{{%call_number_rules}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull()->comment('名称'),
            'collection_place_ids' => $this->string(512)->comment('馆藏地'),
            'circulation_type_ids' => $this->string(512)->comment('流通类型'),
            'library_id' => $this->integer()->notNull()->comment('图书馆ID'),
            'user_id' => $this->integer()->notNull()->defaultValue(1)->comment('操作员ID'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
        ], $tableOptions);
        $this->addCommentOnTable('{{%call_number_rules}}', '索书号规则表');     
        //-----------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%borrow_return_books}}")->execute();
        $this->createTable('{{%borrow_return_books}}', [
            'id' => $this->primaryKey(),
            'card_number' => $this->string(64)->notNull()->comment('卡号'),
            'bar_code' => $this->string(128)->notNull()->comment('条码号'),
            'operation' => $this->integer()->notNull()->comment('借还操作:1借，0还'),
            'library_id' => $this->integer()->notNull()->comment('图书馆ID'),
            'user_id' => $this->integer()->notNull()->defaultValue(1)->comment('操作员ID'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
        ], $tableOptions);
        $this->addCommentOnTable('{{%borrow_return_books}}', '借还书表');     
        //------------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%events}}")->execute();
        $this->createTable('{{%events}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull()->comment('名称'),
            'event_type' => $this->integer()->notNull()->defaultValue(1)->comment('事件类型'),
            'description' => $this->text()->defaultValue(null)->comment('内容'),
            'library_id' => $this->integer()->notNull()->comment('图书馆ID'),
            'user_id' => $this->integer()->notNull()->defaultValue(1)->comment('操作员ID'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
        ], $tableOptions);
        $this->addCommentOnTable('{{%events}}', '事件表');

        
        if (Console::confirm('Seed demo data?', true)) {
            $this->seed();
        }
        return true;
    }

    public function seed()
    {
        $faker = \Faker\Factory::create('zh_CN');

        //add admin data to 'user'
        $user = new common\models\User1();
        $user->username = 'admin';
        $user->password_hash = \Yii::$app->security->generatePasswordHash('admin123');
        $user->auth_key = \Yii::$app->security->generateRandomString(32);
        $user->access_token = \Yii::$app->security->generateRandomString(32);
        $user->email = 'admin@demo.com';
        $user->mobile = "88888888";
        $user->library_id = 0;
        $user->user_id = 0;
        $user->pid = 0;
        $user->status = 10;
        $user->created_at = time();
        $user->updated_at = time();
        $user->save();
      
        //江夏区图书馆管理员
        $user = new common\models\User1();
        $user->username = '江夏区图书馆管理员';
        $user->password_hash = \Yii::$app->security->generatePasswordHash('123456');
        $user->auth_key = \Yii::$app->security->generateRandomString(32);
        $user->access_token = \Yii::$app->security->generateRandomString(32);
        $user->email = 'xjqlib@demo.com';
        $user->mobile = "66666666";
        $user->library_id = 1;
        $user->user_id = 1;
        $user->pid = 1;
        $user->status = 10;
        $user->created_at = time();
        $user->updated_at = time();
        $user->save();

        for ($i = 1; $i < 6; $i++) {
            $user = new common\models\User1();
            $user->username = '江夏区图书馆管理员'.$i;
            $user->password_hash = \Yii::$app->security->generatePasswordHash('123456');
            $user->auth_key = \Yii::$app->security->generateRandomString(32);
            $user->access_token = \Yii::$app->security->generateRandomString(32);
            $user->email = 'jxqlib'.$i.'@demo.com';
            $user->mobile = "66666666";
            $user->library_id = 1;
            $user->user_id = 2;
            $user->pid = 2;
            $user->status = 10;
            $user->created_at = time();
            $user->updated_at = time();
            $user->save();
        }
        echo "\n insert demo data (admin) into user, ok";

        //洪山区图书馆管理员
        $user = new common\models\User1();
        $user->username = '洪山区图书馆管理员';
        $user->password_hash = \Yii::$app->security->generatePasswordHash('123456');
        $user->auth_key = \Yii::$app->security->generateRandomString(32);
        $user->access_token = \Yii::$app->security->generateRandomString(32);
        $user->email = 'hsqlib@demo.com';
        $user->mobile = "77777777";
        $user->library_id = 2;
        $user->user_id = 1;
        $user->pid = 1;
        $user->status = 10;
        $user->created_at = time();
        $user->updated_at = time();
        $user->save();

        for ($i = 1; $i < 6; $i++) {
            $user = new common\models\User1();
            $user->username = '洪山区图书馆管理员'.$i;
            $user->password_hash = \Yii::$app->security->generatePasswordHash('123456');
            $user->auth_key = \Yii::$app->security->generateRandomString(32);
            $user->access_token = \Yii::$app->security->generateRandomString(32);
            $user->email = 'jxqlib'.$i.'@demo.com';
            $user->mobile = "77777777";
            $user->library_id = 2;
            $user->user_id = 3;
            $user->pid = 3;
            $user->status = 10;
            $user->created_at = time();
            $user->updated_at = time();
            $user->save();
        }
        echo "\n insert demo data into user, ok";

     
        //add 'library' data
        $library = new common\models\Library();
        $library->title = '江夏区图书馆';
        $library->mobile = $faker->phoneNumber;
        $library->address = '江夏区图书馆人民路';
        $library->pid = 1;
        $library->created_at = time();
        $library->updated_at = time();
        $library->status = 1;
        $library->save(false);

        $library = new common\models\Library();
        $library->title = '洪山区图书馆';
        $library->mobile = $faker->phoneNumber;
        $library->address = '洪山区图书馆地址是文治街499';
        $library->pid = 1;
        $library->created_at = time();
        $library->updated_at = time();
        $library->status = 1;
        $library->save(false);

        $library = new common\models\Library();
        $library->title = '硚口区图书馆';
        $library->mobile = $faker->phoneNumber;
        $library->address = '汉口集贤路特1号';
        $library->pid = 1;
        $library->created_at = time();
        $library->updated_at = time();
        $library->status = 1;
        $library->save(false);

        echo "\n insert demo data into library, ok";



        //bookseller
        for ($i = 1; $i < 9; $i++) {
            $model = new common\models\Bookseller();
            $model->title = $faker->company;
            $model->address = $faker->address;
            $model->contact = $faker->name;
            $model->mobile = $faker->phoneNumber;
            $model->discount = 0.85;
            $model->library_id = 1;
            $model->user_id = rand(2,7);
            $model->status = 1;
            $model->created_at = time();
            $model->updated_at = time();
            $model->save();
        }
        echo "\n insert demo data into bookseller, ok";

        //reading_room
        for ($i = 1; $i < 21; $i++) {
            $model = new common\models\ReadingRoom();
            $model->title = $i.'号阅读室';
            $model->description = '图书馆阅读室';
            $model->library_id = 1;
            $model->user_id = rand(2,7);
            $model->status = 1;
            $model->created_at = time();
            $model->updated_at = time();
            $model->save();
        }
        echo "\n insert demo data into reading_room, ok";
  
        //collection_place
        for ($i = 1; $i < 9; $i++) {
            $model = new common\models\CollectionPlace();
            $model->title = '勤学楼80'.$i.'室';
            $model->description = '图书馆馆藏地点';
            $model->library_id = 1;
            $model->user_id = rand(2,7);
            $model->status = 1;
            $model->created_at = time();
            $model->updated_at = time();
            $model->save();
        }
        echo "\n insert demo data into collection_place, ok";
        

        //violation_type
        $violation_type_title = [
            '逾期不还',
            '图书损坏',
            '图书丢失',
        ];
        $violation_type_description = [
            '逾期不还, 欠费达一元者, 不可再借',
            '图书损坏, 不可再借',
            '图书丢失, 不可再借',
        ];
        for ($i = 0; $i < 3; $i++) {
            $model = new common\models\ViolationType();
            $model->title = $violation_type_title[$i];
            $model->description = $violation_type_description[$i];
            $model->library_id = 1;
            $model->user_id = rand(2,7);
            $model->status = 1;
            $model->created_at = time();
            $model->updated_at = time();
            $model->save(false);
        }
        echo "\n insert demo data into violation_type, ok";

        //circulation_type
        $title = ['文学类','教育类'];
        $description = ['国内外名著、小说','各类教材、教辅'];
        for ($i = 0; $i < 2; $i++) {
            $model = new common\models\CirculationType();
            $model->title = $title[$i];
            $model->description =  $description[$i];
            $model->library_id = 1;
            $model->user_id = rand(2,7);
            $model->status = 1;
            $model->created_at = time();
            $model->updated_at = time();
            $model->save();
        }
        echo "\n insert demo data into circulation_type, ok";
        
        //reader_type
        $title = ['学生','教师', '社会人员'];
        for ($i = 0; $i < 3; $i++) {
            $model = new common\models\ReaderType();
            $model->title = $title[$i];
            $model->max_borrowing_number = rand(5,10);
            $model->max_debt_limit = 100;
            $model->max_return_time = 90;
            $model->library_id = 1;
            $model->user_id = rand(2,7);
            $model->status = 1;
            $model->created_at = time();
            $model->updated_at = time();
            $model->save();
        }
        echo "\n insert demo data into reader_type, ok";


        //book
        // for ($i = 0; $i < 100; $i++) {
        //     $model = new common\models\Book();
        //     $model->title = $faker->title;
        //     $model->cover_img = '';
        //     $model->description = $faker->text;
        //     $model->isbn = $faker->ISBN;
        //     $model->author = $faker->author;
        //     $model->price = $faker->randomNumber(2);
        //     $model->class_number = "";
        //     $model->call_number = "";
        //     $model->publisher = $faker->publish;
        //     $model->publication_place = rand(1,50);
        //     $model->publish_date = '19'.rand(49,99). "年";
        //     $model->series_title = "";
        //     $model->library_id = 1;
        //     $model->user_id = rand(2,7);
        //     $model->status = 1;
        //     $model->created_at = time();
        //     $model->updated_at = time();
        //     $model->save();
        // }
        // echo "\n insert demo data into book, ok\n";

        //reader
        for ($i = 0; $i < 301; $i++) {
            $model = new common\models\Reader();
            $model->card_number = $faker->creditCardNumber;
            $model->card_status = 1;
            $model->reader_name = $faker->name;
            $model->validity = strtotime("2025-12-31 00:00:00");
            $model->id_card = "123456789012345000".$i;
            $model->reader_type_id = rand(1,3);
            $model->gender = rand(0,1);
            $model->deposit = 100;
            $model->creditmoney = 0;
            $model->mobile = $faker->phoneNumber;
            $model->address = $faker->address;
            $model->library_id = 1;
            $model->user_id = rand(2,7);
            $model->status = 1;
            $model->created_at = time();
            $model->updated_at = time();
            $model->save(false);
        }
        echo "\n insert demo data into reader, ok";

        //payment_of_debt
        $reader = common\models\Reader::find()->all();
        for ($i = 0; $i < 30; $i++) {
            $model = new common\models\PaymentOfDebt();
            //$model->card_number = $reader[$i]->card_number;
            $model->reader_id = $reader[$i]->id;
            $model->violation_type_id = rand(1,3);
            $model->payment_status = rand(0,1);
            $model->penalty = rand(100,200);
            $model->description = "";
            $model->library_id = 1;
            $model->user_id = rand(2,7);
            $model->status = 1;
            $model->created_at = time();
            $model->updated_at = time();
            $model->save(false);
        }
        echo "\n insert demo data into payment_of_debt, ok";


        //reading_room_checkin 江夏区图书馆数据50条
        $readers = common\models\Reader::find()->where(['library_id' => 1])->limit(50)->all();
        foreach($readers as $reader)
        {
            $model = new common\models\ReadingRoomCheckin();
            $model->reader_id = $reader->id;
            $model->card_number = $reader->card_number;
            $model->reading_room_id = rand(1,3);
            $model->library_id = 1;
            $model->user_id = rand(2,7);
            $model->status = 1;
            $model->created_at = time();
            $model->updated_at = time();
            $model->save(false);
        }
        echo "\n insert demo data into reading_room_checkin, ok";


        //图书副本 book_copy
        //$books = common\models\Book::find()->where(['library_id' => 1])->limit(50)->all();
        for($j=1; $j<51; $j++)
        {
            $str = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q',
                    'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' ];
            $str1 = $str[rand(0,25)].$str[rand(0,25)].$str[rand(0,25)];
            $book_id = $j;
            $title = '';
            $price1 = $price2 = rand(30,100);
            $bookseller_id = rand(1,5);
            $collection_place_id = rand(1,5);
            $circulation_type_id = rand(1,2);
            $call_number_rules_id = rand(1,5);
            $library_id = 1;
            $user_id = rand(2,7);
            $created_at = time();
            $updated_at = time();
        
            for($i=0; $i<10; $i++) //每本图书创建10个副本
            {
                $model = new common\models\BookCopy();

                $model->book_id = $book_id;
                //$model->title = $title;
                $model->price1 = $price1;
                $model->price2 = $price2;
                $model->bookseller_id = $bookseller_id;
                $model->collection_place_id = $collection_place_id;
                $model->circulation_type_id = $circulation_type_id;
                $model->call_number_rules_id = $call_number_rules_id;
                $model->bar_code = sprintf($str1."%09d", $i+1);
                $model->library_id = $library_id;
                $model->user_id = $user_id;
                $model->status = 1;
                $model->created_at = $created_at;
                $model->updated_at = $updated_at;
                $model->save(false);
            }

        }
        echo "\n insert demo data into book_copy, ok";



        // * @property int $id
        // * @property string $card_number 卡号
        // * @property string $bar_code 条码号
        // * @property int $operation 借还操作:1借，0还
        // * @property int $library_id 图书馆ID
        // * @property int $user_id 操作员ID
        // * @property int $created_at 创建时间
        // * @property int $updated_at 更新时间
        // * @property int $status 状态
        // */

        //borrow_return_books
        //增加5名读者借书数据
        for ($i = 1; $i < 6; $i++) {
            $reader = common\models\Reader::findOne(['id' => $i]);
       
            $card_number = $reader->card_number;
            $created_at = $updated_at = time();
            for($j=1; $j<6; $j++)
            {
                $offset = ($j - 1) * 10  + $i;
                $book_copy = common\models\BookCopy::findOne(['id' => $offset]);
                $model = new common\models\BorrowReturnBooks();
                $model->card_number = $card_number;
                $model->bar_code = $book_copy->bar_code;
                $model->operation = 1;
                $model->library_id = 1;
                $model->user_id = rand(2,7);
                $model->status = 1;
                $model->created_at = $created_at;
                $model->updated_at = $updated_at;
                $model->save(false);
            }
        }
        echo "\n insert demo data into borrow_return_books, ok";





        echo "\n end of demo data insert!\n";
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // $this->dropTable('{{%user}}');
        // $this->dropTable('{{%library}}');
        // $this->dropTable('{{%reader}}');
        // $this->dropTable('{{%reader_type}}');
        // $this->dropTable('{{%payment_of_debt}}');
        // $this->dropTable('{{%book}}');
        // $this->dropTable('{{%book_copy}}');
        // $this->dropTable('{{%collection_place}}');
        // $this->dropTable('{{%bookseller}}');

        // $this->dropTable('{{%reading_room}}');
        // $this->dropTable('{{%violation_type}}');
        // $this->dropTable('{{%circulation_type}}');

        // $this->dropTable('{{%borrowing_rules}}');
        // $this->dropTable('{{%bar_code}}');
        // $this->dropTable('{{%call_number_rules}}');
        return true;

    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190624_130433_all_init cannot be reverted.\n";

        return false;
    }
    */
}
