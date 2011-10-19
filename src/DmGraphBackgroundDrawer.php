<?php

require_once dirname(__FILE__).'/DmGraphDrawer.php';
require_once dirname(__FILE__).'/DmGraphics.php';

class DmGraphBackgroundDrawer extends DmGraphDrawer
{
	
	public $note;
	
	public function draw(DmGraphics $graphics , $dataLists)
	{
		
		$graphics->lineStyle(3,0xBBBBBB);
		
		$PT = $this->padding['top'];
		$PB = $this->padding['bottom'];
		$PL = $this->padding['left'];
		$PR = $this->padding['right'];
		$W = $graphics->getWidth()  - $PL - $PR;
		$H = $graphics->getHeight() - $PT - $PB;
		
		$graphics
			->moveTo($PL, $PT)
			->lineTo($PL+$W , $PT)
			->moveTo($PL, $PT+$H)
			->lineTo($PL+$W , $PT+$H)
			->moveTo($PL, $PT)
			->lineTo($PL, $PT+$H)
			->moveTo($PL+$W, $PT)
			->lineTo($PL+$W, $PT+$H)
			
			->textStyle(2,0x666666)
			->textTo(0,$PT+$H, $this->minY)
			->textTo(0,$PT, $this->maxY)
			->textTo($PL,$PT+$H, $this->minX)
			->textTo($PL+$W,$PT+$H, $this->maxX);
		
		$graphics
			->textStyle(2,0x666666)
			->textTo(0,0, $this->note);
			
		$strlen = strlen($this->maxY - $this->minY);
		$splitLine = pow(10 , $strlen - 1);
		$graphics
			->textStyle(2,0x666666)
			->lineStyle(1,0xBBBBBB);
		for ($i=0; $i < $this->maxY; $i+=$splitLine) { 
			$y = ($i - $this->minY) / ($this->maxY - $this->minY) * -$H + $H + $PT;
			
			$graphics
				->moveTo($PL, $y)
				->lineTo($PL+$W, $y)
				->textTo(0,$y, $i);
		}
		
		$graphics
			->lineStyle(2,0x66CC33)
			->textStyle(2,0x66CC33);
			
		foreach ($dataLists as $dataList) {
			foreach ($dataList as $data) {
				if ($data->label === "") continue; 
				$x = ($data->x - $this->minX) / ($this->maxX - $this->minX) * $W + $PL;
				
				$graphics
					->moveTo($x, $PT)
					->lineTo($x, $PT+$H)
					->textTo($x, $PT+$H, $data->x)
					->textTo($x, $PT+$H+10, $data->label);
					
			}
		}
		
	}
	
}