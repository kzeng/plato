<?php
//缴纳欠费 `payment_of_debt`
use yii\db\Migration;

/**
 * Class m190623_065311_payment_of_debt_table
 */
class m190623_065311_payment_of_debt_table extends Migration
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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%payment_of_debt}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190623_065311_payment_of_debt_table cannot be reverted.\n";

        return false;
    }
    */
}
