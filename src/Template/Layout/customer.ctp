<!DOCTYPE html>
<html lang="ja">
<head>
	<?=$this->Html->charset('utf-8'); ?>
	<title>入金管理システム</title>
	<!-- スタイルシート -->
	<?php
	echo $this->Html->css('jquery-ui');
	echo $this->Html->css('bootstrap');
	echo $this->Html->css('layout');
	echo $this->Html->css('style');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
</head>

<body>
<!-- タイトルバー -->
<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
  <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="/customers">入金管理システム</a>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
	<a class="user-address" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">ログイン中　：　abc@defghij.jp</a>
	<div class="dropdown-menu">
	  <a class="dropdown-item" href="#">ログアウト</a>
	</div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row">
  <!-- サイドメニュー -->
    <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="/customers">顧客データ<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">入金データ</a>
        </li>
      </ul>

      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link" href="#">管理者データ</a>
        </li>
      </ul>
    </nav>

	<!-- メインコンテンツ -->
	<?=$this->fetch('content') ?>

  </div>
</div>
	<!-- スクリプト -->
	<?php
	echo $this->Html->script('jquery-3.1.1');
	echo $this->Html->script('jquery-ui');
	echo $this->Html->script('tether');
	echo $this->Html->script('bootstrap');
	echo $this->Html->script('table_size');
	?>
</body>
</html>