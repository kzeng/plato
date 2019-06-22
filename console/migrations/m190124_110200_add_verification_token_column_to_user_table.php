<?php

use \yii\db\Migration;

class m190124_110200_add_verification_token_column_to_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'verification_token', $this->string()->defaultValue(null));
        $this->addColumn('{{%user}}', 'mobile', $this->string()->defaultValue(null));
        $this->addColumn('{{%user}}', 'library_id', $this->integer()->defaultValue(1));
        $this->addColumn('{{%user}}', 'user_id', $this->integer()->defaultValue(1));

        $this->insert('user', [
            'username' => 'admin',
            'password_hash' => \Yii::$app->security->generatePasswordHash('admin123'),
            'auth_key' => 'auth_key_123',
            'email' => 'admin@demo.com',
            'library_id' => 1,
            'user_id' => 1,
            'status' => 10,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'verification_token');
    }
}
