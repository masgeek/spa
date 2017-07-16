<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/16/2017
 * Time: 8:39 PM
 */

namespace app\api\modules\v1\models;


use yii\filters\RateLimitInterface;
use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

class SALON_MODEL extends \app\models\Salon implements Linkable, RateLimitInterface
{

	const SCENARIO_CREATE = 'create';

	public function rules()
	{
		$rules = parent::rules();
		return $rules;
	}

	public function scenarios()
	{
		$scenarios = parent::scenarios();
		//$scenarios[self::SCENARIO_CREATE] = ['Name', 'Last_Name', 'Email'];
		return $scenarios;
	}

	/**
	 * @return array
	 */
	public function fields()
	{
		$fields = parent::fields();

		//unset($fields['auth_key'], $fields['password_hash'], $fields['password_reset_token']);
		return $fields;
	}

	/*public function extraFields()
	{
		return ['profile'];
	}*/
	public function getLinks()
	{
		return [
			Link::REL_SELF => Url::to(['salon/view', 'id' => $this->SALON_ID], true),
			'edit' => Url::to(['salon/view', 'id' => $this->SALON_ID], true),
			//'profile' => Url::to(['salon/profile/view', 'id' => $this->SALON_ID], true),
			//'index' => Url::to(['SALON_MODEL'], true),
		];
	}

	//Rate limiters
	public function getRateLimit($request, $action)
	{
		return [$this->rateLimit, 1]; // $rateLimit requests per second
	}

	public function loadAllowance($request, $action)
	{
		return [$this->allowance, $this->allowance_updated_at];
	}

	public function saveAllowance($request, $action, $allowance, $timestamp)
	{
		$this->allowance = $allowance;
		$this->allowance_updated_at = $timestamp;
		$this->save();
	}
}