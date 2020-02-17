<?php

class m150914_164646_portal_settings_37 extends CDbMigration
{
	public function safeUp()
	{
        //минимальный удов. бал в журнале
        $sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(37, '0');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150914_164646_portal_settings_37 does not support migration down.\\n";
		return false;
	}
}