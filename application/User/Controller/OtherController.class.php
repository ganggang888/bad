<?php
namespace User\Controller;

use Common\Controller\MemberbaseController;

class OtherController extends MemberbaseController {
	
	function _initialize(){
		parent::_initialize();
      $this->assign('huiyuan',1);
	}


	//积分充值首页 http://www.chaojimatou.com/mobile/user.php?act=user_card&tab=2
	public function index()
	{
		$this->display();
	}

	//提交积分兑换
	public function gold_get_jf()
	{
		$jf = I('post.jf');
		$gold = I('post.gold');
		$uid = get_current_userid();
		if ($_SESSION['user']['gold'] < $gold) {
			$this->error('金币不足');
		}
		//开始写入数据库
		$model = M();
		$model->startTrans();
		$one = $model->execute("UPDATE i_users SET score = score + $jf,gold = gold-$gold WHERE id = $uid");
		$two = $model->execute("INSERT INTO i_duihuan_log (uid,gold,score,add_time) VALUES ($uid,$gold,$jf,now())");
		if ($one && $two) {
			$model->commit();
			$this->success('兑换成功');
		} else {
			$model->rollback();
			$this->error('兑换失败');
		}
	}

	//充值金币
	public function getGold()
	{
		$this->display();
	}

	//积分兑换记录-金币换积分
	public function getScoreGoldHis()
	{
		$uid = get_current_userid();
		$result = M('duihuan_log')->where(array('uid'=>$uid))->order(array('id'=>'DESC'))->select();
		$this->assign(compact('result'));
		$this->display();
	}

	//用户提现
	public function tixian()
	{
		if (IS_POST) {
			$jf = I('post.jf');
			$money = intval($jf / 2);
			if ($_SESSION['user']['can_monery'] < $jf) {
				$this->error('输入金额大于您实际拥有的金额');
			}
			//开始插入数据库
			$model = M();
			$model->startTrans();
			$uid = get_current_userid();
			$one = $model->execute("UPDATE i_users SET can_monery = can_monery - $jf WHERE id = $uid");
			$two = $model->execute("INSERT INTO i_tixian (uid,money,status,type,add_time) VALUES ($uid,$money,1,1,now())");
			if ($one && $two) {
				$model->commit();
				$this->success('提现申请成功,管理员核实后提现金额会在2个工作日内打到您指定的银行卡上，请注意查收');
			} else {
				$model->rollback();
				$this->error('提现失败');
			}
		}
		//先查看是否绑定银行卡信息
		$bank = M('bank')->where(array('uid'=>get_current_userid()))->select();
		if (empty($bank)) {
			echo "<script>alert('您还未绑定银行卡，绑定银行卡即可提现');window.location.href='index.php?g=User&m=Center&a=bank_list';</script>";
		}
		$tex = '';
		foreach ($bank as $vo) {
			$tex .= '{
            title: "'.$vo['name'].' : '.$vo['bank_name'].'",
            value: "'.$vo['id'].'",
          },';
		}
		$this->assign(compact('bank','tex'));
		$this->display();
	}

	//提现记录
	public function tixian_history()
	{
		$status = I('get.status');
		$uid = get_current_userid();
		$status ? $where['status'] = $status : '';
		$result = M('tixian')->where(array('uid'=>get_current_userid()))->where($where)->order(array("id"=>"DESC"))->select();
		$this->assign(compact('result','uid'));
		$this->display();
	}
}	