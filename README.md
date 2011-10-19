DmMemoryGraph version 0.1.0
==========================

メモリ使用量をグラフ表示する。

Example
-----

http://demouth.net/git/dmmemorygraph/

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

