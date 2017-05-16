<?php
/*
 *      _______ _     _       _     _____ __  __ ______
 *     |__   __| |   (_)     | |   / ____|  \/  |  ____|
 *        | |  | |__  _ _ __ | | _| |    | \  / | |__
 *        | |  | '_ \| | '_ \| |/ / |    | |\/| |  __|
 *        | |  | | | | | | | |   <| |____| |  | | |
 *        |_|  |_| |_|_|_| |_|_|\_\\_____|_|  |_|_|
 */
/*
 *     _________  ___  ___  ___  ________   ___  __    ________  _____ ______   ________
 *    |\___   ___\\  \|\  \|\  \|\   ___  \|\  \|\  \ |\   ____\|\   _ \  _   \|\  _____\
 *    \|___ \  \_\ \  \\\  \ \  \ \  \\ \  \ \  \/  /|\ \  \___|\ \  \\\__\ \  \ \  \__/
 *         \ \  \ \ \   __  \ \  \ \  \\ \  \ \   ___  \ \  \    \ \  \\|__| \  \ \   __\
 *          \ \  \ \ \  \ \  \ \  \ \  \\ \  \ \  \\ \  \ \  \____\ \  \    \ \  \ \  \_|
 *           \ \__\ \ \__\ \__\ \__\ \__\\ \__\ \__\\ \__\ \_______\ \__\    \ \__\ \__\
 *            \|__|  \|__|\|__|\|__|\|__| \|__|\|__| \|__|\|_______|\|__|     \|__|\|__|
 */
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace Portal\Controller;
use Common\Controller\HomebaseController; 
/**
 * 首页
 */
class IndexController extends HomebaseController {
	
	protected $goods = NULL;
	protected $term = NULL;
    public function _initialize() {
        parent::_initialize();
        $this->goods = D("Common/Goods");
        $this->term = D("Common/GoodsTerm");
    }
	public function index() {
        $a = call_user_func_array('getSomeMessage',array('users','2','mobile'));
        /*var_dump($a);
        var_dump(sp_password(123456));*/
    	//获取分类
        $termInfo = M('goods_term')->where(array('is_delete'=>0,'is_index'=>1,'parentid'=>0))->select();
        $id = I("get.term_id", 0, 'intval');
        $data = $this->term->where(array("id" => $id))->field($this->termField)->find();
        $tree = new \Tree();
        $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $terms = $this->term->where(array("id" => array("NEQ", $id)))->order(array("id" => "asc"))->select();

        $new_terms = array();
        foreach ($terms as $r) {
            $r['selected'] = $data['parentid'] == $r['id'] ? "selected" : "";
            $new_terms[] = $r;
        }

        $tree->init($new_terms);
        $tree_tpl = "<option value='\$id' \$selected>\$spacer\$name</option>";
        $tree = $tree->get_tree(0, $tree_tpl);

        $name = I('get.name'); //名称
        $term_id = I('get.term_id'); //分类ID
        $begin = I('get.begin'); //开始时间
        $end = I('get.end');//结束时间
        $status = I('get.status'); //状态
        $this->assign(compact('name','term_id','begin','end','status'));
        $begin ? $begin = $begin." 00:00:00" : '';
        $end ? $end = $end ." 23:59:59" : '';
        $term_id ? $where['a.term_id'] = $term_id : '';
        $name ? $where['a.name'] = array('like',"%$name%") : '';
        $where['a.is_delete'] = 0;
        $where['b.is_delete'] = 0;
        $where['a.indexs'] = 1;
        $where['a.member'] = 1;
        if ($begin && $end) {
            $where['a.add_time'] = array('EGT',$begin);
            $where['a.add_time'] = array('LT',$end);
        } elseif ($begin && !$end) {
            $where['a.add_time'] = array('EGT',$begin);
        } elseif (!$begin && $end) {
            $where['a.add_time'] = array('LT',$end);
        }

        $join = "".C('DB_PREFIX').'goods_term as b on a.term_id = b.id';
        $field = ['a.name','b.name AS term_name','a.photos_url','a.cost_price','a.selling_price','a.market_value','a.unit','a.stock','a.status','a.label','a.listorder','a.term_id','a.attribute','a.id','a.indexs','a.member','a.add_time','a.score'];
        $count = $this->goods->alias('a')->join($join,'LEFT')->where($where)->count();
        $page = $this->page($count,100);
        $result = $this->goods->alias('a')->join($join,'LEFT')->where($where)->field($field)->order(['listorder'=>asc])->limit($page->firsRow,$page->listRows)->select();
        array_map(function($vo) use (&$one,&$two){
        	if ($vo['indexs'] == 1) {
        		$one[] = $vo;
        	}
        	if ($vo['member'] == 1) {
        		$two[] = $vo;
        	}
        },$result);
        $index = 1;
        $this->assign(compact('page','result','tree','one','two','termInfo','index'));
        $this->display();
    }

