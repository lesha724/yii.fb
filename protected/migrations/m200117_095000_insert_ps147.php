<?php

class m200117_095000_insert_ps147 extends CDbMigration
{
	public function up()
	{
        /*
        * разрешить зброс регистрации
        */
        $sql = <<<SQL
            insert into PORTAL_SETTINGS(PS1, PS2) values(147, 1);
SQL;
        $this->execute($sql);
	}

	public function down()
	{
		echo "m200117_095000_insert_ps146 does not support migration down.\n";
		return false;
	}
}