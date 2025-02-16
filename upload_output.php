<?php require "header.php"; ?>
<?php print_r($_FILES); ?>
<br>
<!-- ファイルがアップロードされているかチェック -->
<?php if(is_uploaded_file($_FILES['file']['tmp_name'])) {
    // ファイルあるいはディレクトリが存在するか。imagesディレクトリが存在しなければ作成する。
    if (!file_exists('images')){
        mkdir('images');
    }
    // basename:パスの最後にある名前の部分を返す
    $file = 'images/'.basename($_FILES['file']['name']);
    // アップロードされたファイル（第1引数）を新しい位置（第2引数）に移動する
    if (move_uploaded_file($_FILES['file']['tmp_name'], $file)) {
        echo($file . 'のアップロードに成功しました。');
        echo('<p><img src="' . $file . '"></p>');
    } else {
        echo('ファイルのアップロードに失敗しました。');
    }
} else {
    echo('ファイルを選択してください。');
}
?>
<?php require "footer.php"; ?>