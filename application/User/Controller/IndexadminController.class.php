<?php
namespace User\Controller;

use Common\Controller\AdminbaseController;

class IndexadminController extends AdminbaseController {
    
    // 后台本站用户列表
    public function index(){
        $where=array();
        $request=I('request.');
        $where ['user_type'] = 2;

        if(!empty($request['uid'])){
            $where['id']=intval($request['uid']);
        }
        
        if (!empty($request['level'])) {
            $where['level'] = $request['level'];
        }
        if(!empty($request['keyword'])){
            $keyword=$request['keyword'];
            $where['mobile']  = array('like', "%$keyword%");
        }
        
    	$users_model=M("Users");
    	
    	$count=$users_model->where($where)->count();
    	$page = $this->page($count, 20);
    	
    	$list = $users_model
    	->where($where)
    	->order("create_time DESC")
    	->limit($page->firstRow . ',' . $page->listRows)
    	->select();
    	
    	$this->assign('list', $list);
    	$this->assign("page", $page->show('Admin'));
    	
    	$this->display(":index");
    }

    //用户删除
    public function delete()
    {
        $id = I('get.id');
        M('users')->where(array('id'=>$id))->delete() ? $this->success('删除成功') : $this->error('删除失败');
    }
    
    // 后台本站用户禁用
    public function ban(){
    	$id= I('get.id',0,'intval');
    	if ($id) {
    		$result = M("Users")->where(array("id"=>$id,"user_type"=>2))->setField('user_status',0);
    		if ($result) {
    			$this->success("会员拉黑成功！", U("indexadmin/index"));
    		} else {
    			$this->error('会员拉黑失败,会员不存在,或者是管理员！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }
    
    // 后台本站用户启用
    public function cancelban(){
    	$id= I('get.id',0,'intval');
    	if ($id) {
    		$result = M("Users")->where(array("id"=>$id,"user_type"=>2))->setField('user_status',1);
    		if ($result) {
    			$this->success("会员启用成功！", U("indexadmin/index"));
    		} else {
    			$this->error('会员启用失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }

    //金币兑换积分记录
    public function jb_dh_jf()
    {
        $begin = I('get.begin');
        $end = I('get.end');
        $mobile = I('get.mobile');
        $this->assign(compact('begin','end'));
        $begin ? $begin = $begin." 00:00:00" : '';
        $end ? $end = $end." 23:59:59" : '';

        $where = "WHERE a.id > 0 ";
        $mobile ? $where .= " AND b.mobile LIKE '%$mobile%'" : '';
        if ($begin && $end) {
            $where .= " AND a.add_time >= '$begin' AND a.add_time < '$end'";
        } elseif ($begin && !$end) {
            $where .= " AND a.add_time >= '$begin'";
        } elseif (!$begin && $end) {
            $where .= " AND a.add_time < '$end'";
        }

        $model = M();
        $num = $model->query("SELECT COUNT(*) AS num FROM i_duihuan_log a LEFT JOIN i_users b ON a.uid = b.id $where ORDER BY a.id DESC");
        $count = $num[0]['num'];
        $page = $this->page($count,20);
        $result = $model->query("SELECT a.id,a.uid,a.gold,a.score,a.add_time,b.mobile FROM i_duihuan_log a LEFT JOIN i_users b ON a.uid = b.id $where ORDER BY a.id DESC LIMIT ".$page->firstRow.",".$page->listRows);
        $this->assign(compact('page','result','mobile'));
        $this->display();
    }

    //用户提现记录
    public function tixian_log()
    {
        $begin = I('get.begin');
        $end = I('get.end');
        $mobile = I('get.mobile');
        $this->assign(compact('begin','end'));
        $begin ? $begin = $begin." 00:00:00" : '';
        $end ? $end = $end." 23:59:59" : '';
        $where = "WHERE a.id > 0 ";
        $mobile ? $where .= " AND b.mobile LIKE '%$mobile%'" : '';
        if ($begin && $end) {
            $where .= " AND a.add_time >= '$begin' AND a.add_time < '$end'";
        } elseif ($begin && !$end) {
            $where .= " AND a.add_time >= '$begin'";
        } elseif (!$begin && $end) {
            $where .= " AND a.add_time < '$end'";
        }
        $model = M();
        $num = $model->query("SELECT COUNT(*) AS num FROM i_tixian a LEFT JOIN i_users b ON a.uid = b.id $where");
        $count = $num[0]['num'];
        $page = $this->page($count,20);
        $result = $model->query("SELECT a.id,a.money,a.status,a.type,a.bank_id,a.add_time,b.mobile FROM i_tixian a LEFT JOIN i_users b ON a.uid = b.id $where ORDER BY a.id DESC LIMIT ".$page->firstRow.",".$page->listRows);
        $this->assign(compact('page','mobile','result'));
        $this->display();
    }

    //修改用户提现记录
    public function change_tixian_status()
    {
        $id = I('get.id');
        $status = I('get.status');
        M('tixian')->where(array('id'=>$id))->save(array('status'=>$status)) ? $this->success('操作成功') : $this->error('操作失败');
    }

    //用户理财受益
    public function yhsy_history()
    {
        $begin = I('get.begin');
        $end = I('get.end');
        $mobile = I('get.mobile');
        $model = M();
        $where = " WHERE a.id >0 ";
        $mobile ? $where .= " AND b.mobile LIKE '%$mobile%'" : '';
        if ($begin && $end) {
            $where .= " AND a.add_time >= '$begin' AND a.add_time <= '$end'";
        } elseif ($begin && !$end) {
            $where .= " AND a.add_time >= '$begin'";
        } elseif (!$begin && $end) {
            $where .= " AND a.add_time <= '$end'";
        }
        $num = $model->query("SELECT COUNT(*) AS num FROM i_shouyi a LEFT JOIN i_users b ON a.uid = b.id $where");
        $count = $num[0]['num'];
        $page = $this->page($count,20);
        $result = $model->query("SELECT a.id,a.uid,a.money,a.add_time,a.type,b.mobile FROM i_shouyi a LEFT JOIN i_users b ON a.uid = b.id $where ORDER BY a.id DESC LIMIT ".$page->firstRow.",".$page->listRows);
        $this->assign(compact('page','result','begin','end','mobile'));
        $this->display();
    }
}
