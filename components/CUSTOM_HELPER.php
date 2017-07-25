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
    const ADMIN_ACCOUNT = 'ADMIN';
    const SALON_ADMIN = 'BUSINESS';

	public static function GenerateRandomRef()
	{
		$rand = substr(md5(microtime()), rand(0, 26), 5);
		return strtoupper($rand);
	}
}