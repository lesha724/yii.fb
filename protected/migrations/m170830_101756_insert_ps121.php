<?php

class m170830_101756_insert_ps121 extends CDbMigration
{
	public function safeUp()
	{
        /**
         * Отправлять ли отчет по антиплагиату руководтелю
         * 0-нет, 1 - да
         */
        $sql = <<<SQL
            insert into PORTAL_SETTINGS(PS1, PS2) values(121, 0);
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m170830_101756_insert_ps121 does not support migration down.\\n";
		return false;
	}
}