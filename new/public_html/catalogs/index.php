<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог"); ?>
<!--  Content zone  -->
<!-- Catalog select -->
<div class="catalog-select">
    <div class="title-section">Каталоги запчастей</div>
    <div class="catalog-select-item">
        <a href="/catalog">
            <div class="block-title">Каталог <b>оригинальных</b> запчастей</div>
            <div class="image">
                <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/catalog-select/catalog-1.png" alt="">
            </div>
        </a>
    </div>
    <div class="catalog-select-item">
        <a href="/catalog?original=no">
            <div class="block-title">Каталог <b>неоригинальных</b> запчастей</div>
            <div class="image">
                <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/catalog-select/catalog-2.png" alt="">
            </div>
        </a>
    </div>
    <div class="catalog-select-item">
        <a href="/auto">
            <div class="block-title">Каталог запчастей <b>“US-PARTS”</b></div>
            <div class="image">
                <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/catalog-select/catalog-3.png" alt="">
            </div>
        </a>
    </div>
    <div class="catalog-select-item">
        <a href="/tires">
            <div class="block-title">Каталог <b>шин и дисков</b></div>
            <div class="image">
                <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/catalog-select/catalog-4.png" alt="">
            </div>
        </a>
    </div>
    <div class="catalog-select-item">
        <a href="/oil">
            <div class="block-title">Каталог <b>масел и автохимии</b></div>
            <div class="image">
                <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/catalog-select/catalog-5.png" alt="">
            </div>
        </a>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>