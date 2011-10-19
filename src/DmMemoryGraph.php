<?php
require_once dirname(__FILE__).'/DmMemoryWatcher.php';
require_once dirname(__FILE__).'/DmGraph.php';
require_once dirname(__FILE__).'/DmImage.php';

/**
 * DmMemoryGraph
 * 
 * Example:
 * DmMemoryGraph::watch();
 * something();
 * DmMemoryGraph::watch();
 * something();
 * DmMemoryGraph::watch();
 * $uri = DmMemoryGraph::toDataSchemeURI(500,300);
 * <img src="<?=$uri?>" />
 * 
 * @version 0.1.0
 * @author demouth
 */
class DmMemoryGraph
{
	
	protected static $instance;
	
	
	public function __construct()
	{
		
	}
	
	public static function getInstance()
	{
		if (!self::$instance){
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public static function watch($label="")
	{
		DmMemoryWatcher::watch($label);
	}
	
	public static function toDataSchemeURI($width=500,$height=300)
	{
		$dataList = DmMemoryWatcher::getInstance()->toGraphDataList();
		$peakDataList = DmMemoryWatcher::getInstance()->peakToGraphDataList();
		$graph = new DmGraph($width,$height);
		$graph->push($dataList);
		$graph->push($peakDataList);
		$graph->draw("X:time(seconds) , Y:memory(kilo bytes)");
		return $graph->toDataSchemeURI();
	}
	
	public static function setTempDirPath($path)
	{
		DmImage::setTempDirPath($path);
	}
	
}