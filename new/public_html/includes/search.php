<div class="search-block">
    <div class="prev-search"></div>
    <div class="row">
        <div class="search-tab active" data-search="part-number">Поиск по номеру детали</div>
        <div class="search-tab" data-search="vin-number">Поиск запчастей по VIN</div>
        <div class="search-tab" data-search="parts-for-repair">Детали для ТО</div>
    </div>
    <div class="next-search"></div>
    <div class="row">
        <div class="search-form">
            <div class="search-input-wrap active" data-search="part-number">
                <form action="/search" method="get">
                    <input type="text" class="search-input active" name="code" placeholder="Введите номер детали, например, 9091901164"  value="<?=isset($_GET['code']) ? $_GET['code'] : '' ?>">
                    <button type="submit" class="search-btn">Найти</button>
                </form>
            </div>
            <div class="search-input-wrap" data-search="vin-number">
                <form method="get">
                    <input type="text" name="search-by-vin-number" class="search-input" placeholder="Введите vin номер, например, 4USBT53544LT26841">
                    <button type="submit" class="search-btn vin-decode">Найти</button>
                </form>
            </div>
            <div class="search-input-wrap" data-search="parts-for-repair">
                <input type="text" name="search-parts-for-repair" class="search-input" data-search="parts-for-repair" placeholder="Детали для ТО">
                <button type="submit" class="search-btn">Найти</button>
            </div>
        </div>
    </div>
<!--    <pre>-->
<!--        --><?// var_dump(json_decode(file_get_contents('https://partsapi.ru/api.php?act=VINdecode&lang=ru&vin=JTEBU29J705047058&lang=ru&key=test'), JSON_UNESCAPED_UNICODE))?>
<!--        --><?// var_dump(json_decode(file_get_contents('https://acat.online/api/public/types'), JSON_UNESCAPED_UNICODE))?>
<!--    </pre>-->
    <script>
        $(function () {
            $('.vin-decode').on('click', function (event) {
                event.preventDefault();
                var VIN = $(this).parent('form').find('input').val();

                $.ajax({
                    url: 'https://new.us-parts.ru/vin/result/index.php',
                    method: 'post',
                    dataType: 'json',
                    data: {'VIN': VIN, 'JSON' : true},
                    beforeSend: function(){

                    },
                    complete: function(result) {
                        var mark = result.responseJSON['VehicleTDOC_ManufacturerTitle'];
                        if (mark == 'VW'){
                            mark = 'Volkswagen';
                        }
                        var model = result.responseJSON['VehicleTDOC_ModelTitle'];
                        var year_start = result.responseJSON['VehicleProductionStart'];
                        var year_end = result.responseJSON['VehicleProductionEnd'];
                        year_start = year_start.substr(year_start.length-2,2);
                        year_end = year_end.substr(year_end.length-2,2);
                        window.location.href = "/catalog?marka="+mark+"&model="+model+"&year="+year_start+"-"+year_end+"";
                    }
                });
            });
            $('.search-tab').on('click', function () {
                $('.search-tab').removeClass('active');
                var search_input = $(this).attr('data-search');
                $('.search-input-wrap').removeClass('active');
                $('.search-form [data-search="'+search_input+'"]').addClass('active');
                $(this).addClass('active');
            });
            $('.search-block .prev-search').on('click', function () {
                var index = $('.search-block').find('.search-tab.active').index();
                if ($('.search-block .search-tab').eq(index - 1).length > 0) {
                    $('.search-block .search-tab').removeClass('active');
                    $('.search-block .search-tab').eq(index - 1).addClass('active');
                    var search_input = $('.search-block .search-tab').eq(index - 1).attr('data-search');
                    $('.search-input').removeClass('active');
                    $('.search-input[data-search="'+search_input+'"]').addClass('active');
                }
            });
            $('.search-block .next-search').on('click', function () {
                var count = $('.search-block').find('.search-tab').length;
                var index = $('.search-block').find('.search-tab.active').index();
                index = index + 1;
                if (index == count){
                    index = 0;
                }
                if ($('.search-block .search-tab').eq(index).length > 0) {
                    $('.search-block .search-tab').removeClass('active');
                    $('.search-block .search-tab').eq(index).addClass('active');
                    var search_input = $('.search-block .search-tab').eq(index).attr('data-search');
                    $('.search-input').removeClass('active');
                    $('.search-input[data-search="'+search_input+'"]').addClass('active');
                }
            });
        });
    </script>
</div>