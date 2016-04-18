<?php

class m160418_093448_ps73_74 extends CDbMigration
{
	public function safeUp()
	{
		/*Отображать для студиков карточку стедента*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(73, 0);
SQL;
		$this->execute($sql);

		/*Отображать для родителей карточку студента*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(74, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160418_093448_ps73_74 does not support migration down.\\n";
		return false;
	}
}