<?php
require_once dirname(__FILE__).'/DmGraphics.php';

/**
 * DmGraphDrawer
 * グラフを描画するクラスの抽象クラス。
 * 
 * @author demouth
 */
abstract class DmGraphDrawer
{
	
	/**
	 * @var assoc
	 */
	public $padding = array(
		"top"    => 20,
		"left"   => 50,
		"right"  => 50,
		"bottom" => 30,
	);
	
	/**
	 * @var int
	 */
	public $minX;
	
	/**
	 * @var int
	 */
	public $minY;
	
	/**
	 * @var int
	 */
	public $maxX;
	
	/**
	 * @var int
	 */
	public $maxY;
	
	/**
	 * 描画する。
	 * 
	 * @param DmGraphics
	 * @param DmGraphData[]
	 */
	abstract public function draw(DmGraphics $graphics , $dataList);
	
}