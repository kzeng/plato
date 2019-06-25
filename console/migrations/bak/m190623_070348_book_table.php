<?php
//图书  `book`
use yii\db\Migration;

/**
 * Class m190623_070348_book_table
 */
class m190623_070348_book_table extends Migration
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

        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull()->comment('题名'),
            'cover_img' => $this->string(256)->comment('封面'),
            'description' => $this->string(1024)->comment('简介'),
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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190623_070348_book_table cannot be reverted.\n";

        return false;
    }
    */
}
