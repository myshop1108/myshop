<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m180321_073250_create_admin_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique()->comment('用户名'),
            'password' => $this->string(32)->notNull()->comment('密码'),
            'password_hash' => $this->string()->notNull()->comment('密码加密'),
            'password_reset_token' => $this->string()->unique()->comment('令牌创建时间'),
            'email' => $this->string()->notNull()->unique()->comment('邮箱'),

            'status' => $this->smallInteger()->notNull()->defaultValue(10)->comment('状态'),
            'created_at' => $this->integer()->notNull()->comment('注册时间'),
            'updated_at' => $this->integer()->notNull()->comment('最后登录时间'),
            'token'=>$this->string()->notNull()->unique()->comment('自动登录令牌'),
            'token_create_time'=>$this->integer()->notNull()->comment('令牌创建时间'),
            'last_login_ip'=>$this->string()->notNull()->unique()->comment('最后ip地址')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('admin');
    }
}
