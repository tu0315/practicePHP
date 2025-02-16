<?php require "header.php"; ?>
<?php
$add_money = 0;
switch($_REQUEST['seat']) {
    case 1:
        $add_money = 1500;
        break;
    case 2:
        $add_money = 2500;
        break;
    default:
        $add_money = 0;
        break;
}
?>
<!-- 名前入力 -->
<?php if(isset($_REQUEST['name'])) : ?>
    <p>ようこそ、<?php echo($_REQUEST['name']); ?>さん。</p>
<?php else: ?>
    <p class="error-message">名前が入力されていません。</p>
<?php endif; ?>
<button type="button" onclick="history.back()">戻る</button>
<!-- 性別選択 -->
<?php if(isset($_REQUEST['gender'])) : ?>
    <p>あなたの性別は、<?php echo($genders[$_REQUEST['gender']]); ?>です。</p>
<?php else: ?>
    <p class="error-message">性別が選択されていません。</p>
<?php endif; ?>
<button type="button" onclick="history.back()">戻る</button>
<!-- 座席選択 -->
 <?php if(isset($_REQUEST['seat'])) : ?>
    <p>あなたの座席は、<?php echo($seats[$_REQUEST['seat']]); ?>です。</p>
    <p>追加料金は<?php echo($add_money); ?>円です。</p>
<?php else: ?>
    <p class="error-message">座席が選択されていません。</p>
<?php endif; ?>
<button type="button" onclick="history.back()">戻る</button>
<?php require "footer.php"; ?>