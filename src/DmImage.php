<?php

require_once dirname(__FILE__).'/DmColor.php';

class DmImage
{
	
	/**
	 * @var resource
	 */
	protected $_imageResource;
	
	/**
	 * @var DmGraphics
	 */
	public $graphics;
	
	/**
	 * @var int
	 */
	protected $_width;
	
	/**
	 * @var int
	 */
	protected $_height;
	
	/**
	 * 
	 * @var string
	 */
	protected static $_tempDirPath = "";
	
	public function __construct($width , $height , $backgroundColor=0)
	{
		
		$imageResource = imagecreate($width, $height);
		//背景色設定
		DmColor::rgb($backgroundColor)->getColorId($imageResource);
		
		$this->_imageResource = $imageResource;
		
		$this->graphics = new DmGraphics($imageResource , $width , $height);
		
		$this->_width = $width;
		$this->_height = $height;
		
	}
	
	/**
	 * @return resource
	 */
	public function getImageResource()
	{
		return $this->_imageResource;
	}
	
	/**
	 * Output a PNG image to either the browser.
	 * The raw image stream will be outputted directly.
	 */
	public function display()
	{
		header('Content-type: image/png');
		imagepng($this->_imageResource , null , 5 );
	}
	
	/**
	 * The path to save the file to.
	 * @param string
	 * @param string filetype
	 * @return bool
	 */
	public function saveTo($path , $type="png")
	{
		if (!$path) return false;
		switch ($type) {
			case 'png':
				imagepng($this->_imageResource , $path , 5 );
				break;
			
			default:
				imagepng($this->_imageResource , $path , 5 );
				break;
		}
		return true;
	}
	
	/**
	 * Destroy an image.
	 */
	public function destroy()
	{
		imagedestroy($this->_imageResource);
		$this->graphics->destory();
		$this->graphics = null;
	}
	
	/**
	 * Return data scheme URI.
	 * 
	 * Example:
	 *   data:image/png;base64,iVBORw0KGgoAAAANSUhEU...
	 * @return string 
	 */
	public function toDataSchemeURI()
	{
		$time = (int)(microtime(1)*10000);
		$filePath = self::tempDirPath() . PATH_SEPARATOR . "temp" . PATH_SEPARATOR . "temp".$time.".png";
		$this->saveTo($filePath);
		
		$uri = 'data:' . mime_content_type($filePath) . ';base64,';
		$uri .= base64_encode(file_get_contents($filePath));
		
		unlink($filePath);
		
		return $uri;
	}
	
	protected static function tempDirPath()
	{
		if(self::$_tempDirPath===""){
			return dirname(__FILE__);
		}else{
			return self::$_tempDirPath;
		}
	}
	
	public static function setTempDirPath($path)
	{
		self::$_tempDirPath = $path;
	}
	
}