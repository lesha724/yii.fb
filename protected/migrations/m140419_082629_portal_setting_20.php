<?php

class m140419_082629_portal_setting_20 extends CDbMigration
{
	public function safeUp()
	{
        $sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(20, '0');
SQL;
        $this->execute($sql);

    }

	public function safeDown()
	{
		echo "m140419_082629_portal_setting_20 does not support migration down.\\n";
		return false;
	}
}