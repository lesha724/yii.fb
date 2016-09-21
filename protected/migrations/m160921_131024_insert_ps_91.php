<?php

class m160921_131024_insert_ps_91 extends CDbMigration
{
	public function safeUp()
	{
		/*показывать таб общая информация в карточке студента*/
		$sql = <<<SQL
		insert into PORTAL_SETTINGS(PS1, PS2) values(91, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160921_131024_insert_ps_91 does not support migration down.\\n";
		return false;
	}
}