<?php

class m171220_162352_alter_u13 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
          ALTER TABLE USERS ADD U13 VAR20
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m171220_162352_alter_u13 does not support migration down.\\n";
		return false;
	}
}