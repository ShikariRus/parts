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
        <button class="btn order-list" onclick="window.location.href='/personal/orders/'"><a href="/personal/orders/">Посмотреть все заказы</a></button>
        <button class="btn user-data" onclick="window.location.href='/personal'"><a href="/personal">Личные данные</a></button>
        <button class="btn logout" onclick="window.location.href='?logout=yes'"><a href="?logout=yes">Выйти</a></button>
    <? }else{ ?>
        <button class="btn user-data" onclick="window.location.href='/auth'"><a class="auth" href="/auth">Авторизация</a></button>
        <button class="btn user-data" onclick="window.location.href='/auth/?register=yes'"><a class="register" href="/auth/?register=yes">Регистрация</a></button>
    <? } ?>
</div>