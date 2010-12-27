<?php if(!empty($tweet)) : ?>

<div id="zen_tweet" class="sideBoxContent centeredContent">
	<h2><?php echo MODULE_ZEN_TWEET_TITLE; ?></h2>
<?php foreach($tweet as $val) : ?>
	<p class="date"><?php echo date("YÇ¯m·îdÆü H:i:s", strtotime($val['date'])); ?></p>
	<p class="tweet"><?php echo $val['text']; ?></p>
	<hr />
<?php endforeach; ?>
</div>

<?php endif; ?>