    //商品列表
    public function goods()
    {
    	//获取分类
        $id = I("get.term_id", 0, 'intval');
        $data = $this->term->where(array("id" => $id))->field($this->termField)->find();
        $tree = new \Tree();
        $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $terms = $this->term->where(array("id" => array("NEQ", $id)))->order(array("id" => "asc"))->select();

        $new_terms = array();
        foreach ($terms as $r) {
            $r['selected'] = $data['parentid'] == $r['id'] ? "selected" : "";
            $new_terms[] = $r;
        }

        $tree->init($new_terms);
        $tree_tpl = "<option value='\$id' \$selected>\$spacer\$name</option>";
        $tree = $tree->get_tree(0, $tree_tpl);

        $name = I('get.name'); //名称
        $term_id = I('get.term_id'); //分类ID
        $begin = I('get.begin'); //开始时间
        $end = I('get.end');//结束时间
        $status = I('get.status'); //状态
        $this->assign(compact('name','term_id','begin','end','status'));
        $begin ? $begin = $begin." 00:00:00" : '';
        $end ? $end = $end ." 23:59:59" : '';
        $term_id ? $where['a.term_id'] = $term_id : '';
        $name ? $where['a.name'] = array('like',"%$name%") : '';
        $where['a.is_delete'] = 0;
        $where['b.is_delete'] = 0;
        if ($begin && $end) {
            $where['a.add_time'] = array('EGT',$begin);
            $where['a.add_time'] = array('LT',$end);
        } elseif ($begin && !$end) {
            $where['a.add_time'] = array('EGT',$begin);
        } elseif (!$begin && $end) {
            $where['a.add_time'] = array('LT',$end);
        }

        $join = "".C('DB_PREFIX').'goods_term as b on a.term_id = b.id';
        $field = ['a.name','b.name AS term_name','a.photos_url','a.cost_price','a.selling_price','a.market_value','a.unit','a.stock','a.status','a.label','a.listorder','a.term_id','a.id','a.indexs','a.member','a.add_time'];
        $count = $this->goods->alias('a')->join($join,'LEFT')->where($where)->count();
        $page = $this->page($count,15);
        $result = $this->goods->alias('a')->join($join,'LEFT')->where($where)->field($field)->order(['listorder'=>asc])->limit($page->firsRow,$page->listRows)->select();
        $this->assign(compact('page','result','tree'));
        $this->display();

    }

    //查看商品详细
    public function goodsInfo()
    {
    	$attributes = array(
		    array('name'=>'吃','son'=>array(array('name'=>'规格','info'=>'数量'))),
		    array('name'=>'穿','son'=>array(array('name'=>'尺码','info'=>'颜色'),array('name'=>'款式','info'=>'颜色'))),
		    array('name'=>'用','son'=>array(array('name'=>'规格','info'=>'颜色'))),
		);
    	$id = I('get.id');
    	$info = $this->goods->where("id=%f",array($id))->find();
    	$attribute = json_decode($info['attribute'],true);
    	array_map(function($vo)use(&$one,&$two){
    		$one[] = $vo['name'];
    		$two[] = $vo['info'];
    	},$attribute);
    	$one = array_unique($one);
    	$two = array_unique($two);
        $address_id = M('address')->where(array('uid'=>$_SESSION['user']['id']))->order(array('listorder'=>'DESC'))->getField('id');
    	$this->assign(compact('info','attributes','one','two','address_id'));
    	$this->display();
    }

