<?php
//借阅规则 `borrowing_rules`
use yii\db\Migration;

/**
 * Class m190623_080902_borrowing_rules_table
 */
class m190623_080902_borrowing_rules_table extends Migration
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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%borrowing_rules}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190623_080902_borrowing_rules_table cannot be reverted.\n";

        return false;
    }
    */
}
