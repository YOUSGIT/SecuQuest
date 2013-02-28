<?php
$side_news = new News;
$side_news_arr = $side_news->get_all_front(3);
foreach ($side_news_arr as $v)
{
    ?>
    <li>
        <a href="news.php?id=<?= $v['id']; ?>" class="clearfix">
            <img src="<?= $side_news->get_pre_img($v['path']); ?>" width="60" />
            <h1><?= $v['title']; ?></h1>
        </a>
    </li>
    <?php
}
unset($side_news, $side_news_arr);