    function goodClick()
    {
    	$id = I('get.id');
    	$name = intval(I('get.name'));
    	$attribute = M('goods')->where("id=%f",array($id))->getField('attribute');
    	$attribute = json_decode($attribute,true);
    	$data = '';
    	array_map(function($vo) use (&$data,$name){
    		if ($vo['name'] == $name) {
    			$data .= "<li><a href='javascript:;'>$vo[info]</a></li>";
    		}
    	},$attribute);
    	$data .= "<script type='text/javascript' src='getInfo.js' ></script>";
    	echo $data;exit;
    }

    //商品加入购物车
    public function addCart()
    {
    	$id = I('get.id');
    	$good_name = I('get.good_name');
    	$pic = I('get.pic');
    	$name = I('get.name');
    	$info = I('get.info');
    	$all_cart = $_SESSION['cat'];
    	//计算已有商品数量
    	//查找是否存在
    	$i='';
    	foreach ($all_cart as $key=>$vo) {
    		$i += $vo['count'];
    		if ($vo['good_name'] == $good_name && $vo['name'] == $name && $vo['info'] == $info && $vo['id'] == $id) {
    			$vo['count'] = $vo['count'] + 1;
    		}
    		$data[] = $vo;
    	}
    	$_SESSION['cat'] = $data;
    	echo $i;
    }

    //商品购物车1+2-操作
    public function caozuo()
    {
    	$type = I('get.type');
    	$keys = I('get.key');
    	$all_cart = $_SESSION['cat'];
    	switch ($type) {
    		case 1:
    			foreach ($all_cart as $key=>$vo) {
		    		if ($keys == $key) {
		    			$vo['count'] = $vo['count'] - 1;
		    		}
		    	}
    			break;
    		
    		default:
    			# code...
    			break;
    	}
    }

    //
    public function Cart()
    {
    	$this->display();
    }

    public function chat()
    {
    	set_time_limit(0);
    	$array = array('聊天系统可以刷','聊天系统有漏洞','聊天系统可以刷','聊天系统可以刷','聊天系统有漏洞');
    	$j=0;
    	for ($i=1;$i<=10;$i++) {
    		$info = postRequest("http://115.29.190.253:4999/sdkChat",array('data'=>'{"Action":"sdkNewMsg","Message":"'.$array[array_rand($array)].'","ConnectionId":"a0dbdd2d-4adf-473e-bf2a-4594c5cb7618","ContentType":"text"}'));
    		$info =json_decode($info,true);
    		var_dump($info);exit;
    		if ($info['Succeed'] == true) {
    			$j++;
    		}
    	}
    	var_dump($j);
    }

    //订单列表
    public function good_list()
    {
        //获取分类
        $id = I("get.term_id", 0, 'intval');
        $pid = I('get.pid');
        $termInfo = M('goods_term')->where(array('is_delete'=>0,'parentid'=>$pid))->select();
        $data = $this->term->where(array("id" => $id))->field($this->termField)->find();
        $tree = new \Tree();
        $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $terms = $this->term->where(array("id" => array("NEQ", $id)))->order(array("id" => "asc"))->select();

        $new_terms = array();
        foreach ($terms as $r) {
            $r['selected'] = $data['parentid'] == $r['id'] ? "selected" : "";
            $new_terms[] = $r;
        }

        $tree->init($new_terms);
        $tree_tpl = "<option value='\$id' \$selected>\$spacer\$name</option>";
        $tree = $tree->get_tree(0, $tree_tpl);

        $name = I('get.name'); //名称
        $term_id = I('get.term_id'); //分类ID
        $begin = I('get.begin'); //开始时间
        $end = I('get.end');//结束时间
        $status = I('get.status'); //状态
        $this->assign(compact('name','term_id','begin','end','status'));
        $begin ? $begin = $begin." 00:00:00" : '';
        $end ? $end = $end ." 23:59:59" : '';
        $term_id ? $where['a.term_id'] = $term_id : '';
        $name ? $where['a.name'] = array('like',"%$name%") : '';
        $where['a.is_delete'] = 0;
        $where['b.is_delete'] = 0;
        if ($pid && !$term_id) {
            //查处所有下级子类
            $ids = M('goods_term')->where(array('parentid'=>$pid))->field(array('id'))->select();
            foreach ($ids as $vo) {
                $data[] = $vo['id'];
            }
            $where['a.term_id'] = array('in',$data);
        }
        if ($begin && $end) {
            $where['a.add_time'] = array('EGT',$begin);
            $where['a.add_time'] = array('LT',$end);
        } elseif ($begin && !$end) {
            $where['a.add_time'] = array('EGT',$begin);
        } elseif (!$begin && $end) {
            $where['a.add_time'] = array('LT',$end);
        }
        $join = "".C('DB_PREFIX').'goods_term as b on a.term_id = b.id';
        $field = ['a.name','b.name AS term_name','a.score','a.photos_url','a.cost_price','a.attribute','a.selling_price','a.market_value','a.unit','a.stock','a.status','a.label','a.listorder','a.term_id','a.huangjin','a.id','a.indexs','a.member','a.add_time'];
        $count = $this->goods->alias('a')->join($join,'LEFT')->where($where)->count();
        $page = $this->page($count,2000);
        $result = $this->goods->alias('a')->join($join,'LEFT')->where($where)->field($field)->order(['listorder'=>asc])->limit($page->firsRow,$page->listRows)->select();
        //查找出是否所有库存为0
        $result = array_filter($result,function($v){
            $check = json_decode($v['attribute'],true);
            $find = array_filter($check,function($f){return $f['stock'] == 0;});
            $find ? $v['status'] = 0 : $v['status'] = 1;
            return 1;
        });
        //var_dump($result);
        $attributes = $this->attribute;
        $shangpin = 1;
        $this->assign(compact('page','result','tree','attributes','termInfo','shangpin','pid'));
        $this->display();
    }

