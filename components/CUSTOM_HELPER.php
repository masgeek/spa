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
    const SALON_ADMIN = 'BUSINESS DISABLED';


    const ACCOUNT_PENDING = 1;
    const ACCOUNT_ACTIVE = 2;
    const ACCOUNT_SUSPENDED = 3;
    const ACCOUNT_DEACTIVATED = 4;

	public static function GenerateRandomRef()
	{
		$rand = substr(md5(microtime()), rand(0, 26), 5);
		return strtoupper($rand);
	}
}