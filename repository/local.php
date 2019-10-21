<?
class repository_local 
{
	public static function tglEngToIndo($tanggal){
		list($thn,$bln,$tgl) = explode("-",$tanggal);
		return  $tanggal = "$tgl-$bln-$thn";
	}
	public static function dateEnglish($tanggal){
		list($tgl,$bln,$thn) = explode("-",$tanggal);
		return  $tanggal = "$thn-$bln-$tgl";
	}
}
?>