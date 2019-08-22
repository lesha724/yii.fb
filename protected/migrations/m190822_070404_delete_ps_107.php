<?php

class m190822_070404_delete_ps_107 extends CDbMigration
{
	public function up()
	{
        $sql = <<<SQL
            DELETE from PORTAL_SETTINGS WHERE ps1 = 107
SQL;
        $this->execute($sql);
	}

	public function down()
	{
		echo "m190822_070404_delete_ps_107 does not support migration down.\n";
		return false;
	}
}