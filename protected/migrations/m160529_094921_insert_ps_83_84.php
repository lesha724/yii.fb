<?php

class m160529_094921_insert_ps_83_84 extends CDbMigration
{
	public function safeUp()
	{
		/*скрывать столбец Итог*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(83, 0);
SQL;
		$this->execute($sql);

		/*запись итоговой в Stus*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(84, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160529_094921_insert_ps_83_84 does not support migration down.\\n";
		return false;
	}
}