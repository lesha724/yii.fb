<?php

class m190830_103050_insert_ps_144 extends CDbMigration
{
	public function up()
	{
        /*
         * максимальная оценка в опросе
         */
        $sql = <<<SQL
            insert into PORTAL_SETTINGS(PS1, PS2) values(144, 5);
SQL;
        $this->execute($sql);
	}

	public function down()
	{
		echo "m190830_103050_insert_ps_144 does not support migration down.\n";
		return false;
	}
}