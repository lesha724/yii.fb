<?php

class m171113_084345_insert_ps_126 extends CDbMigration
{
	public function safeUp()
	{
        /**
         * Текст сообщения для ошибки записи
         */
        $sql = <<<SQL
            insert into PORTAL_SETTINGS(PS1, PS2) values(126, '');
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m171113_084345_insert_ps_126 does not support migration down.\\n";
		return false;
	}
}