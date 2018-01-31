<?php

class m180109_100524_insert_ps129 extends CDbMigration
{
	public function safeUp()
	{
        /**
         * 1 - записівать на курс при записи на дисциплину
         */
        $sql = <<<SQL
            insert into PORTAL_SETTINGS(PS1, PS2) values(129, 0);
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m180109_100524_insert_ps129 does not support migration down.\\n";
		return false;
	}
}