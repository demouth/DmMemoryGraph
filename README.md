DmMemoryGraph version 0.2.0
==========================

実行中のPHPアプリケーションのメモリ使用量をグラフ表示します。   
黒の線が設定した計測地点のメモリ使用量（memory_get_usage）で、赤い線がピークメモリ（memory_get_peak_usage）で、グラフのX軸は経過時間、Y軸はメモリ使用量です。

使い方：   
1. DmMemoryGraph.phpをrequireします。   
2. メモリを計測したい地点にDmMemoryGraph::watch();を書きます。引数を設定するとラベルを貼ることができ、グラフ上に緑色で印がつきます。   
3. メモリの計測が終了したらDmMemoryGraph::toDataSchemeURI(500,300);を呼んでimgタグのsrcに設定する値を取得します。引数の数値は出力される画像サイズですので変更したい場合はこの引数の値を変更します。   
4. 3で取得した値を&lt;img src="&lt;?=$schemeUri?&gt;" /&gt;こんな感じでimgに設定します。  

参考：   
赤い線と黒い線が離れている場合はメモリ計測地点の手前でメモリを消費する処理があり、メモリ計測地点に到達する前にメモリが開放されています。

注意点：   
※GDに依存しています。   
※メモリ監視する処理にメモリを割くので、監視すればするほどメモリが溜まるという問題があるので時間があれば後で直します。


Example
-----

https://demouth.github.io/DmMemoryGraph/

Usage
-----

example1: 

    <?php
       $array = array();
       DmMemoryGraph::watch();
       something1();
       DmMemoryGraph::watch();
       something2();
       DmMemoryGraph::watch();
       $schemeUri = DmMemoryGraph::toDataSchemeURI(500,300);
    ?>
    <img src="<?=$schemeUri?>" />


example2: use label.

    <?php
       $array = array();
       DmMemoryGraph::watch('label1');
       something1();
       DmMemoryGraph::watch('label2');
       something2();
       DmMemoryGraph::watch();
       $schemeUri = DmMemoryGraph::toDataSchemeURI(500,300);
    ?>
    <img src="<?=$schemeUri?>" />

