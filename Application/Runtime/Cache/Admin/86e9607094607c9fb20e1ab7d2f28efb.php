<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<h1>修改</h1>
	<form  action="/Admin/Blog/doEdit" method="post" enctype="multipart/form-data">
		分类： 
		<select name="classify_id" >
		<option >请选择</option>
		<?php foreach ($classify as $value) { ?>
		<option disabled="true"><?php echo $value['name']; ?></option>
			<?php foreach ($value['child'] as $v) { ?>
			<option value="<?php echo $v['id']; ?>" <?php if($data['classify_id'] == $v['id']){ ?>
			selected="selected" <?php } ?>>--<?php echo $v['name']; ?></option>
			<?php } ?>
		<?php } ?>
		</select>
		<br>
		标题: <input type="text" name="title" value="<?php echo ($data['title']); ?>">
		<br>
		<img src="<?php echo '/Uploads/'.$data['image'];?>" width=100 height=auto>
		图片： <input type="file" name="image"></br>
	    内容： <textarea name="content" rows="20" cols="100" ><?php echo $data['content'];?></textarea>
	    <input type="hidden" name="id" value="<?php echo $data['id'];?>">
	    <input type="hidden" name="imagePath" value="<?php echo $data['image'];?>">
		<br>	
		<input type="submit" name="">
	</form>
</body>
</html>