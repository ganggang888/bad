<?php
namespace Common\Model;
use Common\Model\CommonModel;
class GoodsModel extends CommonModel
{
	protected $_validate = array(
		//array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
		array('monery', 'require', '金额不能为空', 1, 'regex', CommonModel:: MODEL_INSERT  ),
	);

	//操作一些数据
	protected function _before_insert(&$data,$option)
	{
		$data['add_time'] = date("Y-m-d H:i:s");
	}
	/**
	 * 用户提交充值后存入数据库
	 * @param [double] $monery [充值金额]
	 * @param [uid] $uid    [用户ID]
	 * @param [type] $type   [支付方式1支付宝2微信]
	 */
	public function addMoneryFirst($data)
	{
		$data['action'] = 1;
		$info = $this->add($data);
		return ($info ? true : false);
	}

	/**
	 * 充值成功后操作金额
	 * @param [bigint] $number [订单号]
	 */
	public function addMoneryNext($number)
	{
		$info = $this->where(array('number'=>$number))->field(array('monery','uid'));
		if ($info) {
			$monery = $info['monery'];
			$uid = $info['uid'];
			//开始进行事物操作
			$model = M();
			$model->startTrans();
			//先修改订单状态为已支付
			$updateStatus = "UPDATE ".C('DB_PREFIX')."recharge SET status = 1 WHERE number = '$number'";
			$updateMonery = "UPDATE "C('DB_PREFIX')."users SET monery = monery+$monery WHERE uid = $uid";
			$first = $model->execute($updateStatus);
			$next = $model->execute($updateMonery);
			if ($first && $next) {
				$model->commit();
				return true;
			} else {
				$model->rollback();
				return false;
			}
		}
		
	}
}