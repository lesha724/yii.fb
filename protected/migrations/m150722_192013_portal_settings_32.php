<?php

class m150722_192013_portal_settings_32 extends CDbMigration
{
	public function safeUp()
	{
            //скріть Примечание в Абитуриент/рейтинговій список
            $sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(32, '0');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150722_192013_portal_settings_32 does not support migration down.\\n";
		return false;
	}
}