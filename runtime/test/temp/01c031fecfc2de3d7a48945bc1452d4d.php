<?php /*a:1:{s:58:"D:\phpstudy_pro\WWW\thinkPHP\app\admin\view\admin\index.html";i:1680228543;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="file" enctype="multipart/form-data" method="post">
    <input type="file" name="image" /> <br>
    <input type="submit" value="上传" />
</form>

<table>
    <tr>
        <th>编号</th>
        <th>文件</th>
        <th>操作</th>
    </tr>
    <?php foreach($file as $k): ?>
    <tr>
        <td><?php echo htmlentities($k['file_id']); ?></td>
        <td><?php echo htmlentities($k['file_name']); ?></td>
        <td><button type="button" onclick="download_file('<?php echo htmlentities($k['file_name']); ?>')">下载</button></td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
<script>
    function download_file(file_name){
        window.location.href='test/download?file_name='+file_name;
    }
</script>
</html>