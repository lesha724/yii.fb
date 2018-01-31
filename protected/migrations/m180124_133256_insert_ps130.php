<?php

class m180124_133256_insert_ps130 extends CDbMigration
{
	public function safeUp()
	{
        /**
         * roleId - for Moodle
         */
        $sql = <<<SQL
            insert into PORTAL_SETTINGS(PS1, PS2) values(130, 0);
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m180124_133256_insert_ps130 does not support migration down.\\n";
		return false;
	}
}