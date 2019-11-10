$(function () {

    $("#btn").click(function () {
        if (!input_check()) {
            return false;
        }
    });

    var $selectSubCategory = $('#subCategory');
    var original = $selectSubCategory.html();

    $('#category').change(function () {
        var selectCategory = $(this).val();
        $selectSubCategory.html(original).find('option').each(function () {
            var selectCategory_after = $(this).data('val');

            if (selectCategory != selectCategory_after) {
                $(this).not(':first-child').remove();
            }
        });

        if ($(this).val() == "") {
            $selectSubCategory.attr('disabled', 'disabled');
        } else {
            $selectSubCategory.removeAttr('disabled');
        }
    });

    $('#maker,#name,#category,#subCategory,#comment,#stock,#weight,#power,#imgs').focusin(function () {
        $(this).removeClass("input_error");
    })

});

function input_check() {
    var result = true;

    $("#maker").removeClass("input_error");
    $("#name").removeClass("input_error");
    $("#category").removeClass("input_error");
    $("#subCategory").removeClass("input_error");
    $("#comment").removeClass("input_error");
    $("#stock").removeClass("input_error");
    $("#weight").removeClass("input_error");
    $("#power").removeClass("input_error");
    $("#imgs").removeClass("input_error");

    $("#maker-error").empty();
    $("#name-error").empty();
    $("#category-error").empty();
    $("#subCategory-error").empty();
    $("#comment-error").empty();
    $("#stock-error").empty();
    $("#weight-error").empty();
    $("#power-error").empty();
    $("#imgs-error").empty();

    var maker = $("#maker").val();
    var name = $("#name").val();
    var category = $("#category").val();
    var subCategory = $("#subCategory").val();
    var comment = $("#comment").val();
    var stock = $("#stock").val();
    var weight = $("#weight").val();
    var power = $("#power").val();
    var imgs = $("#imgs").val();

    if (maker.length > 30) {
        $("#maker-error").text("メーカー名が長すぎます");
        $("#maker").addClass("input_error");
        result = false;
    }

    if (name == "") {
        $("#name-error").text("機材名を入力してください");
        $("#name").addClass("input_error");
        result = false;
    } else if (name.length > 30) {
        $("#name-error").text("機材名が長すぎます");
        $("#name").addClass("input_error");
        result = false;
    }

    if (category == "") {
        $("#category-error").text("カテゴリーを選択してください");
        $("#category").addClass("input_error");
        result = false;
    }

    if (subCategory == ""){
        $("#subCategory-error").text("サブカテゴリーを選択してください");
        $("#subCategory").addClass("input_error");
        result = false;
    }

    if (comment == "") {
        $("#comment-error").text("説明文を入力してください");
        $("#comment").addClass("input_error");
        result = false;
    }

    if (stock == "") {
        $("#stock-error").text("所持数を入力してください");
        $("#stock").addClass("input_error");
        result = false;
    }

    if (weight == "") {
        $("#weight-error").text("重量を入力してください");
        $("#weight").addClass("input_error");
        result = false;
    }

    if (power == "") {
        $("#power-error").text("消費電力を入力してください");
        $("#power").addClass("input_error");
        result = false;
    }

    if (imgs == "") {
        $("#imgs-error").text("画像を選択してください");
        $("#imgs").addClass("input_error");
        result = false;
    }

    if (!img_check()) {
        result = false;
    }

    return result;
}

function img_check() {

    //画像が3枚以上だとNG
    var img_num_flg = 0;
    var imgList = document.getElementById('imgs').files;
    if (imgList.length > 3) {
        img_num_flg = 1;
    }

    //サイズが3MBよりでかい場合はNG
    var img_size_flg = 0;
    for (i = 0; i < imgList.length; i++) {
        if (imgList[i].size > 3000000) {
            img_size_flg = 1;
        }
    }

    if (img_num_flg > 0) {
        $("#imgs-error").text("画像枚数が３枚を超えています");
    } else if (img_size_flg > 0) {
        $("#imgs-error").text("画像サイズが3MBを超えています");
    } else {
        return true;
    }
}
