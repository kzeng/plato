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
            'card_number' => $this->string(64)->notNull()->comment('卡号'),
            'reader_name' => $this->string(64)->notNull()->comment('姓名'),
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
        $this->addCommentOnTable('{{%payment_of_debt}}', '欠费缴纳表');
        //-----------------------------------------------------------------------------
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {{%book}}")->execute();
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull()->comment('题名'),
            'isbn' => $this->string(64)->notNull()->comment('ISBN'),
            'author' => $this->string(64)->notNull()->comment('作者'),
            'price' => $this->decimal(10,2)->comment('价格(元)'),
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
            'title' => $this->string(128)->notNull()->comment('题名'),
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
        
        if (Console::confirm('Seed demo data?', true)) {
            $this->seed();
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
    }

    public function seed()
    {
        $faker = \Faker\Factory::create('zh_CN');

        //add admin data to 'user'
        $user = new common\models\User1();
        $user->username = 'admin';
        $user->password_hash = \Yii::$app->security->generatePasswordHash('admin123');
        $user->auth_key = 'auth_key_123';
        $user->email = 'admin@demo.com';
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
        $user->auth_key = 'auth_key_123';
        $user->email = 'xjqlib@demo.com';
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
            $user->auth_key = 'auth_key_123';
            $user->email = 'jxqlib'.$i.'@demo.com';
            $user->library_id = 1;
            $user->user_id = 2;
            $user->pid = 2;
            $user->status = 10;
            $user->created_at = time();
            $user->updated_at = time();
            $user->save();
        }

        //洪山区图书馆管理员
        $user = new common\models\User1();
        $user->username = '洪山区图书馆管理员';
        $user->password_hash = \Yii::$app->security->generatePasswordHash('123456');
        $user->auth_key = 'auth_key_123';
        $user->email = 'hsqlib@demo.com';
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
            $user->auth_key = 'auth_key_123';
            $user->email = 'jxqlib'.$i.'@demo.com';
            $user->library_id = 2;
            $user->user_id = 3;
            $user->pid = 3;
            $user->status = 10;
            $user->created_at = time();
            $user->updated_at = time();
            $user->save();
        }

        //add 'library' data
        $library = new common\models\Library();
        $library->title = '江夏区图书馆';
        $library->mobile = '12345678';
        $library->address = '江夏区图书馆人民路';
        $library->pid = 1;
        $library->created_at = time();
        $library->updated_at = time();
        $library->status = 1;
        $library->save();

        $library = new common\models\Library();
        $library->title = '洪山区图书馆';
        $library->mobile = '66666666';
        $library->address = '洪山区图书馆地址是文治街499';
        $library->pid = 1;
        $library->created_at = time();
        $library->updated_at = time();
        $library->status = 1;
        $library->save();

        $library = new common\models\Library();
        $library->title = '硚口区图书馆';
        $library->mobile = '88888888';
        $library->address = '汉口集贤路特1号';
        $library->pid = 1;
        $library->created_at = time();
        $library->updated_at = time();
        $library->status = 1;
        $library->save();


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
