<div class="profile left-block-bg">
    <div class="head left-block-head">Ваш профиль</div>
    <? global $USER;
    $rsUser = CUser::GetByID($USER->GetID());
    $arUser = $rsUser->Fetch();
    if ($USER->IsAuthorized()){ ?>
        <div class="user">
            <p class="user-info login"><b>ФИО: </b><?=$arUser['NAME']?> <?=$arUser['LAST_NAME']?></p>
            <p class="user-info email"><b>E-mail: </b><?=$arUser['EMAIL']?></p>
        </div>
        <button class="btn order-list"><a href="/personal/orders/">Посмотреть все заказы</a></button>
        <button class="btn user-data"><a href="/personal">Личные данные</a></button>
        <button class="btn logout"><a href="?logout=yes">Выйти</a></button>
    <? }else{ ?>
        <button class="btn user-data"><a class="auth" href="/auth">Авторизация</a></button>
        <button class="btn user-data"><a class="register" href="/auth/?register=yes">Регистрация</a></button>
    <? } ?>
</div>