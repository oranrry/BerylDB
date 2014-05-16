<!DOCTYPE html>
<html lang="zh-CN" class="">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Beryl麾下人才查询系统</title>
	<link rel="stylesheet" type="text/css" href="/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="/easyui/demo/demo.css">
	<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="/easyui/jquery.easyui.min.js"></script>
	<?php  require_once($_SERVER["DOCUMENT_ROOT"]."/User/loginCheck.php");  ?>
</head>
<body class="easyui-layout">
	<div data-options="region:'north',border:false" style="height:55px;background:#B3DFDA;padding:10px">
		<table >
			<tr>
				<td>
					<?php echo $user->UserName . "欢迎你！"; ?>
				</td>
				<td>
					<a onclick="javascript:location.href='/user/logout.php'" class="easyui-linkbutton">退出</a>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
				<td>
					您最后登录的IP是：<?php echo $user->LastLoginIp;  ?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
				<td>
					最后登录的时间是：<?php echo $user->LastLoginTime;  ?>
				</td>
			</tr>
		</table>
	</div>
	<div data-options="region:'west',split:true,title:'菜单'" style="width:120px;padding:20px;">
		<table>
			<tr>
				<td style="padding-bottom: 20px;">
					<a onclick="javascript:$('#mainframe').attr('src','/Company/addCompany.html');" data-options="iconCls:'icon-large-construction',size:'large',iconAlign:'top'" class="easyui-linkbutton">新增公司</a>
				</td>
			</tr>
			<tr>
				<td style="padding-bottom: 20px;">
					<a onclick="javascript:$('#mainframe').attr('src','/Company/companyList.html');" data-options="iconCls:'icon-large-company',size:'large',iconAlign:'top'" class="easyui-linkbutton">管理公司</a>
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
			</tr>
		</table>


	</div>
	<div data-options="region:'center',title:'工作'">
		<iframe id="mainframe" name="mainframe" width="100%" height="100%" src="/User/welcome.html"></iframe>
	</div>
</body>
</html>

