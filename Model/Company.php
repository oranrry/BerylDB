<?php

class Corporation{
	//��˾ID
	public $CorporationId;

	//��˾����
	public $CorporationName;

	//��˾��ϸ��ַ
	public $Address;

	//��˾��ϵ�绰
	public $Telephone;

	//��ҵID
	public $IndustryId;

	//���ڵ�ID
	public $LocalityId;

	//����ʱ��
	public $CreatedTime;

	//����ʱ��
	public $UpdatedTime;

	//������ID
	public $CreatedUserId;

	//�޸���ID
	public $UpdatedUserId;
}

class CompanyIntroduction{
	//��˾����ID
	public $CompanyIntroductionId;

	//��˾���ܴ���ʱ��
	public $CreatedTime;

	//������ID
	public $CreatedUserId;

	//��������
	public $Content;

	//״̬ 0��������
	public $CompanyIntroductionStatus;
}

?>