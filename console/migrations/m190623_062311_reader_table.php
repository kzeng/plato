<?php
//读者 `reader`
use yii\db\Migration;

/**
 * Class m190623_062311_reader_table
 */
class m190623_062311_reader_table extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%reader}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190623_062311_reader_table cannot be reverted.\n";

        return false;
    }
    */
}
