<?php

class m180125_095653_insert_ps132 extends CDbMigration
{
	public function safeUp()
	{
        /**
         * шаблон письма об отписки от курса
         */
        $sql = <<<SQL
            insert into PORTAL_SETTINGS(PS1, PS2) values(132, '');
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m180125_095653_insert_ps132 does not support migration down.\\n";
		return false;
	}
}