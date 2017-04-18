<?php
namespace User\Controller;

use Common\Controller\MemberbaseController;

class CenterController extends MemberbaseController {
	
	function _initialize(){
		parent::_initialize();
	}
	
    // 会员中心首页
	public function index() {
		$this->assign($this->user);
    	$this->display(':center');
    }

    //收货地址管理
    public function addressList()
   	{
   		$info = M('address')->where(array('uid'=>get_current_userid()))->order(array('listorder'=>'DESC'))->select();
   		$this->assign(compact('info'));
   		$this->display();
   	}

   	//添加收获地址
   	public function addAddress()
   	{
   		if (IS_POST) {
   			$post = I('post.post');
	   		$post['uid'] = get_current_userid();
	   		$isMatched = preg_match('/0?(13|14|15|18)[0-9]{9}/', $post['phone'], $matches);
	   		!$post['address'] ? $this->error('缺少参数') : '';
	   		if (!$isMatched) {
	   			$this->error('请输入正确手机号');
	   		}
	   		if (M('address')->add($post) !== false) {
	   			$this->success('添加成功',U('Center/addressList'));
	   		} else {
	   			$this->error('添加失败');
	   		}
   		}
   		$this->display();
   	}

   	//修改收获地址
   	public function editAddress()
   	{
   		if (IS_POST) {
   			$post = I('post.post');
	   		$post['uid'] = get_current_userid();
	   		$isMatched = preg_match('/0?(13|14|15|18)[0-9]{9}/', $post['phone'], $matches);
	   		!$post['address'] ? $this->error('缺少参数') : '';
	   		if (!$isMatched) {
	   			$this->error('请输入正确手机号');
	   		}
	   		if (M('address')->save($post) !== false) {
	   			$this->success('添加成功',U('Center/addressList'));
	   		} else {
	   			$this->error('添加失败');
	   		}
   		}
   		$id = I('get.id');
   		$info = M('address')->where("id=%d",array($id))->find();
   		$this->assign(compact('info'));
   		$this->display();
   	}

   	//删除收获地址
   	public function deleteAddress()
   	{
   		$id = I('get.id');
   		M('address')->where(array('id'=>$id,'uid'=>get_current_userid()))->delete() ? $this->success('删除成功',U('Center/addressList')) : $this->error('Center/addressList');
   	}

   	//用户信息
   	public function userInfo()
   	{
   		$info = M('users')->find(get_current_userid());
   		$this->assign(compact('info'));
   		$this->display();
   	}

   	//会员资料修改
   	public function changeInfo()
   	{
   		
   	}
}
