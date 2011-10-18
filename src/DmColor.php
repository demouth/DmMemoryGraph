<?php


/**
 * 
 * Example 1:
 * $color = new DmColor();
 * $color->r(255)->g(100)->b(50);
 * echo $color->g(); // 100
 * 
 * Example 2:
 * DmColor::rgb(0xFF0066);
 * echo $color->r(); // 255
 * 
 */
class DmColor
{
	
	protected $_r = 0;
	protected $_g = 0;
	protected $_b = 0;
	protected $_a = 0;
	
	protected $_h;
	protected $_s;
	protected $_v;
	
	public function __construct()
	{
		
	}
	
	public function __call($name, $arguments)
	{
		$colorFunctions = array("r","g","b","a");
		if (in_array($name, $colorFunctions)){
			$varName = "_".$name;
			if(count($arguments)>0){
				$this->{$varName} = $arguments[0];
				return $this;
			}else{
				return $this->{$varName};
			}
		}
		
	}
	
	/**
	 * 
	 * @param int 
	 * @return self
	 */
	public static function rgb($rgb)
	{
		$r = $rgb >> 16;
		$g = ($rgb >> 8) & 0xFF;
		$b = $rgb & 0xFF;
		$self = new self();
		return $self->r($r)->g($g)->b($b);
	}
	
	
	/**
	 * 
	 * 
	 * @return int
	 */
	public function getColorId($imageResource)
	{
		
		return imagecolorallocate(
			$imageResource,
			$this->_r,
			$this->_g,
			$this->_b
		);
		
	}
	
}