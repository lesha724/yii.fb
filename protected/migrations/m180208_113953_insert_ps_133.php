<?php

class m180208_113953_insert_ps_133 extends CDbMigration
{
	public function safeUp()
	{
        /**
         * емейл для админской записи дист образования
         */
        $sql = <<<SQL
            insert into PORTAL_SETTINGS(PS1, PS2) values(133, '');
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m180208_113953_insert_ps_133 does not support migration down.\\n";
		return false;
	}
}