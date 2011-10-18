<?php
require_once dirname(__FILE__).'/DmGraphData.php';


class DmMemoryWatcher
{
	
	protected static $instance;
	protected $watchedList = array();
	protected $startTime;
	
	public function __construct()
	{
		$this->startTime = microtime(true);
	}
	
	public static function getInstance()
	{
		if (!self::$instance){
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public function _watch($label="")
	{
		
		$this->watchedList[] = array(
			'memory' => (int)(memory_get_usage() / 1000) ,
			'time' => number_format(microtime(true) - $this->startTime , 5),
			'label' => $label
		);
		
	}
	
	public static function watch($label="")
	{
		self::getInstance()->_watch($label);
	}
	
	public function toGraphDataList()
	{
		$dataList = array();
		$watchedList = $this->watchedList;
		foreach ($watchedList as $value) {
			$data = new DmGraphData();
			$data->y = $value["memory"];
			$data->x = $value["time"];
			$data->label = $value["label"];
			$dataList[] = $data;
		}
		return $dataList;
	}
	
}
