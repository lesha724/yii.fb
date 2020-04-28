<?php

class m200428_091612_insert_ps_38 extends CDbMigration
{
	public function safeUp()
	{
        /*
        * временное сообщение для выпускников юрфака
        */
        $sql = <<<SQL
            insert into PORTAL_SETTINGS(PS1, PS2) values(38, 1);
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m200428_091612_insert_ps_38 does not support migration down.\\n";
		return false;
	}
}