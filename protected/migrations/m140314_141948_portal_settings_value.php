<?php

class m140314_141948_portal_settings_value extends CDbMigration
{
	public function safeUp()
	{
$sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(0, '1');
SQL;
        $this->execute($sql);

        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(1, '');
SQL;
        $this->execute($sql);

        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(2, '1');
SQL;
        $this->execute($sql);

        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(3, '');
SQL;
        $this->execute($sql);

        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(4, '1');
SQL;
        $this->execute($sql);

        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(5, '');
SQL;
        $this->execute($sql);

        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(6, '1');
SQL;
        $this->execute($sql);

        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(7, '');
SQL;
        $this->execute($sql);


/*
	0-отображать dsej4
	1-имя для dsej4
	2-отображать dsej5
	3-имя для dsej5
	4-отображать dsej6
	5-имя для dsej6
	6-отображать dsej7
	7-имя для dsej7
*/
	}

	public function safeDown()
	{
		echo "m140314_141948_portal_settings_value does not support migration down.\\n";
		return false;
	}
}