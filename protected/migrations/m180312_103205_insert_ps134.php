<?php

class m180312_103205_insert_ps134 extends CDbMigration
{
	public function safeUp()
	{
        /**
         * Шаблон пиьсма для подтвреждения почты для регистрации в дист образовании
         */
        $sql = <<<SQL
            insert into PORTAL_SETTINGS(PS1, PS2) values(134, '');
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m180312_103205_insert_ps134 does not support migration down.\\n";
		return false;
	}
}