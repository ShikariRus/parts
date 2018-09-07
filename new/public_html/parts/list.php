<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Детали для ТО"); ?>
<!--  Content zone  -->
<!-- Garage item -->
<div class="model">
    <div class="title-section">Детали для <?=$_GET['marka']?> <?=$_GET['model']?> <?=$_GET['year']?></div>
    <div class="row top-row">
        <div class="left-block">
            <div class="image">
                <img src="assets/images/model-items/bmw-big.png" alt="bmw big">
            </div>
            <div class="add-to-garage"><span>+</span> Добавить к себе в гараж</div>
        </div>
        <div class="right-block">
            <div class="info">
                <div class="block-title"><b>Информация об авто:</b></div>
                <ul>
                    <li>Года выпуска: <span class="light"><?=$_GET['year']?></span></li>
                    <li>Тип кузова: <span class="light">внедорожник</span></li>
                    <li>Объём двигателя, куб. см: <span class="light">2993</span></li>
                    <li>Мощность, л.с./кВт/об мин: <span class="light">218/160/4000</span></li>
                    <li>Тип топлива: <span class="light">дизельное топливо</span></li>
                    <li>Объём топливного бака, л: <span class="light">93</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="product-table">
        <div class="table-head">
            <div class="table-cell product-number">Номер</div>
            <div class="table-cell product-name">Описание</div>
            <div class="table-cell product-category">Категория</div>
            <div class="table-cell product-price-and-stock">Цены и наличе</div>
        </div>
        <div class="table-body">
            <div class="table-row">
                <div class="table-body-cell product-number">21513-23001</div>
                <div class="table-body-cell product-name">Прокладка сливной пробки поддона картера</div>
                <div class="table-body-cell product-category"><a target="_blank" href="/catalog-list.php">Двигатель</a></div>
                <div class="table-body-cell product-price-and-stock"><i class="fa fa-search" aria-hidden="true"></i> <a
                        href="/search?code=21513-23001"><span>Поиск</span></a></div>
            </div>
            <div class="table-row">
                <div class="table-body-cell product-number">548131H100</div>
                <div class="table-body-cell product-name">Колодки дисковые</div>
                <div class="table-body-cell product-category"><a target="_blank" href="/catalog-list.php">Тормозные диски</a></div>
                <div class="table-body-cell product-price-and-stock"><i class="fa fa-search" aria-hidden="true"></i> <a
                        href="/search?code=21513-23001"><span>Поиск</span></a></div>
            </div>
        </div>
        <div class="pagination">
            <a href="#" class="icon"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a>
            <a href="#" class="icon"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
            <span class="current">1</span>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#" class="icon"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="icon"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.add-to-garage').on('click', function () {
            $('[data-popup="added-to-garage"]').toggleClass('active');
            $('.overlay').toggleClass('active');
        });
    });
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>