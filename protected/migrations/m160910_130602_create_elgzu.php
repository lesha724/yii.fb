<?php

class m160910_130602_create_elgzu extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			CREATE TABLE ELGZU (
				ELGZU1  INTE_NOT_NULL NOT NULL /* ключ */,
				ELGZU2  INTE_NOT_NULL /* gr1 */,
				ELGZU3  INTE_NOT_NULL /* elgz1 */,
				ELGZU4  INTE_NOT_NULL /* ustem1 */,
				ELGZU5 dat DEFAULT 'NOW' NOT NULL/* дата корректировки */,
                ELGZU6  inte/* кто корректировал p1 */
			);
SQL;
		$this->execute($sql);

		$sql = <<<SQL
			ALTER TABLE ELGZU ADD CONSTRAINT PK_ELGZU PRIMARY KEY (ELGZU1);
SQL;
		$this->execute($sql);

		$sql = <<<SQL
			ALTER TABLE ELGZU ADD CONSTRAINT FK_ELGZU_GR1 FOREIGN KEY (ELGZU2) REFERENCES GR(GR1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
		$this->execute($sql);

		$sql = <<<SQL
			ALTER TABLE ELGZU ADD CONSTRAINT FK_ELGZU_ELGZ1 FOREIGN KEY (ELGZU3) REFERENCES ELGZ(ELGZ1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
		$this->execute($sql);

		$sql = <<<SQL
			ALTER TABLE ELGZU ADD CONSTRAINT FK_ELGZU_USTEM1 FOREIGN KEY (ELGZU4) REFERENCES USTEM(USTEM1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
		$this->execute($sql);

		$sql = <<<SQL
			CREATE SEQUENCE GEN_ELGZU;
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160910_130602_create_elgzu does not support migration down.\\n";
		return false;
	}
}