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
					<?php
						echo $user->UserName . "欢迎你！";
					?>
				</td>
				<td>
					<a onclick="javascript:location.href='/user/logout.php'" class="easyui-linkbutton">退出</a>
				</td>
			</tr>
		</table>
	</div>
	<div data-options="region:'west',split:true,title:'West'" style="width:150px;padding:10px;">

	</div>
	<div data-options="region:'center',title:'Center'"></div>
</body>
</html>

