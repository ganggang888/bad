<?php
namespace Common\Model;
use Common\Model\CommonModel;
class GoodsModel extends CommonModel
{
	protected $_validate = array(
		//array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
		array('name', 'require', '商品名称不能为空', 1, 'regex', CommonModel:: MODEL_INSERT  ),
		array('cost_price', 'require', '请输入成本价', 1, 'regex', CommonModel:: MODEL_INSERT ),
		array('selling_price', '请输入销售价', '用户名称不能为空！', 0, 'regex', CommonModel:: MODEL_UPDATE  ),
		array('market_value', 'require', '请输入市场价', 0, 'regex', CommonModel:: MODEL_UPDATE  ),
		array('unit','require','单位不能为空！',0,'regex',CommonModel:: MODEL_BOTH ),
		array('stock','require','请输入库存',0,'regex',CommonModel:: MODEL_BOTH ), 
		array('term_id','require','请选择分类ID',0,'regex',CommonModel:: MODEL_BOTH ), 
	    //array('mobile','','手机号已经存在！',0,'unique',CommonModel:: MODEL_BOTH ), // 验证mobile字段是否唯一
		/*array('user_email','require','邮箱不能为空！',0,'regex',CommonModel:: MODEL_BOTH ), // 验证user_email字段是否唯一
		array('user_email','','邮箱帐号已经存在！',0,'unique',CommonModel:: MODEL_BOTH ), // 验证user_email字段是否唯一
		array('user_email','email','邮箱格式不正确！',0,'',CommonModel:: MODEL_BOTH ), // 验证user_email字段格式是否正确*/
	);
}