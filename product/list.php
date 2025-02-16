<?php require "header.php"; ?>
<?php
// DB接続
$pdo = new PDO('mysql:host=localhost;dbname=practicePHP;charset=utf8','staff','password');

if(isset($_POST['keyword'])){
    $statement = $pdo->prepare('SELECT * FROM product WHERE name LIKE :keyword');
    $keyword = '%' . $_POST['keyword'] . '%';
    // ;keywordに変数をセット、明示的に文字列型を指定
    $statement->bindValue(':keyword', $keyword, PDO::PARAM_STR);
    $statement->execute();
    $products = $statement->fetchAll();
} else {
    // 商品一覧取得
    $products = $pdo->query('select * from product');
}

?>

<h1>商品一覧</h1>
商品名で検索
<form method="post">
    <input type="text" name="keyword">
    <input type="submit" value="検索">
</form>
<button onclick="location.href='input.php'">新規登録</button>
<table border="1">
    <tr>
        <th>商品ID</th>
        <th>商品名</th>
        <th>価格</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($products as $row) : ?>
        <tr>
            <td><?php echo($row['id']); ?></td>
            <td><?php echo($row['name']); ?></td>
            <td><?php echo($row['price']); ?>円</td>
            <td><a href="edit.php?id=<?php echo $row['id']; ?>">編集</a></td>
            <td><a href="delete.php?id=<?php echo $row['id']; ?>">削除</a></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php require "footer.php"; ?>