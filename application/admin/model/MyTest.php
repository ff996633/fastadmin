<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;
use app\admin\model\Team as TeamModel;
class MyTest extends Model
{

    use SoftDelete;

    

    // 表名
    protected $name = 'my_test';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';

    // 追加属性
    protected $append = [
        'status_text',
		'team_text'
    ];
     public function add()
	 {
	     echo('测试添加');
	 }

    //status获取器
    public function getStatusList()
    {
        return ['hot' => __('Hot'), 'new' => __('New'), 'old' => __('Old'), 'out' => __('Out')];
    }
	//status修改器
    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }
	
	/**
	 * 获取战队名
	 */
	public function team()
	{
		return $this->belongsTo('Team','team','id') -> setEagerlyType(0);
	}
	
	
	//team获取器
	public function getTeamList(){
		$list = TeamModel ::where(null)->field('name,id')->select(); 
		//saveJson($list);
	    //return $list;
		return $list;
	}
	//team获取器
	public function getTeamTextAttr($value, $data)
	{
	    $value = $value ? $value : (isset($data['name']) ? $data['name'] : '');
	    $list = $this->getTeamList();
	    return isset($list[$value]) ? $list[$value] : '';
	}
	
	//slogon获取器
	public function getSlogonList()
	{
	    return ['0' => __('hot'), '1' => __('New'), '2' => __('Old'), '3' => __('Out')];
	}
	//slogon获取器
	public function getSlogonTextAttr($value, $data)
	{
	    $value = $value ? $value : (isset($data['slogon']) ? $data['slogon'] : '');
	    $list = $this->getSlogonList();
	    return isset($list[$value]) ? $list[$value] : '';
	}




}
