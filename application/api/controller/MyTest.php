<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\admin\model\MyTest as MyModel;

/**
 * 示例接口
 */
class MyTest extends Api
{
    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
	 public function _initialize(){
		 parent ::_initialize();
	 }
    public function test()
    {
        $this->success('测试成功', $this->request->param());
    }

    public function getList()
    {
        $test_id   = $this->request->param('test_id');
        $test_age   = $this->request->param('test_age');
            if($test_id){
                $where['id'] = ['in',$test_id];
            }
              //$list = MyModel::where($where)->select();      
             //$list = MyModel::where($where)->order('age', 'desc')->select();
            //$list = MyModel ::where('age',$test_age)->order('age', 'desc')->select(); 
			$list = MyModel ::where(null,null)->order('age', 'desc')->select(); 
            if(!$list){
                $this->error('暂无数据');
            }
            
            //$this->success('成功',$list);
			$this->success('成功List',$list);
    }
	public function getTeamList()
	{
	    $this->success('获取队伍2', ['action' => 'test2']);
	}

    public function test2()
    {
        $this->success('测试成功2', ['action' => 'test2']);
    }

    public function test3()
    {
        $this->success('测试成功3', ['action' => 'test3']);
    }

}
