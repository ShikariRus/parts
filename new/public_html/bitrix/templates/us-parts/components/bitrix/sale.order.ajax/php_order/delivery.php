<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $USER;
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
?>

<script type="text/javascript">
	function fShowStore(id, showImages, formWidth, siteId)
	{
		var strUrl = '<?=$templateFolder?>' + '/map.php';
		var strUrlPost = 'delivery=' + id + '&showImages=' + showImages + '&siteId=' + siteId;

		var storeForm = new BX.CDialog({
					'title': '<?=GetMessage('SOA_ORDER_GIVE')?>',
					head: '',
					'content_url': strUrl,
					'content_post': strUrlPost,
					'width': formWidth,
					'height':450,
					'resizable':false,
					'draggable':false
				});

		var button = [
				{
					title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
					id: 'crmOk',
					'action': function ()
					{
						GetBuyerStore();
						BX.WindowManager.Get().Close();
					}
				},
				BX.CDialog.btnCancel
			];
		storeForm.ClearButtons();
		storeForm.SetButtons(button);
		storeForm.Show();
	}

	function GetBuyerStore()
	{
		BX('BUYER_STORE').value = BX('POPUP_STORE_ID').value;
		//BX('ORDER_DESCRIPTION').value = '<?=GetMessage("SOA_ORDER_GIVE_TITLE")?>: '+BX('POPUP_STORE_NAME').value;
		BX('store_desc').innerHTML = BX('POPUP_STORE_NAME').value;
		BX.show(BX('select_store'));
	}

	function showExtraParamsDialog(deliveryId)
	{
		var strUrl = '<?=$templateFolder?>' + '/delivery_extra_params.php';
		var formName = 'extra_params_form';
		var strUrlPost = 'deliveryId=' + deliveryId + '&formName=' + formName;

		if(window.BX.SaleDeliveryExtraParams)
		{
			for(var i in window.BX.SaleDeliveryExtraParams)
			{
				strUrlPost += '&'+encodeURI(i)+'='+encodeURI(window.BX.SaleDeliveryExtraParams[i]);
			}
		}

		var paramsDialog = new BX.CDialog({
			'title': '<?=GetMessage('SOA_ORDER_DELIVERY_EXTRA_PARAMS')?>',
			head: '',
			'content_url': strUrl,
			'content_post': strUrlPost,
			'width': 500,
			'height':200,
			'resizable':true,
			'draggable':false
		});

		var button = [
			{
				title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
				id: 'saleDeliveryExtraParamsOk',
				'action': function ()
				{
					insertParamsToForm(deliveryId, formName);
					BX.WindowManager.Get().Close();
				}
			},
			BX.CDialog.btnCancel
		];

		paramsDialog.ClearButtons();
		paramsDialog.SetButtons(button);
		//paramsDialog.adjustSizeEx();
		paramsDialog.Show();
	}

	function insertParamsToForm(deliveryId, paramsFormName)
	{
		var orderForm = BX("ORDER_FORM"),
			paramsForm = BX(paramsFormName);
			wrapDivId = deliveryId + "_extra_params";

		var wrapDiv = BX(wrapDivId);
		window.BX.SaleDeliveryExtraParams = {};

		if(wrapDiv)
			wrapDiv.parentNode.removeChild(wrapDiv);

		wrapDiv = BX.create('div', {props: { id: wrapDivId}});

		for(var i = paramsForm.elements.length-1; i >= 0; i--)
		{
			var input = BX.create('input', {
				props: {
					type: 'hidden',
					name: 'DELIVERY_EXTRA['+deliveryId+']['+paramsForm.elements[i].name+']',
					value: paramsForm.elements[i].value
					}
				}
			);

			window.BX.SaleDeliveryExtraParams[paramsForm.elements[i].name] = paramsForm.elements[i].value;

			wrapDiv.appendChild(input);
		}

		orderForm.appendChild(wrapDiv);

		BX.onCustomEvent('onSaleDeliveryGetExtraParams',[window.BX.SaleDeliveryExtraParams]);
	}
