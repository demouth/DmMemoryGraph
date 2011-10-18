<?php

require_once dirname(__FILE__).'/DmColor.php';

class DmGraphics
{
	
	protected $_oldX = 0;
	protected $_oldY = 0;
	protected $_lineThickness = 1;
	protected $_lineColor = 0;
	protected $_font=1;
	protected $_fontColor=0;
	protected $_imageResource;
	
	protected $_width;
	protected $_height;
	
	
	public function __construct($imageResource , $width , $height)
	{
		$this->_imageResource = $imageResource;
		$this->_width = $width;
		$this->_height = $height;
	}
	
	public function getWidth()
	{
		return $this->_width;
	}
	
	public function getHeight()
	{
		return $this->_height;
	}
	
	/**
	 * 
	 * return self
	 */
	public function moveTo($x,$y)
	{
		$this->_oldX = $x;
		$this->_oldY = $y;
		return $this;
	}
	
	public function lineTo($x,$y)
	{
		
		$imageResource = $this->_imageResource;
		
		$_x = (int)$x;
		$_y = (int)$y;
		
		imagesetthickness(
			$imageResource,
			$this->_lineThickness
		);
		imageline(
			$imageResource,
			$this->_oldX,
			$this->_oldY,
			$_x,
			$_y,
			DmColor::rgb($this->_lineColor)->getColorId($imageResource)
		);
		
		$this->_oldX = $_x;
		$this->_oldY = $_y;
		return $this;
	}
	
	public function lineStyle($thickness , $color=0)
	{
		$this->_lineThickness = $thickness;
		$this->_lineColor = $color;
		return $this;
	}
	
	public function textStyle($font , $color=0)
	{
		$this->_font = $font;
		$this->_fontColor = $color;
		return $this;
	}
	
	public function textTo($x,$y,$text)
	{
		imagestring(
			$this->_imageResource ,
			$this->_font ,
			$x ,
			$y ,
			$text , 
			DmColor::rgb($this->_fontColor)->getColorId($this->_imageResource)
		);
		return $this;
	}
	
	public function destroy()
	{
		
		
	}
	
}