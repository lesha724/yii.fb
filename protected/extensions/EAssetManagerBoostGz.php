<?php

class EAssetManagerBoostGz extends EAssetManagerBoost
{
	public $gzLevel = 9;

	/**
	 * Custom copy file to gzip files
	 * @param string $src the full path of the file to read from
	 * @param string $dstFile the full path of the file to write to
	 */
	public function copyFile($src, $dstFile)
	{
		parent::copyFile($src, $dstFile);

		$ext = strtolower(substr(strrchr($src, '.'), 1));

		if ($ext === 'js' || $ext === 'css') {
			$str = @file_get_contents($dstFile);
			if ($str !== false) {
				Yii::trace('copyFile GZ Compressing: ' . $src, 'EAssetManagerBoost');
				$gzStr = gzencode($str, $this->gzLevel);
				
				if (strlen($gzStr) < strlen($str))
					@file_put_contents($dstFile . '.gz', $gzStr);
			}
		}
	}
}