</script>
<div class="section">
    <div class="bx_section">
        <div class="block-head">Шаг 2 из 5. <b>Выберите способ достаки</b></div>
        <div class="block-body">
            <div class="bx_section">
            <div class="row">
                <?
                if (empty($arUser['UF_DELIVERY'])){
                    $del_arr = $arResult['DELIVERY'];
                    $arUser['UF_DELIVERY'] = array_shift($del_arr)['NAME'];
                }
                ?>
            <input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult["BUYER_STORE"]?>" />
            <?
            if(!empty($arResult["DELIVERY"]))
            {
                $width = ($arParams["SHOW_STORES_IMAGES"] == "Y") ? 850 : 700;
                ?>
                <?

                foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery)
                {
                    if ($delivery_id !== 0 && intval($delivery_id) <= 0)
                    {
                        foreach ($arDelivery["PROFILES"] as $profile_id => $arProfile) {
                            ?>
                            <div class="delivery-item">
                                <div class="row">
                                    <div class="delivery-icon">
                                        <img src="<?=$arDelivery['LOGOTIP']['SRC']?>" alt="<?=$arDelivery['NAME']?>">
                                    </div>
                                    <div class="delivery-description">
                                        <div class="form-radio">
                                            <label onclick="submitForm();" class="delivery-label" for="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>">
                                                <input type="radio"
                                                       id="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>"
                                                       name="<?=htmlspecialcharsbx($arProfile["FIELD_NAME"])?>"
                                                       value="<?=$delivery_id.":".$profile_id;?>"
                                                    <?=$arProfile["CHECKED"] == "Y" ? "checked=\"checked\"" : "";?>><?=$arDelivery['NAME']?></label>
                                        </div>
                                        <div class="text">
                                            <p><?=$arDelivery['DESCRIPTION']?></p>
                                            <? if (isset($arDelivery['PERIOD_TEXT'])){ ?>
                                                <p><b>Сроки:</b> <?=$arDelivery['PERIOD_TEXT']?></p>
                                            <? } ?>
                                            <? if ($arDelivery['PRICE'] != 0){ ?>
                                                <p><b>Стоимость:</b> <?=$arDelivery['PRICE_FORMATED']?></p>
                                            <? } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?
                        } // endforeach
                    }
                    else // stores and courier
                    {
                        if (count($arDelivery["STORE"]) > 0)
                            $clickHandler = "onClick = \"fShowStore('".$arDelivery["ID"]."','".$arParams["SHOW_STORES_IMAGES"]."','".$width."','".SITE_ID."')\";";
                        else
                            $clickHandler = "onClick = \"BX('ID_DELIVERY_ID_".$arDelivery["ID"]."').checked=true;submitForm();\"";
                        ?>
                        <div class="delivery-item">
                            <div class="row">
                                <div class="delivery-icon">
                                    <img src="<?=$arDelivery['LOGOTIP']['SRC']?>" alt="<?=$arDelivery['NAME']?>">
                                </div>
                                <div class="delivery-description">
                                    <div class="form-radio">
                                        <label <?=$clickHandler?> class="delivery-label" for="ID_DELIVERY_ID_<?=$arDelivery["ID"]?>">
                                            <input type="radio"
                                                   onclick="submitForm();"
                                                   id="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>"
                                                   name="<?=htmlspecialcharsbx($arDelivery["FIELD_NAME"])?>"
                                                   value="<?= $arDelivery["ID"] ?>"<?if ($arDelivery["CHECKED"]=="Y") echo " checked";?>><?=$arDelivery['NAME']?></label>
                                    </div>
                                    <div class="text">
                                        <p><?=$arDelivery['DESCRIPTION']?></p>
                                        <? if (isset($arDelivery['PERIOD_TEXT'])){ ?>
                                            <p><b>Сроки:</b> <?=$arDelivery['PERIOD_TEXT']?></p>
                                        <? } ?>
                                        <? if ($arDelivery['PRICE'] != 0){ ?>
                                            <p><b>Стоимость:</b> <?=$arDelivery['PRICE_FORMATED']?></p>
                                        <? } ?>
                                        <? if (count($arDelivery["STORE"]) > 0): ?>
                                        <span id="select_store"<?if(strlen($arResult["STORE_LIST"][$arResult["BUYER_STORE"]]["TITLE"]) <= 0) echo " style=\"display:none;\"";?>>
                                                        <span class="select_store"><?=GetMessage('SOA_ORDER_GIVE_TITLE');?>: </span>
                                                        <span class="ora-store" id="store_desc"><?=htmlspecialcharsbx($arResult["STORE_LIST"][$arResult["BUYER_STORE"]]["TITLE"])?></span>
                                                    </span>
                                        <?endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?
                    }
                }
            }
        ?>
            </div>
            </div>
            </div>
    </div>
</div>