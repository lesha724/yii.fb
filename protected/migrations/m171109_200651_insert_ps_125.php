<?php

class m171109_200651_insert_ps_125 extends CDbMigration
{
	public function safeUp()
	{
        /**
         * Включать ли методы xml
         */
        $sql = <<<SQL
            insert into PORTAL_SETTINGS(PS1, PS2) values(125, 0);
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m171109_200651_insert_ps_125 does not support migration down.\\n";
		return false;
	}
}