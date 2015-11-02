<?php

class m151018_100544_alter_ustem_7_10 extends CDbMigration
{
	public function safeUp()
	{
        /* длительность занятия      если USTEM6=1 , то умолчанию автоматически USTEM7=0     и проверка, что сумма всех длительностей <= us6 */
        $sql = <<<SQL
        alter table USTEM add USTEM7 doub DEFAULT 2 NOT NULL;
SQL;
        $this->execute($sql);

        /* нагрузка PD1 */
        $sql = <<<SQL
        alter table USTEM add USTEM10 inte;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151018_100544_alter_ustem_7_10 does not support migration down.\\n";
		return false;
	}
}