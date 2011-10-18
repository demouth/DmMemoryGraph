<?php
require_once dirname(__FILE__).'/DmGraphics.php';

abstract class DmGraphDrawer
{
	
	public $padding = array(
		"top"    => 20,
		"left"   => 50,
		"right"  => 50,
		"bottom" => 30,
	);
	
	public $minX;
	public $minY;
	public $maxX;
	public $maxY;
	
	abstract public function draw(DmGraphics $graphics , $dataList);
	
}