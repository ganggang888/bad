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
   			$post = $_POST;
	   		$post['uid'] = get_current_userid();
	   		$isMatched = preg_match('/0?(13|14|15|18)[0-9]{9}/', $post['phone'], $matches);
	   		!$post['address'] ? $this->error('缺少参数') : '';
            if (!$post['name']) {
               $this->error('请输入名称');
            }
	   		if (!$isMatched) {
	   			$this->error('请输入正确手机号');
	   		}
	   		if (M('address')->add($post) !== false) {
	   			$this->success('添加成功',U('Center/addressList'));
	   		} else {
	   			$this->error('添加失败');
	   		}
   		}
         $province = M("province")->order(array('provinceid'=>'ASC'))->select();
         $this->assign(compact('province'));
   		$this->display();
   	}

      public function save()
      {
         header("Content-type: text/html; charset=utf-8");
         //提交处理
         $itemcount=I('itemCount');
         for ($i=0;$i<=$itemcount;$i++){
           $arrname=I('item_name_'.$i);
           if ($arrname){
           $arr[$i]['fname']=I('item_name_'.$i);
           $arr[$i]['fprice']=(I('item_price_'.$i));
           $arr[$i]['fcount']=I('item_quantity_'.$i);
           $arr[$i]['prices']=$arr[$i]['fcount'] * $arr[$i]['fprice'];
           $fid=I('item_options_'.$i);
           $arr[$i]['fid']=trim(substr($fid,4));
           }
         }

         //处理完购物车信息后查看该商品是否有库存并且处于上架状态
         foreach ($arr as $key=>$vo) {

         }
         var_dump($_POST);exit;
      }

      public function Cart()
      {
         $address = M('address')->where(array('uid'=>get_current_userid()))->order(array('listorder'=>'desc'))->select();
         $uid = get_current_userid();
         $this->assign(compact('address','uid'));
         $this->display();
      }
   	//修改收获地址
   	public function editAddress()
   	{
   		if (IS_POST) {
   			$post = $_POST;
	   		$post['uid'] = get_current_userid();
	   		$isMatched = preg_match('/0?(13|14|15|18)[0-9]{9}/', $post['phone'], $matches);
	   		!$post['address'] ? $this->error('缺少参数') : '';
	   		if (!$isMatched) {
	   			$this->error('请输入正确手机号');
	   		}
	   		if (M('address')->save($post) !== false) {
	   			$this->success('修改成功',U('Center/addressList'));
	   		} else {
	   			$this->error('修改失败');
	   		}
   		}
   		$id = I('get.id');
   		$info = M('address')->where("id=%d",array($id))->find();
         $province = M("province")->order(array('provinceid'=>'ASC'))->select();
   		$this->assign(compact('info','province'));
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

   	//订单提交
   	public function submitOrder()
   	{
   	}
}

