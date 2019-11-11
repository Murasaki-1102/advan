$(function(){
    $("#btn").click(function(){
        if(!input_check()){
            return false;
        }
    });
});

function input_check(){
    var result = true;

    $("#mailAdress").removeClass("input_error");
    $("#account").removeClass("input_error");
    $("#grade").removeClass("input_error");
    $("#password").removeClass("input_error");
    $("#password_conf").removeClass("input_error");

    $("#mailAdress-error").empty();
    $("#account-error").empty();
    $("#grade-error").empty();
    $("#password-error").empty();
    $("#password_conf-error").empty();

    var mailAdress = $("#mailAdress").val();
    var account = $("#account").val();
    var grade = $("#grade").val();
    var password = $("#password").val();
    var password_conf = $("#password_conf").val();

    if (mailAdress == ""){
        $("#mailAdress-error").text("メールアドレスを入力してください");
        $("#mailAdress").addClass("input_error");
        result = false;
    } else if (!mailAdress.match(/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@(edu)+(.teu)+([a-zA-Z0-9\._-]+)+$/)) {
        $("#mailAdress-error").text("このメールアドレスは使えません");
        $("#mailAdress").addClass("input_error");
        result = false;
    }

    if (account == ""){
        $("#account-error").text("アカウント名を入力してください");
        $("#account").addClass("input_error");
        result = false;
    } else if (account.length > 10){
        $("#account-error").text("アカウント名は10文字以内で入力してください");
        $("#account").addClass("input_error");
        result = false;
    }

    if (grade == ""){
        $("#grade-error").text("学年を選択してください");
        $("#grade").addClass("input_error");
        result = false;
    }

    if (password == ""){
        $("#password-error").text("パスワードを入力してください");
        $("#password").addClass("input_error");
        $("#password_conf").addClass("input_error");
        result = false;
    } else if (!password.match(/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{5,100}$/i)){
        $("#password-error").text("パスワードは半角英数字の5文字以上30文字以下で入力して下さい");
        $("#password").addClass("input_error");
        $("#password_conf").addClass("input_error");
        result = false;
    } else if (password != password_conf){
        $("#password_conf-error").text("パスワードが一致していません");
        $("#password_conf").addClass("input_error");
        result = false;
    }
    return result;
}