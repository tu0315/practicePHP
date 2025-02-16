<?php require "header.php"; ?>
<?php require "validation.php"; ?>
<?php 

// ページフラッグ
$pageFlag = 0;

// バリデーション初期値
$error_msg = [];

// バリデーションチェック
if(isset($_POST['confirm'])){
    $error_msg = validation($_POST);
}

if(isset($_POST['confirm']) && empty($error_msg)){
    // 入力画面でエラーがなければ確認画面へ
    $pageFlag = 1;
}else if(!empty($_POST['submit'])){
    // 確認画面で問題なければ完了画面へ
    $pageFlag = 2;
}

if($pageFlag == 2){
    var_dump($_POST);
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
        <p>商品名：<input type="text" name="name" value="<?php if(isset($_POST['name'])){ echo $_POST['name']; } ?>"></p>
        <p class="error-message"><?php if(isset($error_msg['name'])) echo($error_msg['name']); ?></p>
        <p>価格：<input type="text" name="price" value="<?php if(isset($_POST['price'])){ echo $_POST['price']; } ?>"></p>
        <p class="error-message"><?php if(isset($error_msg['price'])) echo($error_msg['price']); ?></p>
        <input type="submit" name="confirm" value="登録">
    </form>
<?php endif; ?>

<!-- 確認画面 -->
 <?php if($pageFlag === 1) : ?>
    <h1>確認画面</h1>
    <form action="input.php" method="post">
        商品名：<?php echo $_POST['name']; ?><br>
        価格：<?php echo $_POST['price']; ?>円<br>

        <input type="submit" name="back" value="戻る">
        <input type="submit" name="submit" value="送信する">

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