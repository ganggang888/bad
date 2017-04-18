<?php

/*
 * 商品以及商品分类处理
 */

namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class GoodsController extends AdminbaseController {

    protected $term = NULL;
    protected $goods = NULL;
    protected $termField = ['id', 'name', 'parentid', 'status'];

    public function _initialize() {
        parent::_initialize();
        $this->term = D("Common/GoodsTerm");
        $this->goods = D("Common/Goods");
    }

    //分类首页
    public function term_index() {
        $where['is_delete'] = 0;
        $result = $this->term->where($where)->field($this->termField)->select();
        $tree = new \Tree();
        $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        foreach ($result as $r) {
            $r['str_manage'] = '<a href="' . U('Goods/term_add', array('parentid' => $r['id'])) . '">添加子分类</a> | <a href="' . U('Goods/term_edit', array('id' => $r['id'])) . '">修改</a> | <a href="' . U('Goods/term_delete', array('id' => $r['id'])) . '">删除</a>';
            $url = U('portal/list/index', array('id' => $r['term_id']));
            $r['url'] = $url;
            $r['id'] = $r['id'];
            $r['parentid'] = $r['parentid'];
            $r['status'] == 1 ? $r['status'] = '启用' : $r['status'] = '禁用';
            $array[] = $r;
        }

        $tree->init($array);

        $str = "<tr>
            <td>\$spacer \$name</td>
	    			<td>\$status</td>
					<td>\$str_manage</td>
				</tr>";
        $taxonomys = $tree->get_tree(0, $str);
        
        $this->assign(compact('taxonomys'));
        $this->display();
    }

    /*
     * 添加
     */

    public function term_add() {
        if (IS_POST) {
            if ($this->term->create() !== false) {
                if ($this->term->add() !== false) {
                    $this->success('添加成功', U('Goods/term_index'));
                } else {
                    $this->error('添加失败', U('Goods/term_index'));
                }
            } else {
                $this->error($this->term->getError());
            }
        }
        $parentid = I("get.parentid", 0, 'intval');
        $tree = new \Tree();
        $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $terms = $this->term->order(array("id" => "asc"))->select();

        $new_terms = array();
        foreach ($terms as $r) {
            $r['selected'] = (!empty($parentid) && $r['id'] == $parentid) ? "selected" : "";
            $new_terms[] = $r;
        }
        $tree->init($new_terms);
        $tree_tpl = "<option value='\$id' \$selected>\$spacer\$name</option>";
        $tree = $tree->get_tree(0, $tree_tpl);
        
        $this->assign(compact('tree', 'parentid'));
        $this->display();
    }

    /**
     * [修改]
     * @return [type] [description]
     */
    public function term_edit() {
        if (IS_POST) {
            if ($this->term->create() !== false) {
                if ($this->term->save() !== false) {
                    $this->success('修改成功', U('Goods/term_index'));
                } else {
                    $this->error('修改失败', U('Goods/term_index'));
                }
            } else {
                $this->error($this->term->getError());
            }
        }
        $id = I("get.id", 0, 'intval');
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
        $this->assign(compact('tree', 'data'));
        $this->display();
    }

    /*
     * 删除菜单
     */

    public function term_delete() {
        $id = I('get.id');
        $id ? $this->term->where("id=%d", array($id))->save(array('is_delete' => 1)) : $this->error('参数出错');
    }
    


    /*
     * 商品首页
     */

    public function index() {

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
        $field = ['a.name','b.name AS term_name','a.photos_url','a.cost_price','a.selling_price','a.market_value','a.unit','a.stock','a.status','a.label','a.listorder','a.term_id','a.id','a.index','a.member','a.add_time'];
        $count = $this->goods->alias('a')->join($join,'LEFT')->where($where)->count();
        $page = $this->page($count,15);
        $result = $this->goods->alias('a')->join($join,'LEFT')->where($where)->field($field)->order(['listorder'=>asc])->limit($page->firsRow,$page->listRows)->select();
        $this->assign(compact('page','result','tree'));
        $this->display();
    }

    /*
     * 添加商品
     */

    public function add() {
        if (IS_POST) {
            if ($this->goods->create() !== false) {
                if ($this->goods->add() !== false) {
                    $this->success('添加成功', U('Goods/index'));
                } else {
                    $this->error('添加失败', U('Goods/index'));
                }
            } else {
                $this->error($this->goods->getError());
            }
        }
        $tree = new \Tree();
        $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $terms = $this->term->order(array("id" => "asc"))->select();

        $new_terms = array();
        foreach ($terms as $r) {
            $r['selected'] = (!empty($parentid) && $r['id'] == $parentid) ? "selected" : "";
            $new_terms[] = $r;
        }
        $tree->init($new_terms);
        $tree_tpl = "<option value='\$id' \$selected>\$spacer\$name</option>";
        $tree = $tree->get_tree(0, $tree_tpl);
        $this->assign(compact('tree'));
        $this->display();
    }

    /*
     * 修改信息
     */

    public function edit() {
        if (IS_POST) {
            if ($this->goods->create() !== false) {
                if ($this->goods->save() !== false) {
                    $this->success('修改成功', U('Goods/index'));
                } else {
                    $this->error('修改失败', U('Goods/index'));
                }
            } else {
                $this->error($this->goods->getError());
            }
        }
        $tree = new \Tree();
        $id = I("get.id");
        $info = $this->goods->where("id=%f", array($id))->find();
        $info['photos_url'] ? $info['photos_url'] = json_decode($info['photos_url'],true) : '';

        $result = $this->term->select();
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $info['term_id'] ? 'selected' : '';
            $array[] = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $select_categorys = $tree->get_tree(0, $str);
        $this->assign(compact('info','select_categorys'));
        $this->display();
    }

    /*
     * 删除信息
     */

    public function delete() {
        $id = I('post.ids');
        !$id ? $this->error('没有选择') : '';
        $this->goods->where(array('id'=>array('in',$id)))->save(['is_delete'=>1]) ? $this->success('成功') : $this->error('失败');
    }

    /*
     * 排序
     */

    public function listorders() {
        $listorders = I('post.listorders');
        $caseThen = '';$i = '';
        $i = '';
        foreach ($listorders as $key=>$vo) {
            $caseThen .= " WHEN $key THEN $vo \n";
            $i .= "$key,";
        }
        $i = substr($i,0,strlen($i)-1);
        if ($i && $caseThen) {
            $sql = " UPDATE ".C('DB_PREFIX')."goods SET listorder = CASE id $caseThen \n END \n WHERE ID IN($i)";
            $try = M()->execute($sql);
        }
    }

    /**
     * [首页以及会员专区推荐]
     * @param [int] $type 1首页推荐 2 会员推荐 3上下架
     * @param [int] $status 1推荐、上架 0取消推荐、下架
     * @param [array] $data   [description]
     */
    public function changeStatus()
    {
        $type = I('get.type');
        $status = I('get.status');
        $ids = I('post.ids');
        !$ids || !$type ? $this->error('缺少参数') : '';
        if ($this->goods->Recommend($type,$status,$ids)) {
            $this->success('成功');
        } else {
            $this->error('失败');
        }
    }
    /**
     * 获取菜单深度
     * @param $id
     * @param $array
     * @param $i
     */
    protected function _get_level($id, $array = array(), $i = 0) {

        if ($array[$id]['parentid'] == 0 || empty($array[$array[$id]['parentid']]) || $array[$id]['parentid'] == $id) {
            return $i;
        } else {
            $i++;
            return $this->_get_level($array[$id]['parentid'], $array, $i);
        }
    }

}
