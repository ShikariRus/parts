<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>
    <!--  Content zone  -->
    <!-- Delivery -->
    <?global $USER;
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch(); ?>
    <div class="delivery">
        <div class="title-section">Как можно получить доставку:</div>
        <div class="row">
            <div class="delivery-block">
                <p class="delivery_1">Самовывозом в магазине по адресу:
                    <br>
                    <span class="light">г. Москва, 2-й Донской проезд, д.10</span>
                </p>
                <p class="delivery_2">
                    Доставка курьером по Москве. Стоимость доставки 500р, если сумма заказа <br>
                    не превышает 3000р. При сумме заказа свыше 3000р. мы привезем <br>
                    ваши покупки бесплатно.
                    <? if ($USER->IsAuthorized()){ ?>
                        <br>
                        <span class="thin btn-popup" data-popup="pickup">Доставлять курьером по Москве</span>
                    <? } ?>
                </p>

                <p class="delivery_3">Либо, мы отправляем в регионы через Транспортные Компании на ваш выбор: <br>
                    (Автотрейдинг, Пэк, Деловые Линии, Желдорэкпедиция, Кит, Даймекс, Прогресс). <br>
                    Рекомендуем воспользоваться услугами проверенных операторов: Деловые линии <br>
                    (рассчитать стоимость доставки) и ПЭК (рассчитать стоимость доставки). <br>
                    Товар до Транспортной кампании мы довезем бесплатно.
                    <? if ($USER->IsAuthorized()){ ?>
                        <br>
                        <span class="thin btn-popup" data-popup="transport">Доставлять в регионы через ТК</span>
                    <? } ?>
                </p>

                <p class="delivery_4">Доставка запчастей по Москве и до транспортной компании - Бесплатно. <br>
                    За доставку в Ваш город, Вы оплачиваете при получении груза,<br>
                    по месту в транспортной компании.<br>
                </p>

                <p class="delivery_5">Доставка клиенту с EMS-почта России (услуги экспресс-доставки по России <br>
                    и в 190 стран мира). Стоимость заказа подорожает на сумму отправки,<br>
                    так как доставка оплачивается нами сразу при отправке из Москвы!<br>
                </p>
            </div>
        </div>
        <div data-popup="pickup" class="pop-up pop-up-delivery">
            <div class="close-pop-up"><i class="fa fa-times" aria-hidden="true"></i></div>
            <div class="pop-up-body">
                <div class="block-bg">
                    <div class="block-head">данные для доставки</div>
                    <form action="#" class="content">
                        <label for="time" class="form-label">Желаемое время доставки</label>
                        <div class="row">
                            <select name="time" id="time" class="form-select end-block full-width">
                                <option value="10:00">10:00</option>
                                <option value="10:30">10:30</option>
                                <option value="11:00">11:00</option>
                                <option value="11:30">11:30</option>
                            </select>
                        </div>
                        <label class="form-label" for="delivery-address">Адрес доставки:</label>
                        <div class="row">
                            <input type="text" id="delivery-address" class="form-input full-width end-block" name="delivery-address" value="<?=$arUser['UF_ADDRESS']?>" placeholder="пример: г.Москва Дмитровское шоссе 102к2с3" required>
                        </div>
                        <label class="form-label">Контактное лицо:</label>
                        <div class="row">
                            <input type="text" value="<?=$arUser['NAME']?>" name="firstname" class="form-input half-width" placeholder="Имя" required>
                            <input type="text" value="<?=$arUser['LAST_NAME']?>" name="lastname" class="form-input half-width" placeholder="Фамилия" required>
                            <input type="text" name="parentname" class="form-input half-width end-block" placeholder="Отчество" required>
                        </div>
                        <label class="form-label" for="telephone">Номер телефона:</label>
                        <div class="row">
                            <input type="text" value="<?=$arUser['PERSONAL_PHONE']?>" id="telephone" class="form-input half-width end-block" name="telephone" placeholder="+7(___)___-__-__" required>
                        </div>
                        <button type="submit" class="btn"><i class="fa fa-user" aria-hidden="true"></i> Сохранить данные</button>
                    </form>
                </div>
            </div>
        </div>
        <div data-popup="transport" class="pop-up pop-up-delivery">
            <div class="close-pop-up"><i class="fa fa-times" aria-hidden="true"></i></div>
            <div class="pop-up-body">
                <div class="block-bg">
                    <div class="block-head">данные для доставки</div>
                    <form action="#" class="content">
                        <label for="time" class="form-label">Выберите компанию для доставки:</label>
                        <div class="row">
                            <select name="time" id="time" class="form-select end-block full-width">
                                <option selected value="false">ТК не выбрана</option>
                                <option value="DHL">DHL</option>
                                <option value="Pony express">Pony express</option>
                            </select>
                        </div>
                        <label class="form-label" for="delivery-address">Адрес доставки:</label>
                        <div class="row">
                            <input type="text" id="delivery-address" class="form-input full-width end-block" name="delivery-address" value="<?=$arUser['UF_ADDRESS']?>" placeholder="пример: г.Москва Дмитровское шоссе 102к2с3" required>
                        </div>
                        <label class="form-label">Контактное лицо:</label>
                        <div class="row">
                            <input type="text" value="<?=$arUser['NAME']?>" name="firstname" class="form-input half-width" placeholder="Имя" required>
                            <input type="text" value="<?=$arUser['LAST_NAME']?>" name="lastname" class="form-input half-width" placeholder="Фамилия" required>
                            <input type="text" name="parentname" class="form-input half-width end-block" placeholder="Отчество" required>
                        </div>
                        <label class="form-label" for="telephone">Номер телефона:</label>
                        <div class="row">
                            <input type="text" value="<?=$arUser['PERSONAL_PHONE']?>" id="telephone" class="form-input half-width end-block" name="telephone" placeholder="+7(___)___-__-__" required>
                        </div>
                        <button type="submit" class="btn"><i class="fa fa-user" aria-hidden="true"></i> Сохранить данные</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>