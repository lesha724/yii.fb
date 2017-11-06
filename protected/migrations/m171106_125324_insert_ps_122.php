<?php

class m171106_125324_insert_ps_122 extends CDbMigration
{
	public function safeUp()
	{
        /**
         * Синхронизация с дистанционным образованием
         * 0-нет, 1 - да
         */
        $sql = <<<SQL
            insert into PORTAL_SETTINGS(PS1, PS2) values(122, 0);
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m171106_125324_insert_ps_122 does not support migration down.\\n";
		return false;
	}
}