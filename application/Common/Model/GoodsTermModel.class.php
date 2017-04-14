<?php
namespace Common\Model;
use Common\Model\CommonModel;
class GoodsTermModel extends CommonModel
{
	protected $_validate = array(
		//array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
		array('name', 'require', '请输入名称', 1, 'regex', CommonModel:: MODEL_BOTH  ),
	);
        //操作一些数据
	protected function _before_insert(&$data,$option)
	{
		$data['add_time'] = date("Y-m-d H:i:s");
		$data['admin_id'] = get_current_admin_id();
	}
}