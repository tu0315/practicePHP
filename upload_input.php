<?php require "header.php"; ?>
<p>アップロードファイルを用意してください。</p>
<form action="upload_output.php" method="post" enctype="multipart/form-data">
    <p><input type="file" name="file"></p>
    <p><input type="submit" value="アップロード"></p>
</form>
<?php require "footer.php"; ?>