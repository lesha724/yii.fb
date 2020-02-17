<?php

class m150626_172259_create_stegno extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
/* История отработок занятий */
CREATE TABLE stego (stego1 inte, /* код stegn0 */
  stego2 doub,  /* оценки (от 1 и до ...) */
  stego3 dat DEFAULT 'NOW' NOT NULL, /* дата отработки */
  stego4 inte);  /* кто принимал P1 */
SQL;
		$this->execute($sql);
                		$sql = <<<SQL
ALTER TABLE stego ADD constraint FK_stego1_stegn0 FOREIGN KEY (stego1) REFERENCES stegn (stegn0) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
		$this->execute($sql);
                		$sql = <<<SQL
ALTER TABLE stego ADD constraint FK_stego4_p1 FOREIGN KEY (stego4) REFERENCES p (p1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150626_172259_create_stegno does not support migration down.\\n";
		return false;
	}
}