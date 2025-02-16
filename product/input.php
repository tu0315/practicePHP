<?php require "header.php"; ?>
<?php require "validation.php"; ?>
<?php 
// セッション開始 セッション：Webサイトにアクセスしてから離脱するまでの通信の単位
session_start();

// ページフラッグ
$pageFlag = 0;

// バリデーション初期値
$error_msg = [];

// バリデーションチェック
if(isset($_POST['confirm'])){
    $error_msg = validation($_POST);
}

// 確認画面から入力画面に戻ってきた場合、または初回表示時用にセッションから値を取得する
$name  = isset($_SESSION['input_data']['name']) ? $_SESSION['input_data']['name'] : '';
$price = isset($_SESSION['input_data']['price']) ? $_SESSION['input_data']['price'] : '';

// セッションに保存した入力データを削除
unset($_SESSION['input_data']);

// 入力画面から登録ボタンが押され、エラーがなければ確認画面へ
if(isset($_POST['confirm']) && empty($error_msg)){
    // 遷移の際、セッションに入力データを保存
    $_SESSION['input_data'] = $_POST;
    $pageFlag = 1;
}else if(!empty($_POST['submit'])){
    // 確認画面で問題なければ完了画面へ
    $pageFlag = 2;
}

if($pageFlag == 2){
    // DB接続し、追加処理
    $pdo = new PDO('mysql:host=localhost;dbname=practicePHP;charset=utf8','staff','password');
    $sql = $pdo->prepare('insert into product values(null, ?, ?)');
    $sql->execute([$_POST['name'], $_POST['price']]);
}
?>

<!-- 入力画面 -->
<?php if($pageFlag === 0) : ?>
    <h1>商品新規登録</h1>
    <form action="input.php" method="post">
        <p>商品名：<input type="text" name="name" value="<?php echo $name; ?>"></p>
        <p class="error-message"><?php if(isset($error_msg['name'])) echo($error_msg['name']); ?></p>
        <p>価格：<input type="text" name="price" value="<?php echo $price; ?>"></p>
        <p class="error-message"><?php if(isset($error_msg['price'])) echo($error_msg['price']); ?></p>
        <input type="submit" name="confirm" value="確認">
    </form>
<?php endif; ?>

<!-- 確認画面 -->
 <?php if($pageFlag === 1) : ?>
    <h1>確認画面</h1>
    <form action="input.php" method="post">
        商品名：<?php echo $_POST['name']; ?><br>
        価格：<?php echo $_POST['price']; ?>円<br>

        <input type="submit" name="back" value="戻る">
        <input type="submit" name="submit" value="登録">

        <input type="hidden" name="name" value="<?php echo($_POST['name']) ;?>">
        <input type="hidden" name="price" value="<?php echo($_POST['price']) ;?>">
    </form>
<?php endif; ?>

<!-- 完了画面 -->
 <?php if($pageFlag === 2) : ?>
    <p>登録が完了しました。</p>
    <button onclick="location.href='list.php'">一覧画面へ</button>
<?php endif; ?>

<!-- フッターは共通 -->
<?php require "footer.php"; ?>