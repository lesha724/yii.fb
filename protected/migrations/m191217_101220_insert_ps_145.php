<?php

class m191217_101220_insert_ps_145 extends CDbMigration
{
	public function up()
	{
        /*
        * запрет отмены записи
        */
        $sql = <<<SQL
            insert into PORTAL_SETTINGS(PS1, PS2) values(145, 0);
SQL;
        $this->execute($sql);
	}

	public function down()
	{
		echo "m191217_101220_insert_ps_145 does not support migration down.\n";
		return false;
	}
}