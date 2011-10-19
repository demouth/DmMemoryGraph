<?php
require_once dirname(__FILE__).'/DmImage.php';
require_once dirname(__FILE__).'/DmGraphBackgroundDrawer.php';
require_once dirname(__FILE__).'/DmGraphDataDrawer.php';

class DmGraph
{
	
	protected $image;
	protected $dataLists = array();
	
	public function __construct($width , $height)
	{
		
		$image = new DmImage($width,$height,0xFFFFFF);
		
		$this->image = $image;
		
	}
	
	public function push($dataList)
	{
		$this->dataLists[] = $dataList;
	}
	
	public function set($dataList)
	{
		$this->dataLists = array($dataList);
	}
	
	public function draw($note="")
	{
		$minX = null;
		$minY = null;
		$maxX = null;
		$maxY = null;
		foreach ($this->dataLists as $dataList) {
			foreach ($dataList as $data) {
				if (is_null($minX)){
					$minX = $data->x;
					$minY = $data->y;
					$maxX = $data->x;
					$maxY = $data->y;
				}
				if ($minX > $data->x) $minX = $data->x;
				if ($minY > $data->y) $minY = $data->y;
				if ($maxX < $data->x) $maxX = $data->x;
				if ($maxY < $data->y) $maxY = $data->y;
			}
		}
		
		$background = new DmGraphBackgroundDrawer();
		$background->minX = $minX;
		$background->minY = $minY;
		$background->maxX = $maxX;
		$background->maxY = $maxY;
		$background->note = $note;
		$background->draw($this->image->graphics , $this->dataLists);
		
		$graph = new DmGraphDataDrawer();
		$graph->minX = $minX;
		$graph->minY = $minY;
		$graph->maxX = $maxX;
		$graph->maxY = $maxY;
		$graph->draw($this->image->graphics , $this->dataLists);
		
	}
	
	public function toDataSchemeURI()
	{
		return $this->image->toDataSchemeURI();
	}
	
}