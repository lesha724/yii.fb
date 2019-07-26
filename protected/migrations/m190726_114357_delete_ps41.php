<?php

class m190726_114357_delete_ps41 extends CDbMigration
{
	public function up()
	{
        $sql = <<<SQL
            DELETE from PORTAL_SETTINGS WHERE ps1 = 41
SQL;
        $this->execute($sql);
	}

	public function down()
	{
		echo "m190726_114357_delete_ps41 does not support migration down.\n";
		return false;
	}
}