<?php

class m140530_130322_fpdd_converting extends CDbMigration
{
	public function safeUp()
	{
        $sql = <<<SQL
        SELECT *
        FROM fpdd
SQL;
        $items = Yii::app()->db->createCommand($sql)->queryAll();

        foreach ($items as $item) {
            $parts   = explode('/', $item['fpdd2']);
            $oldName = end($parts);
            $parts2  = explode('.', $oldName);
            $fpdd1   = $item['fpdd1'];
            $fpdd2   = $item['fpdd2'];

            $sql = <<<SQL
            UPDATE fpdd set fpdd4='{$oldName}', fpdd5='{$oldName}' WHERE fpdd1={$fpdd1} AND fpdd2='{$fpdd2}';
SQL;
            $this->execute($sql);
        }



    }

	public function safeDown()
	{
		echo "m140530_130322_fpdd_converting does not support migration down.\\n";
		return false;
	}
}