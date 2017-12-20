<?php

class m171220_164155_insert_ps128 extends CDbMigration
{
	public function safeUp()
	{
        /**
         * 1 - мобильное приложение через авторизацию
         */
        $sql = <<<SQL
            insert into PORTAL_SETTINGS(PS1, PS2) values(128, 0);
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m171220_164155_insert_ps127 does not support migration down.\\n";
		return false;
	}
}