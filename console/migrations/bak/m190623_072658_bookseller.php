<?php
//书商 `bookseller`
use yii\db\Migration;


/**
 * Class m190623_072658_bookseller
 */
class m190623_072658_bookseller extends Migration
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
    }



    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bookseller}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190623_072658_bookseller cannot be reverted.\n";

        return false;
    }
    */
}
