<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>
<!--  Content zone  -->
<!-- Promotions -->
<div class="promotions">
    <div class="title-section">Акции</div>
    <div class="row">
        <div class="promotions-block">
            <div class="promotion-item">
                <div class="promotion-title"><b>СКИДКА 20%</b> на запчасти для Audi A4</div>
                <div class="slider">
                    <div class="row">
                        <div class="slider-items owl-carousel owl-theme">
                            <div class="slider-item">
                                <div class="image">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/promotions/audi.png" alt="audi.png">
                                </div>
                            </div>
                        </div>
                        <div class="nav-block">
                            <div class="dots">
                                <div class="nav left"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
                                <? for ($i = 0; $i < 1; $i++){ ?>
                                    <span data-index="<?=$i?>"></span>
                                <? } ?>
                                <div class="nav right"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(function () {
                        $(".slider-items").owlCarousel({
                            'items' : 1,
                            'nav'   : false,
                            'dots'  : false
                        });
                    })
                </script>
                <h2>Бесплатная доставка запчастей по Москве в пределах МКАД при покупке от 3000р.! Доставка до транспортной компании бесплатно!</h2>
                <div class="text">
                    <p>Lorem ipsum dolor sit amet, at eum dicta ancillae, eu tale torquatos vis. Ut adhuc euismod nam, ex pri dolore saperet veritus, pro postea dicunt oblique ut. Sit ad alii dicit, quis timeam ut quo. Latine insolens ei per. Ex eos lorem eripuit dolores.</p>
                    <p>Et quo illud omittantur. Vim admodum elaboraret at, id sonet dissentiet eos.Lorem ipsum dolor sit amet, at eum dicta ancillae, eu tale torquatos vis. Ut adhuc euismod nam, ex pri dolore saperet veritus, pro postea dicunt oblique ut. Sit ad alii dicit, quis timeam ut quo. Latine insolens ei per. Ex eos lorem eripuit dolores. Et quo illud omittantur. Vim admodum elaboraret at, id sonet dissentiet eos.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

