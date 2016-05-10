<?php

class m160510_175333_create_markb extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			CREATE TABLE MARKB (
				MARKB1  INTE NOT NULL /* ключ*/,
				MARKB2  DOUB /* нижняя граница балов в 5 системе*/,
				MARKB3  DOUB /* соотс=ветвующие балі в многобальной */
			);
SQL;
		$this->execute($sql);

		$sql = <<<SQL
			ALTER TABLE MARKB ADD CONSTRAINT PK_MARKB PRIMARY KEY (MARKB1);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160510_175333_create_markb does not support migration down.\\n";
		return false;
	}
}