<?php

require_once '../src/DmMemoryGraph.php';

$cacheArray = array();
DmMemoryGraph::watch();
sleep(1);
while (rand(1,500)!==1) { $cacheArray[] = ""; }
DmMemoryGraph::watch();
sleep(1);
while (rand(1,5000)!==1) { $cacheArray[] = ""; }
DmMemoryGraph::watch();
sleep(1);
while (rand(1,500)!==1) { $cacheArray[] = ""; }
DmMemoryGraph::watch();
sleep(2);
while (rand(1,2000)!==1) { $cacheArray[] = ""; }
DmMemoryGraph::watch('label1');
sleep(3);
while (rand(1,500)!==1) { $cacheArray[] = ""; }
DmMemoryGraph::watch();
sleep(1);
while (rand(1,500)!==1) { $cacheArray[] = ""; }
DmMemoryGraph::watch();
sleep(1);
while (rand(1,500)!==1) { $cacheArray[] = ""; }
DmMemoryGraph::watch('label2');
sleep(1);
while (rand(1,3000)!==1) { $cacheArray[] = ""; }
DmMemoryGraph::watch();
sleep(1);
while (rand(1,500)!==1) { $cacheArray[] = ""; }

DmMemoryGraph::watch();

$schemeUri = DmMemoryGraph::toDataSchemeURI(500,300);



?>
<!DOCTYPE html>
<html>
<head>
	<title>DmMemoryGraph example</title>
	<meta charset="UTF-8" />
</head>
<body>
	<img src="<?=$schemeUri?>" />
</body>
</html>
