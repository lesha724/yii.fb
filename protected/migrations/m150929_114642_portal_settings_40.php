<?php

class m150929_114642_portal_settings_40 extends CDbMigration
{
	public function safeUp()
	{
        //количетсво дней на редактирование отработок
        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(40, '0');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150929_114642_portal_settings_40 does not support migration down.\\n";
		return false;
	}
}