<?php

use yii\db\Migration;

/**
 * Class m180320_170113_add_column_category_field
 */
class m180320_170113_add_column_category_field extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('section_service', 'fields', $this->string(500));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('section_service', 'fields');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180320_170113_add_column_category_field cannot be reverted.\n";

        return false;
    }
    */
}
