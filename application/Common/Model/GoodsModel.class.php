<?php
namespace Common\Model;
use Common\Model\CommonModel;
class GoodsModel extends CommonModel
{
	protected $_validate = array(
		//array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
		array('name', 'require', '商品名称不能为空', 1, 'regex', CommonModel:: MODEL_INSERT  ),
		/*array('cost_price', 'require', '请输入成本价', 1, 'regex', CommonModel:: MODEL_INSERT ),
		array('selling_price', 'require', '请输入销售价', 0, 'regex', CommonModel:: MODEL_UPDATE  ),
		array('market_value', 'require', '请输入市场价', 0, 'regex', CommonModel:: MODEL_UPDATE  ),
		array('unit','require','单位不能为空！',0,'regex',CommonModel:: MODEL_BOTH ),
		array('stock','integer','请输入正确的库存可是',0,'regex',CommonModel:: MODEL_BOTH ), */
		array('term_id','require','请选择分类ID',0,'regex',CommonModel:: MODEL_BOTH ), 
	    //array('mobile','','手机号已经存在！',0,'unique',CommonModel:: MODEL_BOTH ), // 验证mobile字段是否唯一
		/*array('user_email','require','邮箱不能为空！',0,'regex',CommonModel:: MODEL_BOTH ), // 验证user_email字段是否唯一
		array('user_email','','邮箱帐号已经存在！',0,'unique',CommonModel:: MODEL_BOTH ), // 验证user_email字段是否唯一
		array('user_email','email','邮箱格式不正确！',0,'',CommonModel:: MODEL_BOTH ), // 验证user_email字段格式是否正确*/
	);

    //操作一些数据
	protected function _before_insert(&$data,$option)
	{
		if ($data['attribute']) {
			foreach ($data['attribute']['cost_price'] as $key=>$vo) {
				$info[] = array(
					'id'=>$data['attribute']['id'][$key],
					'cost_price'=>$data['attribute']['cost_price'][$key],
					'selling_price'=>$data['attribute']['selling_price'][$key],
					'market_value'=>$data['attribute']['market_value'][$key],
					'unit'=>$data['attribute']['unit'][$key],
					'stock'=>$data['attribute']['stock'][$key],
					'name'=>$data['attribute']['name'][$key],
					'info'=>$data['attribute']['info'][$key],
					);
			}
			$data['attribute'] = json_encode($info);
		}
		$data['id'] = date("YmdHis").mt_rand(100,999);
		$data['photos_url'] ? $data['photos_url'] = json_encode($data['photos_url']) : '';
		//$data['stock'] == 0 ? $data['status'] = 0 : '';
		$data['add_time'] = date("Y-m-d H:i:s");
		$data['admin_id'] = get_current_admin_id();
	}

	/**
	 * [_before_update description]
	 * @param  [type] &$data  [description]
	 * @param  [type] $option [description]
	 * @return [type]         [description]
	 */
	protected function _before_update(&$data,$option)
	{
		if ($data['attribute']) {
			foreach ($data['attribute']['cost_price'] as $key=>$vo) {
				$info[] = array(
					'id'=>$data['attribute']['id'][$key],
					'cost_price'=>$data['attribute']['cost_price'][$key],
					'selling_price'=>$data['attribute']['selling_price'][$key],
					'market_value'=>$data['attribute']['market_value'][$key],
					'unit'=>$data['attribute']['unit'][$key],
					'stock'=>$data['attribute']['stock'][$key],
					'name'=>$data['attribute']['name'][$key],
					'info'=>$data['attribute']['info'][$key],
					);
			}
			$data['attribute'] = json_encode($info);
		}
	}
	/**
	 * 首页以及会员专区推荐
	 * @param [int] $type 1首页推荐 2 会员推荐 3上下架
	 * @param [int] $status 1推荐、上架 0取消推荐、下架
	 * @param [array] $data   [description]
	 */
	public function Recommend($type,$status,$data)
	{
		$caseThen = '';
        $i = '';
        foreach ($data as $vo) {
            if ($status == 1) {
            	$caseThen .= " WHEN '$vo' THEN 1 \n";
            	$i .= "$vo,";
            } else {
            	$caseThen .= " WHEN '$vo' THEN 0 \n";
            	$i .= "$vo,";
            }
		}
		$i = substr($i,0,strlen($i)-1);
		if ($type == 1) {
			$sql = " UPDATE ".C('DB_PREFIX')."goods SET `indexs` = CASE id $caseThen \n END \n WHERE ID IN($i)";
		} elseif ($type == 2) {
			$sql = " UPDATE ".C('DB_PREFIX')."goods SET `member` = CASE id $caseThen \n END \n WHERE ID IN($i)";
		} elseif ($type == 3) {
			$sql = " UPDATE ".C('DB_PREFIX')."goods SET `status` = CASE id $caseThen \n END \n WHERE ID IN($i)";
		}
		return ($this->execute($sql) ? true : false);
	}

	//根据ID来区别是否已经卖完或者下架
	public function getStatus($id,$number)
	{
		//先判断是否下架
		$info = explode('-',$id);
		$first = $info[0];
		$next = $info[1];
		$food = $this->where(array('id'=>$first))->field(array('status','attribute'))->find();
		if ($food['status'] == 0 || !$food) {
			return false;
		}

		//是否库存为空
		$attribute = json_decode($food['attribute'],true);
		if ($attribute[$next]['stock'] <= 0) {
			return false;
		}
		//库存不够
		if ($number - $attribute[$next]['stock'] < 0) {
			return 1;
		}
		return 2;
	}
}