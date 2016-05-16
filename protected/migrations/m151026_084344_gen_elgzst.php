<?php

class m151026_084344_gen_elgzst extends CDbMigration
{
	public function safeUp()
	{
		$b15 = $this->getDBConnection()->createCommand(<<<SQL
			select b15 from b where b1=0
SQL
		)->queryScalar();

		if($b15!=6) {
			$sql = <<<SQL
          CREATE SEQUENCE GEN_ELGZST;
SQL;
			$this->execute($sql);
		}
	}

	public function safeDown()
	{
		echo "m151026_084344_gen_elgzst does not support migration down.\\n";
		return false;
	}
}