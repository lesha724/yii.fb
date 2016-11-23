<?php

class m161123_130738_insert_ps100 extends CDbMigration
{
	public function safeUp()
	{
		/*выводить время занятие в журнале в заголовке*/
		$sql = <<<SQL
		insert into PORTAL_SETTINGS(PS1, PS2) values(100, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m161123_130738_insert_ps100 does not support migration down.\\n";
		return false;
	}
}