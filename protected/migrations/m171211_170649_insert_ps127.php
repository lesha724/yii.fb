<?php

class m171211_170649_insert_ps127 extends CDbMigration
{
	public function safeUp()
	{
        /**
         * Текст email после регистрации на дист. образовании
         */
        $sql = <<<SQL
            insert into PORTAL_SETTINGS(PS1, PS2) values(127, '');
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m171211_170649_insert_ps127 does not support migration down.\\n";
		return false;
	}
}