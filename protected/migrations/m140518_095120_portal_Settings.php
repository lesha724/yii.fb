<?php

class m140518_095120_portal_Settings extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(21, '');
SQL;
		$this->execute($sql);
        $sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(22, '');
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m140518_095120_portal_Settings does not support migration down.\\n";
		return false;
	}
}