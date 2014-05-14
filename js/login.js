function ShowErrorMsg(msg)
{
	$("#divAlert").show();
	$("div.alert-danger").html("<img src='/easyui/themes/icons/no.png'/>&nbsp;&nbsp;" + msg);
}

function HideErrorMsg()
{
	$("#divAlert").hide();
	$("div.alert-danger").html();
}

$(document).ready(function () {
	$(".btn-success").click(function(){
		var loginName = $("#login_name").val();
		var loginPWD = $("#login_password").val();
		if(loginName.length < 1)
		{
			ShowErrorMsg("请输入用户名！");
			return;
		}
		if(loginPWD.length < 1)
		{
			ShowErrorMsg("请输入密码！");
			return;
		}
		$.ajax({
			url: "/User/login.php",
			data: "login_name=" +loginName + "&login_password=" + loginPWD,
			type: "POST",
			success:function(data)
			{
				if(data == "1")
				{
					location.href='../index.php';
					return;
				}
				else if(data && data.length > 0)
				{
					ShowErrorMsg(data);
					return;
				}
				else
				{
					ShowErrorMsg("登陆出错请稍后再试！");
					return;
				}
			}
		})
	});

	$("input.form-control").keydown(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
    	if(keycode == '13'){
    		$(".btn-success").click();
		}
		else{
			HideErrorMsg();
		}
	})
});