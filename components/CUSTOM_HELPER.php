<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/24/2017
 * Time: 10:57 PM
 */

namespace app\components;

class CUSTOM_HELPER
{
	public static function GenerateRandomRef()
	{
		return $rand = substr(md5(microtime()), rand(0, 26), 5);
	}
}