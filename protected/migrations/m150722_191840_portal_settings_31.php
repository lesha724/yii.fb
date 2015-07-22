<?php

class m150722_191840_portal_settings_31 extends CDbMigration
{
	public function safeUp()
	{
            //скріть Приоритет в Абитуриент/рейтинговій список
            $sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(31, '0');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150722_191840_portal_settings_31 does not support migration down.\\n";
		return false;
	}
}