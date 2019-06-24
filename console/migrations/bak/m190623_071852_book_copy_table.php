<?php
//图书副本 `book_copy`
use yii\db\Migration;

/**
 * Class m190623_071852_book_copy_table
 */
class m190623_071852_book_copy_table extends Migration
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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book_copy}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190623_071852_book_copy_table cannot be reverted.\n";

        return false;
    }
    */
}
