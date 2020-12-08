<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profiles}}`.
 */
class m201208_072824_create_profiles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%profiles}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $profiles = ['leomessi', 'irinashayk'];

        foreach ($profiles as $profile) {
            $this->insert('{{%profiles}}', [
                'username' => $profile,
                'created_at' => time(),
                'updated_at' => time()
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profiles}}');
    }
}
