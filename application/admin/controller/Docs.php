<?php
// +----------------------------------------------------------------------
// | Description: api文档接口
// +----------------------------------------------------------------------
// | Author: linchuangbin <linchuangbin@honraytech.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use think\Db;
use app\common\controller\ApiCommon;


class Docs extends ApiCommon
{
    public function index()
    {   
        $param = $this->param;
        $map = [];
        if ($param['parent'] === '0') {
            $map['parent'] = 0;
        }
        $cat = new \com\Category('admin_doc', array('id', 'parent', 'name', 'title'));
        $data = $cat->getList($map, 0, 'id');
        return resultArray(['data' => $data]);
    }

    public function read()
    {   
        $param = $this->param;
        $data = Db::name('admin_doc')->where('id', $param['id'])->find();
        if (!$data) {
            return resultArray(['error' => '数据不存在']);
        }
        return resultArray(['data' => $data]);
    }

    public function save()
    {   
        $param = $this->param;
        if (empty($param['name'])) {
            return resultArray(['error' => '请输接口名称']);
        }
        try {
            Db::name('admin_doc')->insert($param);
            return resultArray(['data' => '添加成功']);
        } catch (\Exception $e) {
            
            return resultArray(['data' => '添加失败，请刷新重试']);
        }
    }

    public function update()
    {
        $param = $this->param;
        if (empty($param['name'])) {
            return resultArray(['error' => '请输接口名称']);
        }
        try {
            Db::name('admin_doc')->where('id', $param['id'])->update($param);
            return resultArray(['data' => '修改成功']);
        } catch (\Exception $e) {
            
            return resultArray(['data' => '修改失败，请刷新重试']);
        }
    }

    public function delete()
    {
        $param = $this->param;
        try {
            Db::name('admin_doc')->where('id', $param['id'])->delete();
            return resultArray(['data' => '删除成功']);
        } catch (\Exception $e) {
            
            return resultArray(['data' => '删除失败，请刷新重试']);
        }          
    }
}
