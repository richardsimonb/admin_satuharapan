<?php
/* CountDown PHP class
 * Made by Angelo Geels 2010
 * http://angelog.nl/
 */
class CountDown{
	public $finished = "Countdown reached!";
	public $format = "{W} week{Ws}, {D} day{Ds}, {H} hour{Hs} and {M} minute{Ms} left";
	
	function Give($hour,$minute,$second,$month,$day,$year,$print = false){
		$date = mktime($hour,$minute,$second,$month,$day,$year);
		$timeleft = $date - time();
		if($timeleft<0){
			if($print)
				echo $this->finished;
			else
				return $this->finished;
		}else{
			$w = floor((($timeleft / 3600) / 24) / 7);
			$ws = ($w==1) ? "" : "s";
			$d = floor(($timeleft / 3600) / 24) - $w * 7;
			$ds = ($d==1) ? "" : "s";
			$h = floor($timeleft / 3600) - floor(($timeleft / 3600) / 24) * 24;
			$hs = ($h==1) ? "" : "s";
			$m = floor($timeleft / 60) - floor($timeleft / 3600) * 60;
			$ms = ($m==1) ? "" : "s";
			$out = $this->format;
			$find = array("{W}","{Ws}","{D}","{Ds}","{H}","{Hs}","{M}","{Ms}");
			$replace = array($w,$ws,$d,$ds,$h,$hs,$m,$ms);
			$out = str_replace($find,$replace,$out);
			if($print)
				echo $out;
			else
				return $out;
		}
	}
}
?>