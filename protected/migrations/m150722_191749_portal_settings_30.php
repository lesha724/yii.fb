<?php

class m150722_191749_portal_settings_30 extends CDbMigration
{
	public function safeUp()
	{
            //скріть Учет инд. достижений в Абитуриент/рейтинговій список
            $sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(30, '0');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150722_191749_portal_settings_30 does not support migration down.\\n";
		return false;
	}
}