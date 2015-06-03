<?php

class m140707_165444_aap_changes extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
ALTER TABLE AAP DROP CONSTRAINT FK_AAP55_DA1
SQL;
		$this->execute($sql);

        $sql = <<<SQL
ALTER TABLE aap
    ALTER COLUMN aap55 TYPE SMALLINT;
SQL;
        $this->execute($sql);

        $sql = <<<SQL
ALTER TABLE aapes
    ALTER COLUMN AAPES4 TYPE VARCHAR(15),
    ALTER COLUMN AAPES5 TYPE DOUBLE PRECISION,
    ALTER COLUMN AAPES6 TYPE SMALLINT,
    ALTER COLUMN AAPES7 TYPE SMALLINT
SQL;
        $this->execute($sql);

	}

	public function safeDown()
	{
		echo "m140707_165444_aap_changes does not support migration down.\\n";
		return false;
	}
}