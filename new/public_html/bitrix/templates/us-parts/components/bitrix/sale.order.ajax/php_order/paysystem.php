<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<script type="text/javascript">
		function changePaySystem(param)
		{
			if (BX("account_only") && BX("account_only").value == 'Y') // PAY_CURRENT_ACCOUNT checkbox should act as radio
			{
				if (param == 'account')
				{
					if (BX("PAY_CURRENT_ACCOUNT"))
					{
						BX("PAY_CURRENT_ACCOUNT").checked = true;
						BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
						BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');

						// deselect all other
						var el = document.getElementsByName("PAY_SYSTEM_ID");
						for(var i=0; i<el.length; i++)
							el[i].checked = false;
					}
				}
				else
				{
					BX("PAY_CURRENT_ACCOUNT").checked = false;
					BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
					BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
				}
			}
			else if (BX("account_only") && BX("account_only").value == 'N')
			{
				if (param == 'account')
				{
					if (BX("PAY_CURRENT_ACCOUNT"))
					{
						BX("PAY_CURRENT_ACCOUNT").checked = !BX("PAY_CURRENT_ACCOUNT").checked;

						if (BX("PAY_CURRENT_ACCOUNT").checked)
						{
							BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
							BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
						}
						else
						{
							BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
							BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
						}
					}
				}
			}

			submitForm();
		}
	</script>
    <div class="block-head">Шаг 3 из 5. <b>Выберите способ оплаты</b></div>
    <div class="block-body">
        <!--        PAY_SYSTEM_ID-->
        <div class="row">
            <? foreach ($arResult['PAY_SYSTEM'] as $pay_system){ ?>
                <div class="delivery-item">
                    <div class="row">
                        <div class="delivery-icon">
                            <img src="<?=$pay_system['PSA_LOGOTIP']['SRC']?>" alt="<?=$pay_system['NAME']?>">
                        </div>
                        <div class="delivery-description">
                            <div class="form-radio">
                                <label onclick="BX('ID_PAY_SYSTEM_ID_<?=$pay_system["ID"]?>').checked=true;changePaySystem();" for="ID_PAY_SYSTEM_ID_<?=$pay_system['ID']?>">
                                    <input <?=isset($pay_system['CHECKED']) ? 'checked' : '' ?> type="radio" id="ID_PAY_SYSTEM_ID_<?=$pay_system['ID']?>" name="PAY_SYSTEM_ID" value="<?=$pay_system['ID']?>" onclick="changePaySystem();"><?=$pay_system['NAME']?></label>
                            </div>
                        </div>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>