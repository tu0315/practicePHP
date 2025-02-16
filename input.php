<?php require "header.php"; ?>
<!-- 名前入力 -->
<p>■名前を入力してください。</p>
<form action="output.php" method="post">
    <input type="text" name="name">
    <input type="submit" value="確定">
</form>
<!-- 性別選択 -->
<p>■性別を選択してください。</p>
<form action="output.php" method="post">
    <?php foreach($genders as $key => $value) : ?>
        <?php if($key == 0) : ?>
            <p><input type="radio" name="gender" value="<?php echo($key); ?>" checked> <?php echo($value) ?> </p>
        <?php else : ?>
            <p><input type="radio" name="gender" value="<?php echo($key); ?>"> <?php echo($value) ?> </p>
        <?php endif; ?>
    <?php endforeach; ?>
    <input type="submit" value="確定">
</form>
<!-- 座席選択 -->
<p>■座席を選択してください。</p>
<form action="output.php" method="post">
    <select name="seat">
        <?php foreach($seats as $key => $value) : ?>
            <option value="<?php echo($key); ?>"><?php echo($value) ?></option>
        <?php endforeach; ?>
    </select>
    <p><input type="submit" value="確定"></p>
</form>

<?php require "footer.php"; ?>