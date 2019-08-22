<?php

class m190822_065513_insert_ps_143 extends CDbMigration
{
    public function safeUp()
    {
        /*
         * показывать ссылку на счет (юрфак)
         */
        $sql = <<<SQL
            insert into PORTAL_SETTINGS(PS1, PS2) values(143, 0);
SQL;
        $this->execute($sql);
    }

	public function down()
	{
		echo "m190822_065513_insert_ps_143 does not support migration down.\n";
		return false;
	}
}