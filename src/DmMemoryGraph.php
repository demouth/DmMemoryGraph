<?php
require_once dirname(__FILE__).'/DmMemoryWatcher.php';
require_once dirname(__FILE__).'/DmGraph.php';
require_once dirname(__FILE__).'/DmImage.php';

/**
 * DmMemoryGraph
 * メモリを観測し、最終的にグラフとして出力できるデータを返すクラスです。
 * 
 * @example
 * DmMemoryGraph::watch();
 * something();
 * DmMemoryGraph::watch();
 * something();
 * DmMemoryGraph::watch();
 * $uri = DmMemoryGraph::toDataSchemeURI(500,300);
 * <img src="<?=$uri?>" />
 * 
 * @version 0.2.0
 * @author demouth
 */
class DmMemoryGraph
{
	
	/**
	 * @var DmMemoryGraph
	 */
	protected static $instance;
	
	/**
	 * コンストラクタ。
	 */
	public function __construct()
	{
		
	}
	
	/**
	 * シングルトンインスタンス取得。
	 * @return DmMemoryGraph
	 */
	public static function getInstance()
	{
		if (!self::$instance){
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	/**
	 * 観測地点を追加する。
	 * @param string グラフに貼るラベル名
	 * @return void
	 */
	public static function watch($label="")
	{
		DmMemoryWatcher::watch($label);
	}
	
	/**
	 * データスキーマURIへ変換する。
	 * imgタグのsrc属性にこのメソッドの戻り値を入れる。
	 * 
	 * @param int グラフの横幅(px)
	 * @param int グラフの高さ(px)
	 * @return string データスキーマURI
	 */
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
	
	/**
	 * TEMP画像の保存先を指定する。
	 * このメソッドを呼ばない場合、このライブラリ配置先と同階層に作成されます。
	 * 
	 * @param string TEMP画像保存先のフルパス
	 * @return void
	 */
	public static function setTempDirPath($path)
	{
		DmImage::setTempDirPath($path);
	}
	
}