<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use app\admin\model\MyTest as MyTestModel;

/**
 * 
 *
 * @icon fa fa-circle-o
 */
class MyTest extends Backend
{
    
    /**
     * MyTest模型对象
     * @var \app\admin\model\MyTest
     */
    protected $model = null;
	protected $categorylist = [];
	protected $relationSearch = true;

    public function _initialize()
    {
        parent::_initialize();
        //$this->model = new \app\admin\model\MyTest;
	    $newModel = $this->model = new MyTestModel();
		$this->view->assign("statusList", $newModel->getStatusList());
		$this->view->assign("teamList", $newModel->getTeamList());
		$this->view->assign("slogonList", $newModel->getSlogonList());
    }
	
	
	/**
	 * 查看
	 */
	public function index()
	{
	    //设置过滤方法
	    $this->request->filter(['strip_tags']);
	    if ($this->request->isAjax()) {
	        //如果发送的来源是Selectpage，则转发到Selectpage
	        if ($this->request->request('keyField')) {
	            return $this->selectpage();
	        }
	        list($where, $sort, $order, $offset, $limit) = $this->buildparams();
	        $total = $this->model
				->with('team')
	            ->where($where)
	            ->order($sort, $order)
	            ->count();
	
	        $list = $this->model
				->with('team')
	            ->where($where)
	            ->order($sort, $order)
	            ->limit($offset, $limit)
	            ->select();
	
	        $list = collection($list)->toArray();
	        $result = array("total" => $total, "rows" => $list);
	
	        return json($result);
	    }
	    return $this->view->fetch();
	}
	
	
	
	
	
	
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
	
	
	
	
	public function getNewTeamList()
	{	
		$keyValue = $this->request->request('keyValue');
		$newModel = $this->model = new MyTestModel();
		$row = $newModel -> getTeamList();
		$result = array ("list" => $row,'key' =>$keyValue );
		$newRow = [];
		if($this->request->request("keyValue")){
		    foreach($row as $item){
				if ($item['id'] == $keyValue){
					$newRow = ["name"=>$item['name'],"id" => $keyValue];
				}
			}
			// if ($keyValue == '选择'){
			// 	$newRow = ["name"=>"选择","id" => '999'];
			// }	
			$result = array ("list" => $newRow,'key' =>$keyValue);
		}
		return json($result); 
	}
	
	

	
    

}
