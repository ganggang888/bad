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

    /*
     * 修改;
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
        $name = I('get.name');
        $term_id = I('get.term_id');
        $begin = I('get.begin');
        $end = I('get.end');
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
        $this->display();
    }

    /*
     * 修改信息
     */

    public function edit() {
        if (IS_POST) {
            if ($this->goods->create() !== false) {
                if ($this->add() !== false) {
                    $this->success('修改成功', U('Goods/index'));
                } else {
                    $this->error('修改失败', U('Goods/index'));
                }
            } else {
                $this->error($this->goods->getError());
            }
        }
        $id = I('get.id');
        $info = $this->goods->where("id=%f", array($id))->find();
        $this->assign(compact('info'));
        $this->display();
    }

    /*
     * 删除信息
     */

    public function delete() {
        $id = I('get.id');
        $id ? $this->goods->where("id = %f", array($id))->save(array('is_delete' => 1)) : $this->error('失败');
    }

    /*
     * 排序
     */

    public function listorders() {
        $ids = I('get.ids');
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
