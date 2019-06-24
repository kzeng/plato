<?php
//读者类型 `reader_type`
use yii\db\Migration;

/**
 * Class m190623_080324_reader_type_table
 */
class m190623_080324_reader_type_table extends Migration
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
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('{{%reader_type}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190623_080324_reader_type_table cannot be reverted.\n";

        return false;
    }
    */
}