    //新闻列表页
    public function news_list()
    {
        $this->display();
    }

    //新闻详细页
    public function news_page()
    {
        $article_id = I('get.id');

        $posts_model=M("Posts");
        
        $article=$posts_model
        ->alias("a")
        ->field('a.*,c.user_login,c.user_nicename,b.term_id')
        ->join("__TERM_RELATIONSHIPS__ b ON a.id = b.object_id")
        ->join("__USERS__ c ON a.post_author = c.id")
        ->where(array('a.id'=>$article_id))
        ->find();
        $this->assign(compact('article'));
        $this->display();
    }

    //每日收益
    public function shouyi_licai()
    {
        //读取系统配置信息
        $data = M('data')->where(array('id'=>1))->getField('data');
        $data = json_decode($data,true);
        $result = M('users')->where(array('user_type'=>2))->order(array('level'=>'desc'))->select();
        $date = date("Y-m-d");
        
        foreach ($result as $vo) {
            //任何用户充值的金币都可以提现
            //达到金币可提现情况
            //检查是否存在
            
            if ($vo['gold'] >= $data['jinbi']) {
                //计算收益一年按365天算  1金币等于 2 可提现积分
                $today_get =  ($vo['gold'] * ($data['jinbi_shouyi'] / 100)) / 365;
                $today_get = $today_get * 2;
                $today_get = sprintf("%.2f", $today_get); 
                $check = M('shouyi')->where(array('add_time'=>$date,'type'=>1,'uid'=>$vo['id']))->getField('id');
                if (!$check) {
                    $model = M();
                    $model->startTrans();
                    $one = $model->execute("UPDATE i_users SET can_monery = can_monery + $today_get WHERE id = '{$vo['id']}'");
                    $two = $model->execute("INSERT INTO i_shouyi (uid,money,add_time,type) VALUES ('{$vo['id']}','$today_get',now(),1)");
                    if ($one && $two) {
                        $model->commit();
                    } else {
                        $model->rollback();
                    }
                }
                
            }

            //如果是代理商，并且有冻结金额
            if ($vo['dong'] && $vo['level'] == 5) {
                //如果是代理商则算每日收益
                $today_get =  ($vo['score'] * ($data['daili_shouyi'] / 100)) / 365;
                $today_get = sprintf("%.2f", $today_get);
                $check = M('shouyi')->where(array('add_time'=>$date,'type'=>2,'uid'=>$vo['id']))->getField('id');
                if (!$check) {
                    $model = M();
                    $model->startTrans();
                    $one = $model->execute("UPDATE i_users SET can_monery = can_monery + $today_get WHERE id = '{$vo['id']}'");
                    $two = $model->execute("INSERT INTO i_shouyi (uid,money,add_time,type) VALUES ('{$vo['id']}','$today_get',now(),2)");
                    if ($one && $two) {
                        $model->commit();
                    } else {
                        $model->rollback();
                    }
                }
            }
        }
    }

}


