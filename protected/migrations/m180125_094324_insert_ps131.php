<?php

class m180125_094324_insert_ps131 extends CDbMigration
{
	public function safeUp()
	{
        /**
         * шаблон письма об регистрации на курсе
         */
        $sql = <<<SQL
            insert into PORTAL_SETTINGS(PS1, PS2) values(131, '');
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m180125_094324_insert_ps131 does not support migration down.\\n";
		return false;
	}
}