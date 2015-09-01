<?php

class m140417_074156_porta_settings extends CDbMigration
{
	public function safeUp()
	{

        $sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(17, 'Тест');
SQL;
        $this->execute($sql);

        $sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(18, 'Практика');
SQL;
        $this->execute($sql);


        $sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(19, 'Бонус');
SQL;
        $this->execute($sql);

	}

	public function safeDown()
	{
		echo "m140417_074156_porta_settings does not support migration down.\\n";
		return false;
	}
}