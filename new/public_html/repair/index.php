<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>
    <!--  Content zone  -->
    <!-- Repair -->
    <div class="repair">
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <div class="title-section">Ремонт и техобслуживание</div>
        <div class="block-title">Расчёт стоимости ремонта:</div>
        <div class="repair-block">
            <div class="row">
                <div class="repair-item">
                    <div class="item-title">Плановые работы</div>
                    <div class="repair-wrap">
                        <div class="image">
                            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/repair/repair_1.png" alt="">
                        </div>
                        <div class="list">
                            <ul>
                                <li>Замена фильтров</li>
                                <li>Шиномонтаж</li>
                                <li>Замена АКБ</li>
                                <li>Замена ремней</li>
                                <li>Замена тормозной жидкости</li>
                                <li>Обслуживание, смазка подвески</li>
                                <li>Замена масла ДВС</li>
                                <li>Замена масла в АКПП</li>
                                <li>Замена масла в мостах</li>
                                <li>Замена масла в раздаточной коробке</li>
                                <li>Замена свечей зажигания</li>
                                <li>Промывка и замена антифриза</li>
                                <li>Заправка кондиционера</li>
                                <li>Замена щеток стеклоочестителя</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="repair-item">
                    <div class="item-title">Профилактические работы</div>
                    <div class="repair-wrap">
                        <div class="image">
                            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/repair/repair_2.png" alt="">
                        </div>
                        <div class="list">
                            <ul>
                                <li>Замена фильтров</li>
                                <li>Шиномонтаж</li>
                                <li>Замена АКБ</li>
                                <li>Замена ремней</li>
                                <li>Замена тормозной жидкости</li>
                                <li>Обслуживание, смазка подвески</li>
                                <li>Замена масла ДВС</li>
                                <li>Замена масла в АКПП</li>
                                <li>Замена масла в мостах</li>
                                <li>Замена масла в раздаточной коробке</li>
                                <li>Замена свечей зажигания</li>
                                <li>Промывка и замена антифриза</li>
                                <li>Заправка кондиционера</li>
                                <li>Замена щеток стеклоочестителя</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="repair-item">
                    <div class="item-title">Кузовные работы</div>
                    <div class="repair-wrap">
                        <div class="image">
                            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/repair/repair_3.png" alt="">
                        </div>
                        <div class="list">
                            <ul>
                                <li>Замена фильтров</li>
                                <li>Шиномонтаж</li>
                                <li>Замена АКБ</li>
                                <li>Замена ремней</li>
                                <li>Замена тормозной жидкости</li>
                                <li>Обслуживание, смазка подвески</li>
                                <li>Замена масла ДВС</li>
                                <li>Замена масла в АКПП</li>
                                <li>Замена масла в мостах</li>
                                <li>Замена масла в раздаточной коробке</li>
                                <li>Замена свечей зажигания</li>
                                <li>Промывка и замена антифриза</li>
                                <li>Заправка кондиционера</li>
                                <li>Замена щеток стеклоочестителя</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-title">Ремонт со скидкой:</div>
        <div class="promo-block">
            <div class="row">
                <div class="promo-item">
                    <div class="image">
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/repair/skidka_1.png" alt="">
                    </div>
                    <div class="title">Замена масла ДВС</div>
                </div>
                <div class="promo-item">
                    <div class="image">
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/repair/skidka_2.png" alt="">
                    </div>
                    <div class="title">Проточка тормозных дисков</div>
                </div>
                <div class="promo-item">
                    <div class="image">
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/repair/skidka_3.png" alt="">
                    </div>
                    <div class="title">Промывка топливных форсунок</div>
                </div>
            </div>
        </div>
        <div class="block-title">Запись на обслуживание</div>
        <div class="text">
            <p><b>Уважаемые клиенты!</b> Благодарим за выбор нашей компании. <br>
                Заполните внимательно все поля формы записи на техобслуживание. <br>
                В течении часа наши специалисты свяжутся с вами по телефону <br>
                для подтверждения заявки и уточнения даты и времени.</p>
        </div>
        <?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback", 
	"repair_form", 
	array(
		"USE_CAPTCHA" => "Y",
		"OK_TEXT" => "Спасибо за запись на наш сервис, менеджер свяжется с Вами в ближайшее время!",
		"EMAIL_TO" => "icevex@yandex.ru",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "EMAIL",
			2 => "MESSAGE",
		),
		"EVENT_MESSAGE_ID" => array(
			0 => "86",
		),
		"COMPONENT_TEMPLATE" => "repair_form",
		"EXT_FIELDS" => array(
			0 => "Дата записи",
			1 => "Телефон",
			2 => "Марка",
			3 => "VIN номер",
			4 => "",
		)
	),
	false
);?>
        <div class="how-contacts">
            <div class="block-title">Как до нас можно добраться:</div>
            <p class="list-title">От станции метро Ленинский Проспект</p>
            <div class="text">
                <p>Выход,последний вагон из центра.</p>
                <p>По прямой 50 метров до конца забора, далее направо идти до ул.Орджоникидзе д.10</p>
                <p>За домом налево и Вы уже практически на месте ул.2-ой Донской пр-зд. Д.10  Вход через проходную "Станконормаль"</p>
            </div>
            <div class="how-image-grid">
                <div class="row">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/contacts/how_1_1.png" alt="">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/contacts/how_1_2.png" alt="">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/contacts/how_1_3.png" alt="">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/contacts/how_1_4.png" alt="">
                </div>
            </div>

            <p class="list-title">Из метро МЦК, станция "Площадь Гагарина"</p>
            <div class="how-image-grid">
                <div class="row">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/contacts/how_2_1.png" alt="">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/contacts/how_2_2.png" alt="">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/contacts/how_2_3.png" alt="">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/contacts/how_1_4.png" alt="">
                </div>
            </div>

            <p class="list-title">Проезд на машине</p>
            <div class="how-image-grid">
                <div class="row">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/contacts/how_3_1.png" alt="">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/contacts/how_3_2.png" alt="">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/contacts/how_3_3.png" alt="">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/contacts/how_3_4.png" alt="">
                </div>
            </div>
        </div>
    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>