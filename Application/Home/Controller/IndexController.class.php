<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
	/**
	 * 把字符串加密为摩斯密码
	 * 最初字符 I LOVE YOU QYC
	 * 去掉空格 ILOVEYOUQYC
	 * 倒叙排列 CYQUOYEVOLI
	 * 分隔栅栏 CEYVQOULOIY
	 * QWE=ABC加密 ETNCJGXSGON
	 * 转化为ASCII 10进制 69 84 78 67 74 71 88 83 71 79 78
	 * @return string 摩斯密码
	 */
	public function index()
	{
		// 目前仅支持英文字母加密
		$string = 'I LOVE YOU QYC';
		// 转为大写字符
		$string = strtoupper($string);
		$string = preg_replace("/(\s| |\xc2\xa0)/iU", '', $string);
		$arrStr = str_split($string); // 分隔字符串为数组
		$arrStr = array_reverse($arrStr); // 倒叙排列数组
		$string = implode($arrStr); // 重新组合字符串
		$strLen = strlen($string);// 字符串长度
		$subLen = ceil($strLen / 2);
		$frontStr = substr($string, 0, $subLen);
		$backStr = substr($string, $subLen);
		// 利用分隔栅栏重新排序
		$string = $this->fence($frontStr, $backStr);
		// QWE=ABC加密
		$string = $this->QWEencode($string);
		// 转为ACSII码
		$string = $this->strToAscii($string);
		// 摩斯加密
		$string = $this->morseIntToCode($string);
		var_export($string);
	}

	/**
	 * 栅栏排序
	 *
	 * @param string $str1 字符串1
	 * @param string $str2 字符串2
	 * @return string
	 */
	public function fence($str1, $str2)
	{
		// 把字符串分隔为数组
		$arr1 = str_split($str1);
		$arr2 = str_split($str2);
		$string = '';
		for ($i = 0; $i < count($arr1); $i++) {
			$string = $string . $arr1[$i] . $arr2[$i];
		}
		return $string;
	}

	/**
	 * QWE=ABC加密
	 *
	 * 〖QWE加密表〗
	 * ┃a┃b┃c┃d┃e┃f┃g┃h┃i┃j┃k┃l┃m┃n┃o┃p┃q┃r┃s┃t┃u┃v┃w┃x┃y┃z┃
	 * ┠-╂-╂-╂-╂-╂-╂-╂-╂-╂-╂-╂-╂-╂-╂-╂-╂-╂-╂-╂-╂-╂-╂-╂-╂-╂-┨
	 * ┃Q┃W┃E┃R┃T┃Y┃U┃I┃O┃P┃A┃S┃D┃F┃G┃H┃J┃K┃L┃Z┃X┃C┃V┃B┃N┃M┃
	 * @param string $str 待加密字符串
	 * @return string
	 */
	public function QWEencode($str)
	{
		// 组建QWE=ABC数组
		$QWEarr = array('a' => 'Q', 'b' => 'W', 'c' => 'E', 'd' => 'R', 'e' => 'T', 'f' => 'Y', 'g' => 'U',
			'h' => 'I', 'i' => 'O', 'j' => 'P', 'k' => 'A', 'l' => 'S', 'm' => 'D', 'n' => 'F', 'o' => 'G', 'p' => 'H',
			'q' => 'J', 'r' => 'K', 's' => 'L', 't' => 'Z', 'u' => 'X', 'v' => 'C', 'w' => 'V', 'x' => 'B', 'y' => 'N', 'z' => 'M'
		);
		$str = strtolower($str); // 把字符串转为小写
		$strArr = str_split($str); // 分隔字符串为数组
		$string = '';
		foreach ($strArr as $val) {
			if (!preg_match('/[a-zA-Z]/', $val)) continue;
			$string .= $QWEarr[$val];
		}
		return $string;
	}

	/**
	 * 字符串转为ASCII码代码
	 *
	 * @param string $str 待转字符串
	 * @return string
	 */
	public function strToAscii($str)
	{
		$strArr = str_split($str);
		$string = '';
		foreach ($strArr as $val) {
			$string = $string . ord($val);
		}
		return $string;
	}

	/**
	 * 字符串转为摩斯数字码
	 *
	 * @param string $str 待转字符串
	 * @return string
	 */
	public function morseIntToCode($str)
	{
		$morseIntArr = array('0' => '-', '1' => '*-', '2' => '**-', '3' => '***--', '4' => '****-', '5' => '*****',
				'6' => '-****','7' => '--***','8' => '-**','-*'
		);
		$strArr = str_split($str);
		$string = '';
		foreach($strArr as $val){
			$string = $string . $morseIntArr[$val] . '/';
		}
		return  $string;
	}

}