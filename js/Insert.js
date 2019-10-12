function input_check(){

  //画像が3枚以上だとNG
  var img_num_flg = 0;
  var imgList = document.getElementById('select_img').files;
  if(imgList.length > 3){
    img_num_flg = 1;
  }

  //サイズが3MBよりでかい場合はNG
  var img_size_flg  = 0;
  for(i = 0; i < imgList.length; i++){
    if(imgList[i].size > 3000000){
      img_size_flg = 1;
    }
  }

  if(img_num_flg > 0){
    window.alert('添付画像数が3枚を超えています');
  }else if(img_size_flg > 0){
    window.alert('投稿する画像のファイルサイズは3MB以下にしてください');
  }else{
    document.Insert.submit();
  }
}
