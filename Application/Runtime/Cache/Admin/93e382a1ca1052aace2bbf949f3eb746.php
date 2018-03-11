<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<style type="text/css">
			table{margin: 0 auto;}
			td{width: 100px;text-align: center;}
			li{display: inline-block;border: 1px solid #ccc;padding: 10px;}
	</style>
	<title></title>
</head>
<body>
	
	<table border="2px" cellspacing="0" cellpadding="0" background="a.jpg">
		<caption fontsize="8">论坛中心</caption>
		<tr>
			<td>name</td>
			<td>email</td>
			<td>image</td>
			<td>password</td>
			<td>time</td>
			<td>审核</td>
		</tr>
		
		<?php foreach ($data as $key => $value) { ?>
		<tr>
			<td><?php echo $value['name'];?></td>
			<td><?php echo $value['email'];?></td>
			<td><img src="<?php echo '/Uploads/'.$value['image'];?>" width=100 height=auto></td>
			<td><?php echo $value['password']; ?></td>
			<td><?php echo $value['createtime']?></td>
			<td><?php if($value['status']==1) { ?>
						<a href="/Admin/UserCenter/line/id/<?php echo $value['id']?>">封号</a>
						<?php }else{ ?>
						<a href="/Admin/UserCenter/line/id/<?php echo $value['id']?>">解封</a>
						<?php } ?>
			</td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>