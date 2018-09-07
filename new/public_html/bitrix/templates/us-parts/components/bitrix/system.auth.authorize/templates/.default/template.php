<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
ShowMessage($arParams["~AUTH_RESULT"]);
ShowMessage($arResult['ERROR_MESSAGE']);
?>
<!--  Content zone  -->
<!-- Login item -->
<div class="login">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <div class="breadcrumbs">
        <ul>
            <li><a href="/">Главная</a></li>
            <li><span class="thin">Авторизация</span></li>
        </ul>
    </div>
    <div class="title-section">Авторизация</div>
    <div class="row">
        <div class="left-block">
            <div class="block-title">Пожалуйста, авторизуйтесь:</div>
            <form action="#" class="content">
                <div class="row">
                    <div class="login-block">
                        <div class="input-wrap input-required">
                            <input type="text" name="login" class="form-input end-block" placeholder="Введите логин" required>
                        </div>
                        <div class="input-wrap input-required">
                            <input type="password" name="password" class="form-input" placeholder="Введите пароль"  required>
                        </div>
                        <div class="end-block"></div>
                        <div class="g-recaptcha" data-sitekey="6LeXe14UAAAAAMj559ybITkM82oDcqMYgUhV1J5-"></div>
                        <div class="end-block"></div>
                        <div class="button-block">
                            <div class="form-radio">
                                <label for="remember"><input checked type="checkbox" id="remember" name="remember" value="true">Запомнить меня на этом устройстве</label>
                            </div>
                            <div class="login-btn">
                                <button type="submit" class="btn small">Войти</button>
                                <a class="btn small transparent blue">Зарегистрироваться</a>
                            </div>
                            <div class="forgot-password">
                                <a href="/forgot-password.php">Забыли свой пароль?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="right-block">
            <div class="block-title">Войдите через соц. сеть:</div>
            <div class="social-login">
                <a href="javascript:void(0)"><img src="./assets/images/socail/vk.png" alt="vk login"></a>
                <a href="javascript:void(0)"><img src="./assets/images/socail/fb.png" alt="fb login"></a>
                <a href="javascript:void(0)"><img src="./assets/images/socail/google.png" alt="google login"></a>
                <a href="javascript:void(0)"><img src="./assets/images/socail/mail.png" alt="mail login"></a>
            </div>
        </div>
    </div>
</div>
<div class="bx-auth">
<?if($arResult["AUTH_SERVICES"]):?>
	<div class="bx-auth-title"><?echo GetMessage("AUTH_TITLE")?></div>
<?endif?>
	<div class="bx-auth-note"><?=GetMessage("AUTH_PLEASE_AUTH")?></div>

	<form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">

		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
		<?if (strlen($arResult["BACKURL"]) > 0):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?endif?>
		<?foreach ($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
		<?endforeach?>

		<table class="bx-auth-table">
			<tr>
				<td class="bx-auth-label"><?=GetMessage("AUTH_LOGIN")?></td>
				<td><input class="bx-auth-input form-control" type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" /></td>
			</tr>
			<tr>
				<td class="bx-auth-label"><?=GetMessage("AUTH_PASSWORD")?></td>
				<td><input class="bx-auth-input form-control" type="password" name="USER_PASSWORD" maxlength="255" autocomplete="off" />
<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure').style.display = 'inline-block';
</script>
<?endif?>
				</td>
			</tr>
			<?if($arResult["CAPTCHA_CODE"]):?>
				<tr>
					<td></td>
					<td><input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></td>
				</tr>
				<tr>
					<td class="bx-auth-label"><?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:</td>
					<td><input class="bx-auth-input form-control" type="text" name="captcha_word" maxlength="50" value="" size="15" /></td>
				</tr>
			<?endif;?>
<?if ($arResult["STORE_PASSWORD"] == "Y"):?>
			<tr>
				<td></td>
				<td><input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" /><label for="USER_REMEMBER">&nbsp;<?=GetMessage("AUTH_REMEMBER_ME")?></label></td>
			</tr>
<?endif?>
			<tr>
				<td></td>
				<td class="authorize-submit-cell"><input type="submit" class="btn btn-primary" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>" /></td>
			</tr>
		</table>

<?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
		<noindex>
			<p>
				<a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
			</p>
		</noindex>
<?endif?>

<?if($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"):?>
		<noindex>
			<p>
				<a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a><br />
				<?=GetMessage("AUTH_FIRST_ONE")?>
			</p>
		</noindex>
<?endif?>

	</form>
</div>

<script type="text/javascript">
<?if (strlen($arResult["LAST_LOGIN"])>0):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>

<?if($arResult["AUTH_SERVICES"]):?>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
	array(
		"AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
		"CURRENT_SERVICE" => $arResult["CURRENT_SERVICE"],
		"AUTH_URL" => $arResult["AUTH_URL"],
		"POST" => $arResult["POST"],
		"SHOW_TITLES" => $arResult["FOR_INTRANET"]?'N':'Y',
		"FOR_SPLIT" => $arResult["FOR_INTRANET"]?'Y':'N',
		"AUTH_LINE" => $arResult["FOR_INTRANET"]?'N':'Y',
	),
	$component,
	array("HIDE_ICONS"=>"Y")
);
?>
<?endif?>
