<?php

class Locality{
	//所在地ID
	public $LocalityId;

	//所在地名称
	public $LocalityName;

	//所在地父ID
	public $PLocalityId;

	//创建时间
	public $CreatedTime;

	//状态 0挂起，1正常
	public $LocalityStatus;
}

class Industry{
	//行业ID
  	public $IndustryId;

	//创建时间
	public $CreatedTime;

	//行业名称
	public $IndustryName;

	//父行业ID
	public $PIndustryId;

	//行业状态 0挂起，1启用
	public $IndustryStatus;
}
?>