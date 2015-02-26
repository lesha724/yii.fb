<?php

/**
 * This behavior helps to load script files from scripts folder without entering
 * directory prefixes every time.
 * @property CClientScript $owner
 * @method CClientScript getOwner()
 */
class LocalScriptsBehavior extends CBehavior
{
	public $jsDir  = '$/js/';
	public $cssDir = '$/css/';
	
	public $jsPath  = null;
	public $cssPath = null;
	
	public $publish = false;
	
	public $publishJs  = false;
	public $publishCss = false;
	
	public $hashByName = false;
	
	public function attach($owner)
	{
		if (YII_DEBUG && !$owner instanceof CClientScript)
			throw new CException(__CLASS__ . ' owner must be an instance of CClientScript.');
		
		parent::attach($owner);
		
		if ($this->publish) {
			$this->publishJs  = true;
			$this->publishCss = true;
		}
		
		$this->initPrefix($this->jsPath,  $this->jsDir);
		$this->initPrefix($this->cssPath, $this->cssDir);
	}

	# Register file #
	
	/**
	 * Register script file from your javascripts folder.
	 * @param string $name
	 * @param integer $position
	 * @return CClientScript 
	 */
	public function registerLocalScript($name, $position=0)
	{
		$fileName = $this->publishJs
			? $this->publish($this->jsPath . $name)
			: $this->jsDir . $name;
		
		return $this->getOwner()->registerScriptFile($fileName, $position);
	}
	
	/**
	 * Register css file from your styles folder.
	 * @param string $name
	 * @param string $media
	 * @return CClientScript 
	 */
	public function registerLocalCss($name, $media='')
	{
		$fileName = $this->publishCss
			? $this->publish($this->cssPath . $name)
			: $this->cssDir . $name;
		
		return $this->getOwner()->registerCssFile($fileName, $media);
	}
	
	# Internal #
	
	/**
	 * Calls assetManager to publish asset.
	 * @param string $path the asset (file or directory) to be published
	 * @return string an absolute URL to the published asset
	 */
	protected function publish($path)
	{
		return Yii::app()->getComponent('assetManager')
			->publish($path, $this->hashByName);
	}
	
	/**
	 * Initializes prefix value.
	 * @param string $path directory path alias.
	 * When defined - directory will be published using assetManager.
	 * @param string $dir directory url.
	 * When path is defined this value is ignored.
	 * @return string
	 */
	private function initPrefix(&$path, &$dir)
	{
		if ($path !== null) {
			$path = Yii::getPathOfAlias($path) . '/';
			$dir = $this->publish($path) . '/';

		} else {
			$path = $this->replacePathPlaceholders($dir);
			$dir = $this->replacePlaceholders($dir);
		}
	}
	
	/**
	 * Replace prefix placeholders with calculated values.
	 * @param string $dir
	 * @return string 
	 */
	private function replacePlaceholders($dir)
	{
		if ($dir[0] == '$') {
			$dir = Yii::app()->baseUrl . substr($dir, 1);
		}
		
		return $dir;
	}
	
	/**
	 * Replace prefix placeholders with calculated values.
	 * @param string $dir
	 * @return string 
	 */
	private function replacePathPlaceholders($dir)
	{
		if ($dir[0] == '$') {
			$dir = Yii::getPathOfAlias('webroot') . substr($dir, 1);
		}
		
		return $dir;
	}
}