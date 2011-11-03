<?php

require_once dirname(__FILE__).'/DmColor.php';

/**
 * DmGraphics
 * 画像への図形描画等を行う。
 * 
 * @example
 * $graphics
 * 		->moveTo($PL, $PT)
 * 		->lineTo($PL+$W , $PT)
 * 		->moveTo($PL, $PT+$H)
 * 		->lineTo($PL+$W , $PT+$H)
 * 		->moveTo($PL, $PT)
 * 		->lineTo($PL, $PT+$H)
 * 		->moveTo($PL+$W, $PT)
 * 		->lineTo($PL+$W, $PT+$H)
 * 
 * @author demouth
 */
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
	
	/**
	 * コンストラクタ。
	 * @param resource 画像リソース
	 * @param int 画像幅
	 * @param int 画像高さ
	 */
	public function __construct($imageResource , $width , $height)
	{
		$this->_imageResource = $imageResource;
		$this->_width = $width;
		$this->_height = $height;
	}
	
	/**
	 * 画像幅取得。
	 * @return int
	 */
	public function getWidth()
	{
		return $this->_width;
	}
	
	/**
	 * 画像高さ取得。
	 * @return int
	 */
	public function getHeight()
	{
		return $this->_height;
	}
	
	/**
	 * 現在の描画位置を (x, y) に移動します。
	 * @param int X軸(px)
	 * @param int Y軸(px)
	 * @return DmGraphics
	 */
	public function moveTo($x,$y)
	{
		$this->_oldX = $x;
		$this->_oldY = $y;
		return $this;
	}
	
	/**
	 * 現在の描画位置から (x, y) まで、現在の線のスタイルを使用して線を描画します。
	 * その後で、現在の描画位置は (x, y) に設定されます。
	 * @param int X軸(px)
	 * @param int Y軸(px)
	 * @return DmGraphics
	 */
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
	
	/**
	 * 
	 * @param int 線幅(px)
	 * @param int 線色 例:0x00FF99
	 * @return DmGraphics
	 */
	public function lineStyle($thickness , $color=0)
	{
		$this->_lineThickness = $thickness;
		$this->_lineColor = $color;
		return $this;
	}
	
	/**
	 * テキストスタイルを決定する。
	 * @param int latin2 エンコーディングの組み込みのフォントの場合は 1, 2, 3, 4, 5 のいずれか (数字が大きなほうが、より大きいフォントに対応します)、 あるいは imageloadfont() で登録したフォントの識別子のいずれか。
	 * @param int 線色 例:0x00FF99
	 * @return DmGraphics
	 */
	public function textStyle($font , $color=0)
	{
		$this->_font = $font;
		$this->_fontColor = $color;
		return $this;
	}
	
	/**
	 * 文字列を描画する
	 * @param int X軸(px)
	 * @param int Y軸(px)
	 * @param string 文字列
	 * @return DmGraphics
	 */
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
	
	/**
	 * 
	 */
	public function destroy()
	{
		
		
	}
	
}