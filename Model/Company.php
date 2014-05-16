<?php

class Corporation{
	//公司ID
	public $CorporationId;

	//公司名称
	public $CorporationName;

	//公司详细地址
	public $Address;

	//公司联系电话
	public $Telephone;

	//行业ID
	public $IndustryId;

	//所在地ID
	public $LocalityId;

	//创建时间
	public $CreatedTime;

	//更新时间
	public $UpdatedTime;

	//创建人ID
	public $CreatedUserId;

	//修改人ID
	public $UpdatedUserId;
}

class CompanyIntroduction{
	//公司介绍ID
	public $CompanyIntroductionId;

	//公司介绍创建时间
	public $CreatedTime;

	//创建人ID
	public $CreatedUserId;

	//介绍内容
	public $Content;

	//状态 0挂起，正常
	public $CompanyIntroductionStatus;
}

?>