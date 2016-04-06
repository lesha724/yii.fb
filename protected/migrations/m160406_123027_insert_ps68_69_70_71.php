<?php

class m160406_123027_insert_ps68_69_70_71 extends CDbMigration
{
	public function safeUp()
	{
		/*
		 	антиплагиат
			68 - $LOGIN
			69 - $PASSWORD
			70 - $COMPANY_NAME
			71 - $APICORP_ADDRESS
		*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(68, '');
SQL;
		$this->execute($sql);
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(69, '');
SQL;
		$this->execute($sql);
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(70, '');
SQL;
		$this->execute($sql);
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(71, '');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160406_123027_insert_ps68_69_70_71 does not support migration down.\\n";
		return false;
	}
}