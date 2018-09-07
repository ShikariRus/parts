<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Детали для ТО"); ?>
<?
global $USER;
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
$user = new CUser;
$ID = $arUser['ID'];
$MARK = $arUser['UF_MARK'];
?>
<!--  Content zone  -->
<!-- Parts -->
<div class="parts">
    <div class="title-section">Детали для ТО</div>
    <div class="block-title">Мой гараж</div>
    <div class="garage-grid">
        <? foreach ($MARK as $key => $mark_item){ ?>
            <?
                $mark_name = explode('|', $mark_item)[0];
                $model_name = explode('|', $mark_item)[1];
                $year = explode('|', $mark_item)[2];
            ?>
            <div class="garage-item" data-id="<?=$key?>">
                <a href="/parts/list.php?marka=<?=$mark_name?>&model=<?=$model_name?>&year=<?=$year?>">
                    <div class="garage-image">
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/garage/garage-1.png" alt="BMW X5 (E53)">
                    </div>
                    <div class="garage-name"><?=$mark_name?> <?=$model_name?> <?=$year?></div>
                    <div class="garage-action">
                        <a class="garage-action-edit" href="javascript:void(0)" onclick="editGarageItem(<?=$key?>)"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                        <a class="garage-action-delete" href="javascript:void(0)" onclick="deleteGarageItem(<?=$key?>)"><i class="fa fa-times" aria-hidden="true"></i></a>
                    </div>
                </a>
            </div>
        <? } ?>
    </div>
    <div class="button-block">
        <button type="button" class="btn add-car small btn-popup-no-style" data-popup="add-car">Добавить автомобиль</button>
    </div>
    <div data-popup="add-car" class="pop-up pop-up-car">
        <div class="close-pop-up"><i class="fa fa-times" aria-hidden="true"></i></div>
        <div class="pop-up-body">
            <div class="block-bg">
                <div class="block-head">Выбор автомобиля</div>
                <form action="#" class="content">
                    <label class="form-label">Укажите нужные данные:</label>
                    <div class="row">
                        <div class="left-block">
                            <select name="garage-marka" id="garage-marka" class="customize-select">
                                <option selected value="false">Марка</option>
                                <option value="Audi">Audi</option>
                                <option value="BMW">BMW</option>
                            </select>
                            <select name="garage-model" id="garage-model" class="customize-select">
                                <option selected value="false">Модель</option>
                                <option value="RS8">RS8</option>
                                <option value="M3">M3</option>
                            </select>
                        </div>
                        <div class="right-block">
                            <select name="garage-year" id="garage-year" class="customize-select">
                                <option selected value="false">Год выпуска</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                            </select>
                            <select name="garage-modification" id="garage-modification" class="customize-select">
                                <option selected value="false">Модификация</option>
                                <option value="m1">Модификация 1</option>
                                <option value="m2">Модификация 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <input type="text" id="garage-name" class="form-input full-width" name="garage-name" placeholder="Название" required>
                    </div>
                    <div class="row">
                        <input type="text" name="garage-mileage" class="form-input half-width" placeholder="Пробег" required>
                        <input type="text" name="garage-vin" class="form-input half-width" placeholder="VIN-номер" required>
                    </div>
                    <div class="row">
                        <textarea id="garage-description" class="form-input full-width end-block" name="garage-description" placeholder="Описание" required></textarea>
                    </div>
                    <div class="row button-block">
                        <div class="left-block">
                            <button type="submit" class="btn small"><i class="fa fa-user" aria-hidden="true"></i> Сохранить данные</button>
                        </div>
                        <div class="right-block">
                            <button type="button" class="btn transparent blue small">Выбрать свой автомобиль</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div data-popup="edit-car" class="pop-up pop-up-car">
        <div class="close-pop-up"><i class="fa fa-times" aria-hidden="true"></i></div>
        <div class="pop-up-body">
            <div class="block-bg">
                <div class="block-head">Изменение данных автомобиля</div>
                <form action="#" class="content">
                    <label class="form-label">Измените нужные данные:</label>
                    <div class="row">
                        <div class="left-block">
                            <select name="garage-marka" id="garage-marka" class="customize-select">
                                <option value="false">Марка</option>
                                <option value="Audi">Audi</option>
                                <option selected value="BMW">BMW</option>
                            </select>
                            <select name="garage-model" id="garage-model" class="customize-select">
                                <option value="false">Модель</option>
                                <option value="RS8">RS8</option>
                                <option selected value="M3">X5</option>
                            </select>
                        </div>
                        <div class="right-block">
                            <select name="garage-year" id="garage-year" class="customize-select">
                                <option value="false">Год выпуска</option>
                                <option selected value="2011">2011</option>
                                <option value="2012">2012</option>
                            </select>
                            <select name="garage-modification" id="garage-modification" class="customize-select">
                                <option value="false">Модификация</option>
                                <option value="m1">Модификация 1</option>
                                <option selected value="m2">e53</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <input type="text" id="garage-name" class="form-input full-width" name="garage-name" placeholder="Название" value="BMW X5 (E53)" required>
                    </div>
                    <div class="row">
                        <input type="text" name="garage-mileage" class="form-input half-width" placeholder="Пробег" value="112.000 км" required>
                        <input type="text" name="garage-vin" class="form-input half-width" placeholder="VIN-номер" value="4USBT53544LT26841" required>
                    </div>
                    <div class="row">
                        <textarea id="garage-description" class="form-input full-width end-block" name="garage-description" placeholder="Описание" required></textarea>
                    </div>
                    <div class="row button-block">
                        <div class="left-block">
                            <button type="submit" class="btn small"><i class="fa fa-user" aria-hidden="true"></i> Сохранить данные</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteGarageItem($id) {
        if (confirm('Удалить машину из гаража?')){
            $('.garage-item[data-id="'+$id+'"]').fadeOut(300);
            setTimeout(function () {
                $('.garage-item[data-id="'+$id+'"]').remove();
            }, 310);
            $('[data-popup="deleted"]').toggleClass('active');
            $('.overlay').toggleClass('active');
        }
    }
    function  editGarageItem($id) {
        $('[data-popup="edit-car"]').toggleClass('active');
        $('.overlay').toggleClass('active');

    }
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
