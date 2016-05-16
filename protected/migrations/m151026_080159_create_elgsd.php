<?php

class m151026_080159_create_elgsd extends CDbMigration
{
	public function safeUp()
	{
		$b15 = $this->getDBConnection()->createCommand(<<<SQL
			select b15 from b where b1=0
SQL
		)->queryScalar();

		if($b15!=6) {
			$sql = <<<SQL
            /* Электронный журнал справочник дополнительных колонок */
            CREATE TABLE elgsd (
               elgsd1 inte_not_null PRIMARY KEY,  /*первичный ключ */
               elgsd2 var25, /* название доп.поля */
               elgsd3 smal); /* 0-по умолчанию добавлять во все журналы       1-нет */
SQL;
			$this->execute($sql);
		}
	}

	public function safeDown()
	{
		echo "m151026_080159_create_elgsd does not support migration down.\\n";
		return false;
	}
}