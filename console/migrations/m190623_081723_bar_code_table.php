<?php
//条码号 `bar_code`
use yii\db\Migration;

/**
 * Class m190623_081723_bar_code_table
 */
class m190623_081723_bar_code_table extends Migration
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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bar_code}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190623_081723_bar_code_table cannot be reverted.\n";

        return false;
    }
    */
}
