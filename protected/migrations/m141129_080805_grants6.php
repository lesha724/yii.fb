<?php

class m141129_080805_grants6 extends CDbMigration
{
	public function safeUp()
	{
        $sql = <<<SQL
alter table grants add grants6 smal;    /* экз сессия 0-только к своим 1-ко всем на кафедре*/
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m141129_080805_grants6 does not support migration down.\\n";
		return false;
	}
}