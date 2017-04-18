<?php
namespace Common\Model;
use Common\Model\CommonModel;
class UsersModel extends CommonModel
{
	
	protected $_validate = array(
		//array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
		array('user_login', 'require', '用户名称不能为空！', 1, 'regex', CommonModel:: MODEL_INSERT  ),
		array('user_pass', 'require', '密码不能为空！', 1, 'regex', CommonModel:: MODEL_INSERT ),
		array('user_login', 'require', '用户名称不能为空！', 0, 'regex', CommonModel:: MODEL_UPDATE  ),
		array('user_pass', 'require', '密码不能为空！', 0, 'regex', CommonModel:: MODEL_UPDATE  ),
		array('user_login','','用户名已经存在！',0,'unique',CommonModel:: MODEL_BOTH ), // 验证user_login字段是否唯一
	    array('mobile','','手机号已经存在！',0,'unique',CommonModel:: MODEL_BOTH ), // 验证mobile字段是否唯一
		array('user_email','require','邮箱不能为空！',0,'regex',CommonModel:: MODEL_BOTH ), // 验证user_email字段是否唯一
		array('user_email','','邮箱帐号已经存在！',0,'unique',CommonModel:: MODEL_BOTH ), // 验证user_email字段是否唯一
		array('user_email','email','邮箱格式不正确！',0,'',CommonModel:: MODEL_BOTH ), // 验证user_email字段格式是否正确
	);
	
	protected $_auto = array(
	    array('create_time','mGetDate',CommonModel:: MODEL_INSERT,'callback'),
	    array('birthday','',CommonModel::MODEL_UPDATE,'ignore')
	);
	
	//用于获取时间，格式为2012-02-03 12:12:12,注意,方法不能为private
	function mGetDate() {
		return date('Y-m-d H:i:s');
	}
	
	protected function _before_write(&$data) {
		parent::_before_write($data);
		
		if(!empty($data['user_pass']) && strlen($data['user_pass'])<25){
			$data['user_pass']=sp_password($data['user_pass']);
		}
	}

	/**
	 * 修改用户信息
	 * @param  [type] $uid  [description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function changeUserInfo($uid,$data)
	{
		if ($uid == $data['id']) {
			$isMatched = preg_match('/0?(13|14|15|18)[0-9]{9}/', $data['mobile'], $matches);
			if (!$isMatched) {
				return ['code'=>1,'msg'=>'请输入正确手机号'];
			}
			if ($this->create() !== false) {
				if ($this->save() !== false) {
					return ['code'=>0];
				} else {
					return ['code'=>1,'msg'=>'修改失败']
				}
			} else {
				return ['code'=>1,'msg'=>$this->getError()]
			}
		} else {
			return false;
		}
	}

	public function changePasswd($uid,$password)
	{
		$change = $this->where("id=%d",array($uid))->save(['user_pass'=>$password]);
		return ($change ? true : false);
	}
	
	
}

