$(function(){
    $("#btn").click(function(){
        if(!login_check()){
            return false;
        }
    });
});

function login_check(){
    var result = true;

    $("#mailAdress").removeClass("input_error");
    $("#password").removeClass("input_error");

    $("#mailAdress-error").empty();
    $("#password-error").empty();

    var mailAdress = $("#mailAdress").val();
    var password = $("#password").val();

    if (mailAdress == "") {
        $("#mailAdress-error").text("メールアドレスを入力してください");
        $("#mailAdress").addClass("input_error");
        result = false;
    } else if (!mailAdress.match(/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/)) {
        $("#mailAdress-error").text("正しいメールアドレスを入力してください");
        $("#mailAdress").addClass("input_error");
        result = false;
    }

    if (password == "") {
        $("#password-error").text("パスワードを入力してください");
        $("#password").addClass("input_error");
        result = false;
    } else if (!password.match(/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{5,100}$/i)) {
        $("#password-error").text("パスワードは半角英数字の5文字以上30文字以下で入力して下さい");
        $("#password").addClass("input_error");
        result = false;
    }
    return result;
}