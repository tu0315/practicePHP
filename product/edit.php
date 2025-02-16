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

// DB接続
$pdo = new PDO('mysql:host=localhost;dbname=practicePHP;charset=utf8','staff','password');
if($pageFlag == 0){
    $sql = $pdo->prepare("select * from product where id = ?");
    $sql->execute([$_GET['id']]);
    $record = $sql->fetch(PDO::FETCH_ASSOC); // 返された際のカラム名で添字を付けた配列を返す

    $id    = $record['id'];
    $name  = (isset($_POST['name'])) ? $_POST['name'] : $record['name'];
    $price = (isset($_POST['price'])) ? $_POST['price'] : $record['price'];
}

if($pageFlag == 2){
    // 更新
    $sql = $pdo->prepare('UPDATE product SET name = ?, price = ? WHERE id = ?');
    $sql->execute([$_POST['name'], $_POST['price'], $_POST['id']]);
}
?>

<!-- 入力画面 -->
<?php if($pageFlag === 0) : ?>
    <h1>商品編集</h1>
    <form action="edit.php" method="post">
        <p>商品名：<input type="text" name="name" value="<?php echo($name); ?>"></p>
        <p class="error-message"><?php if(isset($error_msg['name'])) echo($error_msg['name']); ?></p>
        <p>価格：<input type="text" name="price" value="<?php echo($price); ?>"></p>
        <p class="error-message"><?php if(isset($error_msg['price'])) echo($error_msg['price']); ?></p>
        <input type="submit" name="confirm" value="確認">

        <input type="hidden" name="id" value="<?php echo($id) ;?>">
    </form>
<?php endif; ?>

<!-- 確認画面 -->
 <?php if($pageFlag === 1) : ?>
    <h1>確認画面</h1>
    <form action="edit.php" method="post">
        商品名：<?php echo $_POST['name']; ?><br>
        価格：<?php echo $_POST['price']; ?>円<br>

        <button><a href="edit.php?id=<?php echo $_POST['id']; ?>">戻る</a></button>
        <input type="submit" name="submit" value="更新">

        <input type="hidden" name="id" value="<?php echo($_POST['id']) ;?>">
        <input type="hidden" name="name" value="<?php echo($_POST['name']) ;?>">
        <input type="hidden" name="price" value="<?php echo($_POST['price']) ;?>">
    </form>
<?php endif; ?>

<!-- 完了画面 -->
 <?php if($pageFlag === 2) : ?>
    <p>更新が完了しました。</p>
    <button onclick="location.href='list.php'">一覧画面へ</button>
<?php endif; ?>

<!-- フッターは共通 -->
<?php require "footer.php"; ?>