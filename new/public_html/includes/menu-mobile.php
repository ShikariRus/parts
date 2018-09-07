<div class="menu">
    <ul>
        <? global $USER;
        $rsUser = CUser::GetByID($USER->GetID());
        $arUser = $rsUser->Fetch();
        if ($USER->IsAuthorized() != true){ ?>
            <li><a href="/auth/">Вход</a></li>
            <li><a href="/auth/?register=yes">Регистрация</a></li>
        <? }else{ ?>
            <li><a href="/personal/">Кабинет</a></li>
            <li><a href="?logout=yes">Выйти</a></li>
        <? } ?>
        <li><a href="/">О Компании</a></li>
        <li><a href="/vin">Подбор по VIN</a></li>
        <li><a href="/catalogs">Каталоги запчастей</a></li>
        <li><a href="/catalog">Ассортимент</a></li>
        <li><a href="/parts">Расходники для ТО</a></li>
        <li><a href="/repair">Ремонт и техобслуживание</a></li>
        <li><a href="/delivery">Доставка</a></li>
        <li><a href="/payment">Оплата</a></li>
        <li><a href="/return">Возврат</a></li>
        <li><a href="/suppliers">Поставщикам</a></li>
        <li><a href="/partners">Партнерство  и сотрудничество</a></li>
        <li><a href="/promotions">Акции</a></li>
        <li><a href="/charity">Благотворительность</a></li>
        <li><a href="/news">Новости</a></li>
        <li><a href="/how-to-checkout">Как оформить заказ</a></li>
        <li><a href="/contacts">Контакты</a></li>
    </ul>
</div>