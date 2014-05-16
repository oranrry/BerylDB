<?php

//操作日志
class OperationLog{
	//操作日志ID
	public $OperationLogId;

	//操作类型 0查询，1增加，2修改，3删除
	public $OperationType;

	//操作数据类型 0未知，1公司，2项目，3人才
	public $OperationDataType;

	//操作日志内容
	public $OperationLogRemark;

	//创建时间
	public $CreatedTime;

	//操作人ID
	public $UserId;
}

?>