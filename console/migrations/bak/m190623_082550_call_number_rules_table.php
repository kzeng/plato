<?php
//索书号规则 `call_number_rules`
use yii\db\Migration;

/**
 * Class m190623_082550_call_number_rules_table
 */
class m190623_082550_call_number_rules_table extends Migration
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
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
    $this->dropTable('{{%call_number_rules}}');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190623_082550_call_number_rules_table cannot be reverted.\n";

        return false;
    }
    */
}
