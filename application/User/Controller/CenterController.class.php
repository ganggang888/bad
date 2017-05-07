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
      //获取订单待发货数量
      $daifa = M('orders')->where(array('uid'=>get_current_userid(),'status'=>0))->count();
      //获取待收货数量
      $daishou = M('orders')->where(array('uid'=>get_current_userid(),'status'=>2))->count();
      $score = $_SESSION['user']['score'];
      $can_monery = $_SESSION['user']['can_monery'];
      $this->assign(compact('daifa','daishou','score','can_monery'));
      $this->display();
    	//$this->display(':center');
    }

    //收货地址管理
    public function addressList()
   	{
   		$info = M('address')->where(array('uid'=>get_current_userid()))->order(array('listorder'=>'DESC'))->select();
         $info = array_map(function($v){
            $v['phone'] = substr_replace($v['phone'],"****",3,4);
            return $v;
         },$info);
         $good_id = I('get.good_id');
         $pid = I('get.pid');
         $type1 = I('get.type1');
         $type2 = I('get.type2');
   		$this->assign(compact('info','good_id','pid','type1','type2'));
   		$this->display();
   	}

   	//添加收获地址
   	public function addAddress()
   	{
   		if (IS_POST) {
            $info = explode(',',$_POST['codeinfo']);
            $_POST['province'] = $info[0];
            $_POST['city'] = $info[1];
            $_POST['area'] = $info[2];
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
            if ($_POST['de'] == true) {
               $post['listorder'] = 1;
               M('address')->where(array('uid'=>get_current_userid()))->save(array('listorder'=>0));
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
           $arr[$i]['fid'] = trim(end(explode(':',$fid)));
           }
         }
         //处理完购物车信息后查看该商品是否有库存并且处于上架状态
         foreach ($arr as $key=>$vo) {
            //判断库存上下架状态
            $good = D("Common/Goods");
            $status = $good->getStatus($vo['fid'],$vo['fcount']);
            if ($status == false) {
               $this->error('商品已下架或库存已空');
            } elseif ($status == 0) {
               $this->error('库存不足');
            }
            $price += $vo['prices'];
         }
         if (!$price) {
            $this->error('请选择商品');
         }
         //判断完状态后写入订单信息
         $order_num = date("YmdHis").mt_rand(100,999);
         $uid = get_current_userid();
         $address_id = I('optionad');
         $goodsInfo = json_encode($arr);
         $content = I('content');
         $array = array(
            'order_num'=>date("YmdHis").mt_rand(100,999),
            'uid'=>get_current_userid(),
            'address_id'=>I('addressid'),
            'prices'=>$price,
            'goodsInfo'=>json_encode($arr),
            'content'=>I('ocontent'),
            'order_time'=>date("Y-m-d H:i:s"),
         );

         //下单成功后减库存，写入库存日志
         $orders = M('orders');
         $orders->startTrans();
         $insert = $orders->add($array);
         //减库存
         foreach ($arr as $vo) {
            $info = explode('-',$vo['fid']);
            $first = $info[0];
            $next = $info[1];
            $attribute = M('goods')->where(array('id'=>$first))->getField('attribute');
            $attribute = json_decode($attribute,true);
            $attribute[$next]['stock'] = $attribute[$next]['stock'] - $vo['fcount'];
            $update = M('goods')->where(array('id'=>$first))->save(array('attribute'=>json_encode($attribute)));
            if (!$update) {
               $error = 1;
            }

            //写入SKU记录
            $sku_insert = M('sku')->add(['gid'=>$first,'uid'=>get_current_userid(),'action'=>1,'gid_info'=>$next,'number'=>$vo['fcount'],'add_time'=>date("Y-m-d H:i:s")]);
            if (!$sku_insert) {
               $sku_error = 1;
            }
         }
         if ($insert && $error != 1 && $sku_error != 1) {
            $orders->commit();
            $this->success('下单成功，正跳转至支付页面');
         } else {
            $orders->rollback();
            $this->error('添加失败');
         }
      }

      public function Cart()
      {
         $address = M('address')->where(array('uid'=>get_current_userid()))->order(array('listorder'=>'desc'))->select();
         $uid = get_current_userid();
         $this->assign(compact('address','uid'));
         $this->display();
      }


      //自己的订单列表
      public function orderList()
      {
         $status = I('get.status');
         if ($status == 'all') {

         } else {
            $status ? $where['status'] = $status : $where['status'] = 0;
         }
         
         $where['uid'] = get_current_userid();
         $result = M('orders')->where(array('uid'=>get_current_userid()))->order(array('order_time'=>'desc'))->select();
         $result = array_map(function($v){
            $goodsInfo = json_decode($v['goodsinfo'],true);
            $info = current($goodsInfo);
            $v['name'] = end(explode('|',$info['fname']));
            $v['goods'] = goodsInfo($v['gid']);
            return $v;
         },$result);
         var_dump($result);
         $this->assign(compact('result','status'));
         $this->display();

      }
   	//修改收获地址
   	public function editAddress()
   	{
   		if (IS_POST) {
            $info = explode(',',$_POST['codeinfo']);
            $_POST['province'] = $info[0];
            $_POST['city'] = $info[1];
            $_POST['area'] = $info[2];
            $_POST['de'] == true ? $_POST['listorder'] = 1 : $_POST['listorder'] = 0;
   			$post = $_POST;
	   		$post['uid'] = get_current_userid();
	   		$isMatched = preg_match('/0?(13|14|15|18)[0-9]{9}/', $post['phone'], $matches);
	   		!$post['address'] ? $this->error('缺少参数') : '';
	   		if (!$isMatched) {
	   			$this->error('请输入正确手机号');
	   		}
            if ($_POST['listorder'] = 1) {
               M('address')->where(array('uid'=>get_current_userid()))->save(array('listorder'=>0));
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

      //添加银行卡
      public function add_bank()
      {
         if (IS_POST) {
            $post = $_POST;
            $isMatched = preg_match('/0?(13|14|15|18)[0-9]{9}/', $post['phone'], $matches);
            if (!$isMatched) {
               $this->error('请输入正确手机号');
            }
            if (strlen($post['card']) < 10) {
               $this->error('请输入正确的银行卡号');
            }
            $post['uid'] = get_current_userid();
            $post['add_time'] = date("Y-m-d H:i:s");
            if (M('bank')->add($post) !== false) {
               $this->success('添加成功');
            } else {
               $this->error('添加失败');
            }
         }
         $bankInfo = bankInfo();
         $this->assign(compact('bankInfo'));
         $this->display();
      }

      //银行卡列表
      public function bank_list()
      {
         $result = M('bank')->where(array('uid'=>get_current_userid()))->select();
         $result = array_map(function($v){
            $v['card'] = substr_replace($v['card'], "****",3,4);
            return $v;
         },$result);
         $this->assign(compact('result'));
         $this->display();
      }

      //删除银行卡
      public function delete_bank()
      {
         $id = I('get.id');
         M('bank')->where(array('id'=>$id,'uid'=>get_current_userid()))->delete() ? $this->success('删除成功') : $this->error('删除失败');
      }

      //密码修改
      public function changePassword()
      {
         if (IS_POST) {
            $post = $_POST;
            $oldPassword = sp_password($_POST['old_password']);
            $old = M('users')->where(array('id'=>get_current_userid()))->getField('user_pass');
            if ($oldPassword != $old) {
               $this->error('请输入正确的旧密码');
            } else {
               if ($post['password'] != $post['repassword']) {
                  $this->error('两次密码输入不一致');
               }
               M('users')->where(array('id'=>get_current_userid()))->save(array('user_pass'=>sp_password($post['password']))) ? $this->success('密码重置成功') : $this->error('密码重置失败');
            }
         }
         $this->display();
      }

      //兑换之前列出信息
      public function duihuan()
      {
         $good_id = I('get.good_id');
         $pid = I('get.pid');
         $address_id = I('get.address_id');
         //获取本人地址列表
         $where['uid'] = get_current_userid();
         $address_id ? $where['id'] = $address_id : '';
         $type1 = I('get.type1');
         $type2 = I('get.type2');

         
         $address = M('address')->where($where)->order(array("listorder"=>"DESC"))->find();
         $goods = M('goods')->where(array('id'=>$good_id))->find();
         //判断是否含有优惠
         $dataInfo = M('data')->where(array('id'=>1))->getField('data');
         $dataInfo = json_decode($dataInfo,true);
         if ($_SESSION['user']['level'] == 2) {
            if ($dataInfo['huangjin'] > 0) {
               $name = "黄金会员优惠：";
               $youhui = $dataInfo['huangjin'];
               $after_monery = intval($goods['score'] * (1-$youhui));
            }
         } elseif ($_SESSION['user']['level'] > 3) {
            if ($dataInfo['zuanshi'] > 0) {
               $name = "钻石会员优惠：";
               $youhui = $dataInfo['zuanshi'];
               $after_monery = intval($goods['score'] * (1-$youhui));
            }
         }
         if ($goods['score'] > $_SESSION['user']['score']) {
            $error = 1;
         }
         if ($after_monery && $after_monery > $_SESSION['user']['score']) {
            $error = 1;
         }
         $this->assign(compact('good_id','pid','address','goods','type1','type2','youhui','name','after_monery','error'));
         $this->display();
      }

      //用户进行商品兑换 A、B、C三级
      public function do_duihuan()
      {
         //获取对应反现金额
         $dataInfo = M('data')->where(array('id'=>1))->getField('data');
         $dataInfo = json_decode($dataInfo,true);
         $jiandian = $dataInfo['jiandian'];
         $good_id = I('post.goods_id');
         $jf = I('post.jf');
         $goods_info = I('post.info');
         $user = $_SESSION['user'];
         $parentid = I('post.parentid'); //他人转发链接
         $level = $_SESSION['user']['level'];
         $address_id = I('post.address_id');
         $type1 = urldecode(I('post.type1'));
         $type2 = urldecode(I('post.type2'));
         //商品信息
         $theGoods = M('goods')->where("id=%f",array($good_id))->find();
         //判断是否是他人转发或者没有转发直接点开
         $attribute = $theGoods['attribute'];
         $attribute = json_decode($attribute,true);
         foreach ($attribute as $key=>$vo) {
            if ($vo['name'] == $type1 && $vo['info'] == $type2) {
               $attribute[$key]['stock'] = $vo['stock'] - 1;
               $sku_info = $key;
               break;
            }
         }
         if ($user['score'] < $jf) {
            $this->error('您的积分不够，请去充值');
         }

         //如果有上级
         if ($user['pid'] || $parentid) {
            $parentid ? $theParentid = $parentid : $theParentid = $user['pid'];
            $parentid ? $zhuanfa = 1 : $zhuanfa = 0;
            $parent = M('users')->where(array('uuid'=>$theParentid))->find();
            
            //如果上级是普通会员
            if ($parent['level'] == 1) {
               $getScore = intval($jf * $dataInfo['pu']);
               $updateParent = "UPDATE i_users SET can_monery = can_monery+$getScore WHERE id = '$parent[id]'";
               $insertParentLog = "INSERT INTO i_ticheng_log (uid,level,pid,score,gid,zhuanfa,add_time,status) VALUES ('$parent[id]',1,'$user[id]',$getScore,$good_id,$zhuanfa,NOW(),1)";
            } elseif ($parent['level'] == 2) {
               //如果上级会员是黄金会员 ，查看是否第一次下单
               $findUid = M('orders')->where(array('uid'=>get_current_userid()))->getField('id');

               //非第一次购买
               if ($findUid) {
                  $getScore = intval($jf * $dataInfo['level_next']); //佣金
                  $updateParent = "UPDATE i_users SET can_monery = can_monery+$getScore WHERE id = '$parent[id]'";
                  $insertParentLog = "INSERT INTO i_ticheng_log (uid,level,pid,score,gid,zhuanfa,add_time,status) VALUES ('$parent[id]',1,'$user[id]',$getScore,$good_id,$zhuanfa,NOW(),2)";

                  //见点奖分配
                  $insert_jiandian = "UPDATE i_users SET can_monery = can_monery+$jiandian WHERE id = '$parent[id]'";
                  $insert_jiandian_log = "INSERT INTO i_ticheng_log (uid,level,pid,score,gid,zhuanfa,add_time,status) VALUES ('$parent[id]',1,'$user[id]',$getScore,$good_id,$zhuanfa,NOW(),3)";
               //第一次购买
               } else {
                  $getScore = intval($jf * $dataInfo['level_first']); //佣金
                  $updateParent = "UPDATE i_users SET can_monery = can_monery+$getScore WHERE id = '$parent[id]'";
                  $insertParentLog = "INSERT INTO i_ticheng_log (uid,level,pid,score,gid,zhuanfa,add_time,status,times) VALUES ('$parent[id]',1,'$user[id]',$getScore,$good_id,$zhuanfa,NOW(),2,1)";

                  //见点奖分配
                  $insert_jiandian = "UPDATE i_users SET can_monery = can_monery+$jiandian WHERE id = '$parent[id]'";
                  $insert_jiandian_log = "INSERT INTO i_ticheng_log (uid,level,pid,score,gid,zhuanfa,add_time,status) VALUES ('$parent[id]',1,'$user[id]',$getScore,$good_id,$zhuanfa,NOW(),3)";
               }
               
            } elseif ($parent['level'] > 2) {
               //大于2按照钻石会员算进行提成,计算是否第一次下单
               $findUid = M('orders')->where(array('uid'=>get_current_userid()))->getField('id');
               if ($findUid) {
                  $getScore = intval($jf * $dataInfo['zuanshi_next']);
                  $updateParent = "UPDATE i_users SET can_monery = can_monery + $getScore WHERE id = '$parent[id]";
                  $insertParentLog = "INSERT INTO i_ticheng_log (uid,level,pid,score,gid,zhuanfa,add_time,status) VALUES ('$parent[id]',1,'$user[id]',$getScore,$good_id,$zhuanfa,NOW(),2)";

                  //见点奖分配
                  $insert_jiandian = "UPDATE i_users SET can_monery = can_monery+$jiandian WHERE id = '$parent[id]'";
                  $insert_jiandian_log = "INSERT INTO i_ticheng_log (uid,level,pid,score,gid,zhuanfa,add_time,status) VALUES ('$parent[id]',1,'$user[id]',$getScore,$good_id,$zhuanfa,NOW(),3)";
                  
               } else {

                  //第一次下单上级抽佣
                  $getScore = intval($jf * $dataInfo['zuanshi_first']);
                  $updateParent = "UPDATE i_users SET can_monery = can_monery + $getScore WHERE id = '$parent[id]";
                  $insertParentLog = "INSERT INTO i_ticheng_log (uid,level,pid,score,gid,zhuanfa,add_time,status,times) VALUES ('$parent[id]',1,'$user[id]',$getScore,$good_id,$zhuanfa,NOW(),2,1)";

                  //见点奖分配
                  $insert_jiandian = "UPDATE i_users SET can_monery = can_monery+$jiandian WHERE id = '$parent[id]'";
                  $insert_jiandian_log = "INSERT INTO i_ticheng_log (uid,level,pid,score,gid,zhuanfa,add_time,status) VALUES ('$parent[id]',1,'$user[id]',$getScore,$good_id,$zhuanfa,NOW(),3)";
               }
               
            }
            //查看是否继续有上一级
            if ($parent['pid']) {
               $grandfather = M('users')->where(array('uuid'=>$parent['pid']))->find();
               //如果上上级为黄金会员，则拿提返佣和见点奖励
               if ($grandfather['level'] > 1) {
                  //点位钱15没人每次购买
                  $level_level = intval($jf * $dataInfo['level_level']);
                  $updateGrand = "UPDATE i_users SET can_monery = can_monery + $jiandian WHERE id = '$grandfather[id]'";
                  
                  $insertGrandLog = "INSERT INTO i_ticheng_log (uid,level,pid,score,gid,add_time) VALUES ('$parent[id]',2,'$user[id]',$jiandian,$good_id,NOW())";
                  $updateGrandYongjin = " UPDATE i_users SET can_monery = can_monery + $level_level WHERE id = '$grandfather[id]'";
                  $insertGrandYongjinLog = "INSERT INTO i_ticheng_log (uid,level,pid,score,gid,add_time) VALUES ('$parent[id]',2,'$user[id]',$level_level,$good_id,NOW())";
               }
            }
         }
         $selfChange = "UPDATE i_users SET score = score - $jf WHERE id = '$user[id]'";

         //开始写入订单信息
         $order_num = date("YmdHis").mt_rand(100,999);
         $number = 1;
         $score = $jf;
         //var_dump($theGoods['name'].":".$type1."、".$type2);exit;
         $goodsInfo = array(
            array('fname'=>$theGoods['name']."|".$type1."、".$type2,'fprice'=>$jf,'fcount'=>1,'prices'=>$theGoods['score'],'fid'=>$good_id."-".$key),
         );
         $goodsInfo = json_encode($goodsInfo,JSON_UNESCAPED_UNICODE);

         $insertOrder = " INSERT INTO i_orders (order_num,uid,address_id,`number`,gid,goodsInfo,score,pay_score,pay_time) VALUES ($order_num,'$user[id]',$address_id,'$number',$good_id,'$goodsInfo',$score,$score,NOW())";
         $insertSelfLog = "INSERT INTO i_ticheng_log (uid,level,pid,score,gid,action,add_time) VALUES ('$user[id]',0,0,$score,$good_id,0,now())";
         $model = M();
         $model->startTrans();

         //符合所有条件，
         if ($updateParent && $insertParentLog && $insert_jiandian && $insert_jiandian_log && $updateGrand && $insertGrandLog && $updateGrandYongjin && $insertGrandYongjinLog && $selfChange && $insertOrder && $insertSelfLog) {
            $one = $model->execute($updateParent);
            $two = $model->execute($insertParentLog);
            $three = $model->execute($insert_jiandian);
            $four = $model->execute($insert_jiandian_log);
            $five = $model->execute($updateGrand);
            $six = $model->execute($insertGrandLog);
            $seven = $model->execute($updateGrandYongjin);
            $eight = $model->execute($insertGrandYongjinLog);
            $nine = $model->execute($selfChange);
            $ten = $model->execute($insertOrder);
            $eleven = $model->execute($insertSelfLog);
            
            if ($one && $two && $three && $four && $five && $six && $seven && $eight && $nine && $ten && $eleven) {
               $model->commit();
               $success =1;
            } else {
               $model->rollback();
            }
            //没有上上级或者上上级不为黄金会员
         } elseif ($updateParent && $insertParentLog && $insert_jiandian && $insert_jiandian_log && $selfChange && $insertOrder && $insertSelfLog) {
            $one = $model->execute($updateParent);
            $two = $model->execute($insertParentLog);
            $three = $model->execute($insert_jiandian);
            $four = $model->execute($insert_jiandian_log);
            $five = $model->execute($selfChange);
            $seven = $model->execute($insertOrder);
            $eight = $model->execute($insertSelfLog);
            if ($one && $two && $three && $four && $five && $six && $seven && $eight) {
               $model->commit();
               $success = 1;
            } else {
               $model->rollback();
            }

            //上级为普通会员，但上上级为黄金会员
         } elseif ($updateParent && $insertParentLog && $updateGrand && $insertGrandLog && $updateGrandYongjin && $insertGrandYongjinLog && $selfChange && $insertOrder && $insertSelfLog) {
            $one = $model->execute($updateParent);
            $two = $model->execute($insertParentLog);
            $three = $model->execute($updateGrand);
            $four = $model->execute($insertGrandLog);
            $five = $model->execute($updateGrandYongjin);
            $six = $model->execute($insertGrandYongjinLog);
            $seven = $model->execute($selfChange);
            $eight = $model->execute($insertOrder);
            $nine = $model->execute($insertSelfLog);
            if ($one && $two && $three) {
               $model->commit();
               $success = 1;
            } else {
               $model->rollback();
            }
         }  elseif ($updateParent && $insertParentLog && $selfChange && $insertOrder && $insertSelfLog) {
               $one = $model->execute($updateParent);
               $two = $model->execute($insertParentLog);
               $three = $model->execute($selfChange);
               $four = $model->execute($insertOrder);
               $five = $model->execute($insertSelfLog);
               if ($one && $two && $four && $five) {
                  $model->commit();
                  $success = 1;
               } else {
                  $model->rollback();
               }
            } elseif ($selfChange && $insertOrder && $insertSelfLog) {
               $one = $model->execute($selfChange);
               $two = $model->execute($insertOrder);
               $three = $model->execute($insertSelfLog);
               if ($one && $three && $three) {
                  $model->commit();
                  $success = 1;
               } else {
                  $model->rollback();
               }
            }
         //修改商品库存状态以及修改库存记录
         M('goods')->where(array('id'=>$good_id))->save(array('attribute'=>json_encode($attribute)));
         //sku记录写入
         M('sku')->add(array('gid'=>$good_id,'uid'=>get_current_userid(),'action'=>1,'gid_info'=>$key));
         //判断是否为激活黄金会员的商品
         if ($theGoods['huangjin'] == 1 && $success == 1 && $user['level'] == 1) {
            //将本用户状态修改为黄金会员
            M('users')->where(array('id'=>get_current_userid()))->save(array('level'=>2));
            //当用户状态变成黄金会员时检测上级会员状态
            $parent = M('users')->where(array('uuid'=>$theParentid))->find();
            if ($parent) {
               if ($parent['level'] == 2) {
                  //当用户还是黄金会员的时候查看他手下已有多少人为黄金会员，超过3个则+1
                  $count = M('users')->where(array('pid'=>$parent['uuid'],'level'=>2))->count();
                  if ($count >= 3) {
                     //刚好超过三个更改上级为钻石会员并写入log日志
                     M('users')->where(array('uuid'=>$theParentid))->save(array('level'=>3));
                     M('users_log')->add(array('uid'=>$parent['id'],'old_level'=>2,'new_level'=>3,'status'=>2,'add_time'=>date("Y-m-d H:i:s")));
                  }
               }
            }
         }
         //判断是否能成为股东商家
         if ($theGoods['huangjin'] == 1 && $user['level'] < 4) {
            //查看当日是否兑换了超过十个商品
            $uid = get_current_userid();
            $sql = "SELECT COUNT(*) AS num FROM i_orders WHERE uid = $uid AND order_time =to_days(now())";
            $num = M()->query($sql);
            $count = $num[0]['num'];
            //购买超过十次升级
            if ($count >=10) {
               M('users')->where(array('id'=>get_current_userid()))->save(array('level'=>4));
               M('users_log')->add(array('uid'=>get_current_userid(),'old_level'=>$user['level'],'new_level'=>4,'status'=>3,'add_time'=>date("Y-m-d H:i:s")));
            }
         }
         $success ? $this->success('兑换成功') : $this->error('兑换失败');
         
      }


      //收藏某个商品
      public function saveGoods()
      {
         $good_id = I('post.good_id');
         $uid = get_current_userid();
         //先查看是否收藏过
         $find = M('user_collection')->where(array('gid'=>$good_id,'uid'=>$uid))->getField('id');
         if ($find) {
            $this->error('已经收藏过了');
         } else {
            //写入数据库
            M('user_collection')->add(array('gid'=>$good_id,'uid'=>$uid,'add_time'=>date("Y-m-d H:i:s")));
            $this->success('收藏成功');
         }
      }

      //我的收藏
      public function my_save()
      {
         $model = M();
         $result = $model->query("SELECT *,a.id AS sid,b.id AS gid FROM i_user_collection a LEFT JOIN i_goods b ON a.gid = b.id ORDER BY a.add_time DESC");
         $this->assign(compact('result'));
         $this->display();
      }

      //删除收藏
      public function delete_shoucang()
      {
         $id = I('get.id');
         M('user_collection')->where(array('id'=>$id,'uid'=>get_current_userid()))->delete() ? $this->success('删除成功') : $this->error("删除失败");
      }
}

