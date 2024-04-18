<?
$sql = "SELECT * FROM news ORDER BY created_at DESC";
$news = $connect->query($sql);
?>
<section class="main_body">
    <div class="content_bar">
        <div class="news_title_links">
            <p class="page_name-p">Новости</p>
        </div>
        <? foreach ($news as $newsItem) { ?>
            <div class="news_allview_item">
                <div class="news_preview">
                    <div class="news_allview_photo">
                        <img src="<?= $newsItem['image'] ?>" alt="<?= $newsItem['title'] ?>" class="news_photo">
                    </div>
                    <div class="news_allview_title"><?= $newsItem['title'] ?></div>
                </div>
                <div class="news_opened">
                    <div class="news_sec">
                        <div class="news_page_item">
                            <div class="news_item_title"><?= $newsItem['title'] ?></div>
                            <img src="<?= $newsItem['image'] ?>" alt="<?= $newsItem['title'] ?>" class="news_item_photo">
                            <div class="news_item_text"><?= $newsItem['body'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
        <? } ?>
    </div>
</section>
<script src="assets/js/main_for_news.js" defer></script>