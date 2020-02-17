<?php

class m140906_082819_portal_settings_27 extends CDbMigration
{
    public function safeUp()
    {
        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(27, '');
SQL;

        $this->execute($sql);
    }

	public function safeDown()
	{
		echo "m140906_082819_portal_settings_27 does not support migration down.\\n";
		return false;
	}
}