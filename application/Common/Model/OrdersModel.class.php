<?php
namespace Common\Model;
use Common\Model\CommonModel;
class GoodsModel extends CommonModel
{
	protected $_validate = array(
		//array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
		array('monery', 'require', '金额不能为空', 1, 'regex', CommonModel:: MODEL_INSERT  ),
	);

	
}
