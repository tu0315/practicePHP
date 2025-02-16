<?php require "header.php"; ?>
<?php
// DB接続、削除
$pdo = new PDO('mysql:host=localhost;dbname=practicePHP;charset=utf8','staff','password');
$sql = $pdo->prepare('delete from product where id = ?');
$sql->execute([$_GET['id']]);
?>

<p>削除が完了しました。</p>
<button onclick="location.href='list.php'">一覧画面へ</button>

<!-- フッターは共通 -->
<?php require "footer.php"; ?>