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
    	$this->display(":index");
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
        var_dump($result);
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
    	$this->assign(compact('info','attributes'));
    	$this->display();
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

}


