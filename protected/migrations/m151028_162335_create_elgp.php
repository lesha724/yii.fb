<?php

class m151028_162335_create_elgp extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
CREATE TABLE elgp(
  elgp0  inte_not_null PRIMARY KEY, /*'первичный ключ*/
  elgp1 inte, /* код elgzst0 */
  elgp2 smal,  /*тип пропуска 1-без відробок, 2-по хворобі ,3-чергування,4-інше, 5-по оплате   */
  elgp3 var20, /* пояснение пропуска, № справки например */
  elgp4 var20, /* номер квитанции для STEGNP2=5(по оплате)*/
  elgp5 dat, /* дата квитанции для STEGNP2=5(по оплате)*/
  elgp6 dat DEFAULT 'NOW' NOT NULL, /* дата корректировки */
  elgp7 inte); /* кто корректировал p1 */
SQL;
		$this->execute($sql);
        $sql = <<<SQL
ALTER TABLE elgp ADD constraint FK_elgp1_elgzst0 FOREIGN KEY (elgp1) REFERENCES elgzst (elgzst0) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
ALTER TABLE elgp ADD constraint FK_elgp7_p1 FOREIGN KEY (elgp7) REFERENCES p (p1) ON DELETE SET DEFAULT ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
CREATE SEQUENCE GEN_elgp;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151028_162335_create_elgp does not support migration down.\\n";
		return false;
	}
}