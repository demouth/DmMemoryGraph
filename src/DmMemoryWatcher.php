<?php
require_once dirname(__FILE__).'/DmGraphData.php';

/**
 * DmMemoryWatcher
 * シングルトンクラスです。
 * メモリ観測を担当するクラスです。
 * 
 * @author demouth
 */
class DmMemoryWatcher
{
	
	/**
	 * @var DmMemoryWatcher
	 */
	protected static $instance;
	
	/**
	 * 観測地点リスト。
	 * @var array
	 */
	protected $watchedList = array();
	
	/**
	 * 観測開始時刻。
	 * @var string
	 */
	protected $startTime;
	
	/**
	 * コンストラクタ。
	 */
	public function __construct()
	{
		$this->startTime = microtime(true);
	}
	
	/**
	 * シングルトンインスタンス取得。
	 * @return DmMemoryWatcher
	 */
	public static function getInstance()
	{
		if (!self::$instance){
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	protected function _watch($label="")
	{
		
		$this->watchedList[] = array(
			'memory' => (int)(memory_get_usage() / 1000) ,
			'peakMemory' => (int)(memory_get_peak_usage() / 1000) ,
			'time' => number_format(microtime(true) - $this->startTime , 5),
			'label' => $label
		);
		
	}
	
	/**
	 * 観測地点を追加する。
	 * @param string グラフに貼るラベル名
	 * @return void
	 */
	public static function watch($label="")
	{
		self::getInstance()->_watch($label);
	}
	
	/**
	 * DmGraphData形式へ変換して配列で返す。
	 * 観測地点のメモリを返す。
	 * @return DmGraphData[]
	 */
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
	
	/**
	 * DmGraphData形式へ変換して配列で返す。
	 * ピークメモリを返す。
	 * @return DmGraphData[]
	 */
	public function peakToGraphDataList()
	{
		$dataList = array();
		$watchedList = $this->watchedList;
		foreach ($watchedList as $value) {
			$data = new DmGraphData();
			$data->y = $value["peakMemory"];
			$data->x = $value["time"];
			$data->label = $value["label"];
			$dataList[] = $data;
		}
		return $dataList;
	}
	
}
