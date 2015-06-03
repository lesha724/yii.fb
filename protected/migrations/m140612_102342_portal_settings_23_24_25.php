<?php

class m140612_102342_portal_settings_23_24_25 extends CDbMigration
{
	public function safeUp()
	{
        $sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(23, '');
SQL;
        $this->execute($sql);

        $sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(24, '');
SQL;
        $this->execute($sql);

        $sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(25, '1');
SQL;
        $this->execute($sql);

	}

	public function safeDown()
	{
		echo "m140612_102342_portal_settings_23_24_25 does not support migration down.\\n";
		return false;
	}
}