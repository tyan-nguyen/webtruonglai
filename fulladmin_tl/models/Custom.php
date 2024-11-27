<?php
namespace app\models;
use Yii;

class Custom{
    /**
     * get random string
     * @param number $length
     * @return string
     */
    public function generateRandomString($length = 4) {
        return date('Ymd-His') . '-' . substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
	/**
	 * convert dd/mm/yyyy to Y-m-d
	 */
	public function convertDMYtoYMD($str){
		$date = str_replace('/', '-', $str);
		return date('Y-m-d', strtotime($date));
	}

	/**
	 * convert  Y-m-d to dd/mm/yyyy
	 */
	public function convertYMDHIStoDMYHIS($str){
		return date('d/m/Y H:i:s', strtotime($str));
	}

	/**
	 * convert  Y-m-d H:i:s to Y-m-d
	 */
	public function convertYMDHIStoYMD($str){
	    return date('Y-m-d', strtotime($str));
	}
	
	/**
	 * convert  Y-m-d to dd/mm/yyyy
	 */
	public function convertYMDHIStoDMY($str){
		return date('d/m/Y', strtotime($str));
	}

	/**
	 * convert  dd/mm/yyyy H:i:s to Y-m-d H:i:s
	 */
	public function convertDMYHIStoYMDHIS($str){
		$date = str_replace('/', '-', $str);
		return date('Y-m-d H:i:s', strtotime($date));
	}
	/**
	 * đọc ngày định dạng thứ, ngày tháng năm
	 * doc: https://developers.mynukeviet.net/code/Ham-PHP-hien-thi-thoi-gian-tieng-viet-50/
	 * @return mixed
	 */
	function rebuild_date( $format, $time = 0 )
	{
	    if ( ! $time ) $time = time();

		$lang = array();
		$lang['sun'] = 'CN';
		$lang['mon'] = 'T2';
		$lang['tue'] = 'T3';
		$lang['wed'] = 'T4';
		$lang['thu'] = 'T5';
		$lang['fri'] = 'T6';
		$lang['sat'] = 'T7';
		$lang['sunday'] = 'Chủ nhật';
		$lang['monday'] = 'Thứ hai';
		$lang['tuesday'] = 'Thứ ba';
		$lang['wednesday'] = 'Thứ tư';
		$lang['thursday'] = 'Thứ năm';
		$lang['friday'] = 'Thứ sáu';
		$lang['saturday'] = 'Thứ bảy';
		$lang['january'] = 'Tháng Một';
		$lang['february'] = 'Tháng Hai';
		$lang['march'] = 'Tháng Ba';
		$lang['april'] = 'Tháng Tư';
		$lang['may'] = 'Tháng Năm';
		$lang['june'] = 'Tháng Sáu';
		$lang['july'] = 'Tháng Bảy';
		$lang['august'] = 'Tháng Tám';
		$lang['september'] = 'Tháng Chín';
		$lang['october'] = 'Tháng Mười';
		$lang['november'] = 'Tháng M. một';
		$lang['december'] = 'Tháng M. hai';
		$lang['jan'] = 'T01';
		$lang['feb'] = 'T02';
		$lang['mar'] = 'T03';
		$lang['apr'] = 'T04';
		$lang['may2'] = 'T05';
		$lang['jun'] = 'T06';
		$lang['jul'] = 'T07';
		$lang['aug'] = 'T08';
		$lang['sep'] = 'T09';
		$lang['oct'] = 'T10';
		$lang['nov'] = 'T11';
		$lang['dec'] = 'T12';

	    $format = str_replace( "r", "D, d M Y H:i:s O", $format );
	    $format = str_replace( array( "D", "M" ), array( "[D]", "[M]" ), $format );
	    $return = date( $format, $time );

	    $replaces = array(
	        '/\[Sun\](\W|$)/' => $lang['sun'] . "$1",
	        '/\[Mon\](\W|$)/' => $lang['mon'] . "$1",
	        '/\[Tue\](\W|$)/' => $lang['tue'] . "$1",
	        '/\[Wed\](\W|$)/' => $lang['wed'] . "$1",
	        '/\[Thu\](\W|$)/' => $lang['thu'] . "$1",
	        '/\[Fri\](\W|$)/' => $lang['fri'] . "$1",
	        '/\[Sat\](\W|$)/' => $lang['sat'] . "$1",
	        '/\[Jan\](\W|$)/' => $lang['jan'] . "$1",
	        '/\[Feb\](\W|$)/' => $lang['feb'] . "$1",
	        '/\[Mar\](\W|$)/' => $lang['mar'] . "$1",
	        '/\[Apr\](\W|$)/' => $lang['apr'] . "$1",
	        '/\[May\](\W|$)/' => $lang['may2'] . "$1",
	        '/\[Jun\](\W|$)/' => $lang['jun'] . "$1",
	        '/\[Jul\](\W|$)/' => $lang['jul'] . "$1",
	        '/\[Aug\](\W|$)/' => $lang['aug'] . "$1",
	        '/\[Sep\](\W|$)/' => $lang['sep'] . "$1",
	        '/\[Oct\](\W|$)/' => $lang['oct'] . "$1",
	        '/\[Nov\](\W|$)/' => $lang['nov'] . "$1",
	        '/\[Dec\](\W|$)/' => $lang['dec'] . "$1",
	        '/Sunday(\W|$)/' => $lang['sunday'] . "$1",
	        '/Monday(\W|$)/' => $lang['monday'] . "$1",
	        '/Tuesday(\W|$)/' => $lang['tuesday'] . "$1",
	        '/Wednesday(\W|$)/' => $lang['wednesday'] . "$1",
	        '/Thursday(\W|$)/' => $lang['thursday'] . "$1",
	        '/Friday(\W|$)/' => $lang['friday'] . "$1",
	        '/Saturday(\W|$)/' => $lang['saturday'] . "$1",
	        '/January(\W|$)/' => $lang['january'] . "$1",
	        '/February(\W|$)/' => $lang['february'] . "$1",
	        '/March(\W|$)/' => $lang['march'] . "$1",
	        '/April(\W|$)/' => $lang['april'] . "$1",
	        '/May(\W|$)/' => $lang['may'] . "$1",
	        '/June(\W|$)/' => $lang['june'] . "$1",
	        '/July(\W|$)/' => $lang['july'] . "$1",
	        '/August(\W|$)/' => $lang['august'] . "$1",
	        '/September(\W|$)/' => $lang['september'] . "$1",
	        '/October(\W|$)/' => $lang['october'] . "$1",
	        '/November(\W|$)/' => $lang['november'] . "$1",
	        '/December(\W|$)/' => $lang['december'] . "$1" );

	    return preg_replace( array_keys( $replaces ), array_values( $replaces ), $return );
	}
}

?>