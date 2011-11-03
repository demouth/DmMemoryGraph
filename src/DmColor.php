<?php


/**
 * DmColor
 * 色を表すクラスです。
 * 
 * @example
 * Example 1:
 * $color = new DmColor();
 * $color->r(255)->g(100)->b(50);
 * echo $color->g(); // 100
 * 
 * Example 2:
 * DmColor::rgb(0xFF0066);
 * echo $color->r(); // 255
 * 
 * @author demouth
 */
class DmColor
{
	
	/**
	 * @var int
	 */
	protected $_r = 0;
	
	/**
	 * @var int
	 */
	protected $_g = 0;
	
	/**
	 * @var int
	 */
	protected $_b = 0;
	
	/**
	 * @var int
	 */
	protected $_a = 0;
	
	
	/**
	 * @var int
	 */
	protected $_h;
	
	/**
	 * @var int
	 */
	protected $_s;
	
	/**
	 * @var int
	 */
	protected $_v;
	
	/**
	 * コンストラクタ。
	 */
	public function __construct()
	{
		
	}
	
	/**
	 * マジックメソッド
	 */
	public function __call($name, $arguments)
	{
		
		//対応するメソッドリスト
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