<?php

class m150730_085129_pm_table extends CDbMigration
{
	public function safeUp()
	{
            $sql = <<<SQL
                CREATE TABLE PM (
                    PM1  inte_not_null PRIMARY KEY, /*'первичный ключ*/
                    PM2  VAR100, /*навзвание укр*/
                    PM3  VAR100, /*навзвание рус*/
                    PM4  VAR100, /*навзвание анг*/
                    PM5  VAR100, /*навзвание другой*/
                    PM6  VAR250, /*url*/
                    PM7  SMAL, /*видимость*/
                    PM8  SMAL, /*открывать в новой вкладке*/
                    PM9  INTE, /*приоритет*/
                    PM10  VAR20); /*контроллер*/
SQL;
            $this->execute($sql);
            $sql = <<<SQL
                CREATE SEQUENCE GEN_PM;
SQL;
            $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150730_085129_pm_table does not support migration down.\\n";
		return false;
	}
}