<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php $title ?></title>
</head>
<body>
	<?php $this->load->view('layout/header'); ?>
	<?php $this->load->view($content); ?>
	<?php $this->load->view('layout/footer'); ?>
</body>
</html>