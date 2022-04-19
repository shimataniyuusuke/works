<!-- File: templates/Articles/add.php -->

<h1>記事の追加</h1>
<?php
echo $this->Form->create($article);
// 今はユーザーを直接記述
echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
echo $this->Form->control('タイトル');
echo $this->Form->control('コンテンツ', ['rows' => '3']);
echo $this->Form->control('tags._ids', ['options' => $tags]);
echo $this->Form->button(__('記事の作成'));
echo $this->Form->end();
?>
