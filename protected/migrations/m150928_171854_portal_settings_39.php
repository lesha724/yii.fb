<?php

class m150928_171854_portal_settings_39 extends CDbMigration
{
	public function safeUp()
	{
        //текст закрытия на тех работы
        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(39, '');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150928_171854_portal_settings_39 does not support migration down.\\n";
		return false;
	}
}