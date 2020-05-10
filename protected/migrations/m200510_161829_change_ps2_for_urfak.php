<?php

class m200510_161829_change_ps2_for_urfak extends CDbMigration
{
	public function up()
	{
	    if(Yii::app()->core->universityCode != U_URFAK)
	        return;

        $sql = <<<SQL
            alter table portal_settings  ALTER COLUMN ps2 TYPE VARCHAR(2000)
SQL;
        $this->execute($sql);
	}

	public function down()
	{
		echo "m200510_161829_change_ps2_for_urfak does not support migration down.\n";
		return false;
	}
}