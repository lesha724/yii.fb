<?php

class m190313_161803_insert_ps_142 extends CDbMigration
{
	public function up()
	{
        /**
         * Дефолтный екшен
         */
        $sql = <<<SQL
            insert into PORTAL_SETTINGS(PS1, PS2) values(142, '');
SQL;
        $this->execute($sql);
	}

	public function down()
	{
		echo "m190313_161803_insert_ps_141 does not support migration down.\n";
		return false;
	}
}