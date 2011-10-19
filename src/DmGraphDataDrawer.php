<?php
require_once dirname(__FILE__).'/DmGraphDrawer.php';
require_once dirname(__FILE__).'/DmGraphics.php';

class DmGraphDataDrawer extends DmGraphDrawer
{
	
	public function draw(DmGraphics $graphics , $dataLists)
	{
		$loop = 0;
		foreach ($dataLists as $dataList) {
			
			$l = count($dataList);
			if($loop===0){
				$graphics->lineStyle(1,0x000000);
			}else{
				$graphics->lineStyle(1,0xFF0000);
			}
			
			$PT = $this->padding['top'];
			$PB = $this->padding['bottom'];
			$PL = $this->padding['left'];
			$PR = $this->padding['right'];
			$W = $graphics->getWidth()  - $PL - $PR;
			$H = $graphics->getHeight() - $PT - $PB;
			
			for ($i=0;$i<$l;$i++) {
				$data = $dataList[$i];
				$x = $W * $i / ($l-1) + $PL;
				$x = ($data->x - $this->minX) / ($this->maxX - $this->minX) * $W + $PL;
				$y = ($data->y - $this->minY) / ($this->maxY - $this->minY) * -$H + $H + $PT;
				if ($i==0){
					$graphics->moveTo($x, $y);
				}else{
					$graphics->lineTo($x, $y);
				}
				
			}
			$loop++;
		}
	}
	
}