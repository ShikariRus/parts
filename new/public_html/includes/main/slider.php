<div class="slider">
    <div class="row">
        <div class="slider-items owl-carousel owl-theme">
            <div class="slider-item">
                <div class="image">
                    <div class="text">
                        <p class="big"><b>Более 10 успешных лет на рынке <br>импортных запчастей</b></p>
                        <p>Мы осуществляем прямые поставки товара из-за границы, <br>что позволяет нам предложить покупателям широкий<br>ассортимент запасных деталей</p>
                    </div>
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/slider/slider.png" alt="slider.png">
                </div>
            </div>
            <div class="slider-item">
                <div class="image">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/slider/slider.png" alt="slider.png">
                </div>
            </div>
        </div>
        <div class="nav-block">
            <div class="dots">
                <div class="nav left"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
                <? for ($i = 0; $i < 2; $i++){ ?>
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