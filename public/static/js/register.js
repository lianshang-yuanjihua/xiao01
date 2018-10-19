/*用户名验证*/
function checkUser() {
  var user = $("#name_input").val();
  var reg = /^[a-zA-Z][a-zA-Z0-9]{3,15}$/;
  if (reg.test(user) == false) {
    layer.tips('用户名不正确', '#name_input', {
      tips: 3
    });
    return false;
  }
}
//   /*验证手机号码*/
function checkMobile() {
  var mobile = $("#tell_input").val();
  var regMobile = /^1\d{10}$/;
  if (regMobile.test(mobile) == false) {
    layer.tips('手机号码不正确，请重新输入', '#tell_input', {
      tips: 4
    });
    return false;
  }

}
  /*密码验证*/
  function checkPwd() {
    var pwd = $("#pwd_input").val();
    var reg = /^[a-zA-Z0-9]{4,10}$/;
    if (reg.test(pwd) == false) {
      layer.tips('密码不能含有非法字符，长度在4-10之间', '#pwd_input', {
        tips: 4
      });
      return false;
    }
    return true;
  }
/*确认密码*/
  function checkRepwd() {
    var pwd = $("#pwd_input").val();
    var rpwd = $("#rpwd_input").val();
    if (pwd != rpwd) {
      layer.tips('两次输入的密码不一致', '#pwd_input', {
        tips: 4
      });
      return false;
    }
    return true;
  }


  