<? echo $header ?>
<section id="main">
    <div class="content">
        <div class="profile">
            <div class="inner">
                <div class="row-flex">
                    <div class="profile-menu">
                        <p class="menu-item" data-target="profile-item">Профиль</p>
                        <p class="menu-item" data-target="check-balance">Баланс</p>
                        <p class="menu-item" data-target="add-balance">Пополнить баланс</p>
                        <p class="menu-item" data-target="change-pass">Смена пароля</p>
                        <p class="menu-item" data-target="support">Поддержка</p>
                    </div>
                    <div class="profile-delimiter"></div>
                    <div class="profile-block">
                        <form action="<?=$action_edit?>" class="profile-content profile-item" method="post">
                            <div class="block-title">Профиль</div>
                            <div class="form-group">
                                <label for="name" class="control-label">Имя</label>
                                <input type="name" class="form-control" id="name" name="auth_data[name]" value="<?=$auth_data['client_name']?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="auth_data[email]" value="<?=$auth_data['client_email']?>" required>
                            </div>
                            <button type="submit" class="btn-custom">Сохранить</button>
                        </form>
                        <div id="balance" class="check-balance profile-content">
                            <form class="check-balance-form">
                                <div class="block-title">Баланс</div>
                                <div class="form-group telephone-block">
                                    <label for="ik_desc" class="control-label telephone-label">Номер телефона:</label>
                                    <input type="text" disabled name="ik_desc" class="form-control telephone-input" id="ik_desc" value="<?=$auth_data['client_telephone']?>" />
                                </div>
                                <div class="form-group balance-block">
                                    <label for="tarif" class="control-label balance-label">Баланс:</label>
                                    <input type="text" disabled name="tarif" class="form-control balance-input" id="tarif" value="<?=$balance?>" />
                                </div>
                                <div class="form-group">
                                    <div class="submit-block">
                                        <input type="submit" name="check_balance" class="btn-custom" id="demo" value="Проверить баланс" /><p  id="demoo" style=" float:none;visibility:hidden; font-weight:700; color:red;">Подождите...</p>
                                    </div>
                                    <div class="add-block">
                                        <a href="javascript:void(0)" data-target="add-balance" class="profile-trigger btn-custom">Пополнить баланс</a>
                                    </div>
                                </div>
                            </form>
                            <script>
                                $(function () {
                                   $('.check-balance-form').submit(function (event) {
                                       event.preventDefault();
                                       if (getCookie('balance') === undefined) {
                                           setCookie('balance', true, {
                                               expires: 10
                                           });
                                           $.ajax({
                                               url: '<?=$action_check?>',
                                               type: 'json',
                                               success: function (json) {
                                                   json = json.replace(/"/g, '');
                                                   $('.balance-input').val(json)
                                               }
                                           });
                                       }
                                   });
                                });
                            </script>
                        </div>
                        <div id="buy_minute" class="profile-content add-balance" <? if($_GET[tar]==true or $_GET[kup]==true){echo 'display: block;"';}?>>
                            <div class="block-title">Пополнить баланс</div>
                            <form name="payment" method="post" action="https://sci.interkassa.com/" accept-charset="UTF-8">
                                <div class="form-group minute-block">
                                    <input type="hidden" name="ik_co_id" value="53960c4ebf4efc7c5dc34dce" />
                                    <input type="hidden" name="ik_pm_no" value="ID_4233" />
                                    <input type="hidden" name="ik_am" id="contenInput" value="30" />
                                    <input type="hidden" name="ik_x_amount" id="contenInput2" value="1" />
                                    <input type="hidden" name="ik_cur" value="USD" />
                                    <input type="hidden" name="ik_x_partner" id="contenInput9" value="0000000002" />
                                    <?
                                    $telephone = str_replace("+", "", $auth_data['client_telephone']);
                                    $telephone = str_replace(' ', '', $telephone);
                                    $telephone = str_replace('(', '', $telephone);
                                    $telephone = str_replace(')', '', $telephone);
                                    $telephone = str_replace('-', '', $telephone);
                                    ?>
                                    <input type="hidden" name="ik_desc" id="ik_desc" value="<?=$telephone?>"  />
                                    <label for="" class="control-label minute-label">Сколько минут Вы хотите пообщаться?</label>
                                    <div class="radio">
                                        <input type="radio" id="selector1" <? if($tar=='1'){echo 'checked="checked"';} ?> name="tarif" value="1" /><label for="selector1"><strong>1</strong></label>
                                        <input type="radio" id="selector2" <? if($tar=='2'||$tar==''){echo 'checked="checked"';} ?> name="tarif" value="3" /><label for="selector2"><strong>3</strong></label>
                                        <input type="radio" id="selector3" <? if($tar=='3'){echo 'checked="checked"';} ?> name="tarif" value="10" /><label for="selector3"><strong>10</strong></label>
                                        <input type="radio" id="selector4" <? if($tar=='4'){echo 'checked="checked"';} ?> name="tarif" value="20" /><label for="selector4"><strong>20</strong></label>
                                        <input type="radio" id="selector5" <? if($tar=='5'){echo 'checked="checked"';} ?> name="tarif" value="40" /><label for="selector5"><strong>40</strong></label>
                                        <input type="radio" id="selector6" <? if($tar=='6'){echo 'checked="checked"';} ?> name="tarif" value="120" /><label for="selector6"><strong>120</strong></label>
                                        <input type="radio" id="selector7" name="tarif" value="1440" /><label for="selector7"><strong>24 часа!</strong></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="submit-block">
                                        <input type="submit" name="btn_text" class="btn-custom" id="demo" value="Пополнить баланс" /><p  id="demoo" style=" float:none;visibility:hidden; font-weight:700; color:red;">Подождите...</p>
                                    </div>
                                </div>
<!--                                <div class="form-group">-->
<!--                                    <div class="confirm">-->
<!--                                        <input type="checkbox" checked="checked" name="aga" id="confirm" /><label for="confirm">Я соглашаюсь с <a href="http://webcall.sexcall.ru/oferta.html">правилами</a> сервиса</label>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="form-group noYB">
                                    <div class="control-panel">
                                        <div class="block-title">АВТОПОПОЛНЕНИЕ СЧЕТА</div>
                                        <div class="row-flex">
                                            <div class="left-block">
                                                <p>Включить АВТОпополнение счета
                                                    (Всего 10 руб за минуту!)</p>
                                            </div>
                                            <div class="right-block">
                                                <a href="/autorefill" class="btn-custom">Включить</a>
                                            </div>
                                        </div>
                                        <div class="row-flex">
                                            <div class="left-block">
                                                <p>Управление АВТОпополнением</p>
                                            </div>
                                            <div class="right-block">
                                                <a href="/unsubscribe" class="btn-custom">Управлять</a>
                                            </div>
                                        </div>
                                        <div class="row-flex">
                                            <div class="left-block">
                                                <p>Получить контент</p>
                                            </div>
                                            <div class="right-block">
                                                <a href="/" class="btn-custom">Получить</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="call_now" class="profile-content">
                            <div class="block-title">Профиль</div>
                            <form name="callback" method="post">
                                <div class="form-group">
                                    <label for="country3" class="control-label">Из какой Вы страны?</label>
                                    <select name="country3" class="form-control" onchange=countrychange3(value);>
                                        <optgroup label="СНГ">
                                            <option selected value="7">Россия</option>
                                            <option value="375">Беларусь</option>
                                            <option value="7">Казахстан</option>
                                            <option value="380">Украина</option>
                                        </optgroup>
                                        <optgroup label="Прибалтика">
                                            <option value="371">Латвия</option>
                                            <option value="370">Литва</option>
                                            <option value="372">Эстония</option>
                                        </optgroup>
                                        <optgroup label="Другие страны">
                                            <option value="61">Австралия</option>
                                            <option value="49">Германия</option>
                                            <option value="972">Израиль</option>
                                            <option value="1">США</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ik_desc" class="control-label">Введите Ваш номер телефона на который Вам перезвонит девушка:</label>
                                    <input type="text" name="toto" class="form-control" id="ik_desc2" value="<?=$auth_data['client_telephone']?>" />
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="call_click" id="cclick"  class="btn-custom" value="Позвони мне, позвони!" />
                                </div>
                            </form>
                        </div>
                        <div id="change-pass" class="profile-content change-pass">
                            <div class="block-title">Изменение пароля</div>
                            <form action="<?=$action_pass?>" method="post">
                                    <div class="form-group">
                                        <div class="row-flex">
                                            <div class="left-block">
                                                <label for="password" class="control-label">Введите новый пароль</label>
                                                <input type="password" class="form-control" id="password" name="auth_data[password]" required>
                                            </div>
                                            <div class="right-block">
                                                <p class="password-show">Показать пароль</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row-flex">
                                            <div class="left-block">
                                                <label for="password_confirm" class="control-label">Введите новый пароль еще раз</label>
                                                <input type="password" class="form-control" id="password_confirm" name="auth_data[password_confirm]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="alert alert-danger hidden pass_not_equal" role="alert">Пароли не совпадают!</div>
                                    </div>
                                <button type="submit" class="btn-custom">Изменить пароль</button>
                            </form>
                        </div>
                        <div id="support" class="profile-content support">
                            <div class="block-title">ОБРАТНАЯ СВЯЗЬ</div>
                            <div class="text-block">
                                <p>Оплатили не свой номер? Ошиблись при вводе?</p>
                                <p>Есть вопросы? -  Напишите нам!</p>
                            </div>
                            <form action="<?= $action_support ?>" method="post">
                                <div class="form-group">
                                    <label for="message" class="control-label message-label">Ваше сообщение:</label>
                                    <textarea name="support[message]" class="form-control message-control" id="message" cols="30" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="recall" class="control-label recall-label">Номер телефона, на который перезвонит менеджер:</label>
                                    <input type="text" name="support[recall]" class="form-control recall-control" id="recall" value="<?=$auth_data['client_telephone']?>" />
                                </div>
                                <div class="form-group">
                                    <label for="email-recall" class="control-label email-recall-label">Email для ответа:</label>
                                    <input type="email" class="form-control email-recall-control" id="email-recall" name="support[email_recall]" value="<?=$auth_data['client_email']?>" required>
                                </div>
<!--                                <div class="form-group">-->
<!--                                    <div class="confirm">-->
<!--                                        <input type="checkbox" checked="checked" name="aga" id="confirm" /><label for="confirm">Я соглашаюсь с <a href="http://webcall.sexcall.ru/oferta.html">правилами</a> сервиса</label>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="form-group">
                                    <div class="send-btn">
                                        <button type="submit" class="btn-custom">Отправить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <script>
                            intercity = 0;
                            $intercity=0;
                            function countrychange(value)
                            {

                                jQuery(function($){
                                    $mask="+"+value+"(qqq)qqq-qq-qq";
                                    $("#ik_desc").mask($mask);
                                    //   $("#ik_desc1").mask($mask);
                                    //   $("#ik_desc2").mask($mask);
                                    $("#tin").mask("99-9999999");
                                    $("#ssn").mask("999-99-9999");

                                    //if (value!=="7")
                                    //{$intercity=0.5};
                                    $id= parseInt(value);
                                    switch ($id)
                                    {
                                        case 7:
                                            $intercity=0;
                                            intercity=0;
					    if (($('#ik_desc').prop("value").charAt(0) == "7") & ($('#ik_desc').prop("value").charAt(2) == "7")) {
                            $intercity=0.5;
                            intercity=0.5;
                        };

                                            break
                                        case 1,61,370:
                                            $intercity=0.2;
                                            intercity=0.2;
                                            break

                                        case 49:
                                            $intercity=0.2;
                                            intercity=0.2;
                                            $mask="+"+value+"(qqq)qqqq-qq-q?q";
                                            $("#ik_desc").mask($mask)
                                            break

                                        case 972:
                                            $intercity=0.2;
                                            intercity=0.2;
                                            $mask="+"+value+"(qq)qqq-qq-qq";
                                            $("#ik_desc").mask($mask)
                                            break

                                        case 380:
                                            $intercity=0.5;
                                            intercity=0.5;
                                            $mask="+"+value+"(qq)qqq-qq-qq";
                                            //$("#ik_desc").mask($mask);
                                            break


                                        default:
                                            $intercity=0.5;
                                            intercity=0.5;
                                    }
                                    $("#ik_desc").mask($mask);
                                });

                            }

                            function countrychange2(value)
                            {

                                jQuery(function($){
                                    $mask="+"+value+"(qqq)qqq-qq-qq";
                                    //   $("#ik_desc").mask($mask);
                                    $("#ik_desc1").mask($mask);
                                    //   $("#ik_desc2").mask($mask);
                                    $("#tin").mask("99-9999999");
                                    $("#ssn").mask("999-99-9999");





                                    $id= parseInt(value);
                                    switch ($id)
                                    {
                                        case 49:
                                            $mask="+"+value+"(qqq)qqqq-qq-q?q"
                                            break

                                        case 972:
                                            $mask="+"+value+"(qq)qqq-qq-qq";
                                            $("#ik_desc1").mask($mask)
                                            break

                                        case 380:
                                            $mask="+"+value+"(qq)qqq-qq-qq";
                                            //$("#ik_desc").mask($mask);
                                            break


                                        default:
                                            $mask="+"+value+"(qqq)qqq-qq-qq";
                                    }
                                    $("#ik_desc1").mask($mask);

                                    //if (value!=="7")
                                    //{$intercity=0.5}

                                    //if (value="1" OR value="61" OR value="972")
                                    //{$intercity=0.2}


                                });

                            }

                            function countrychange3(value)
                            {

                                jQuery(function($){
                                    $mask="+"+value+"(qqq)qqq-qq-qq";
                                    //   $("#ik_desc").mask($mask);
                                    //   $("#ik_desc1").mask($mask);
                                    $("#ik_desc2").mask($mask);
                                    $("#tin").mask("99-9999999");
                                    $("#ssn").mask("999-99-9999");



                                    $id= parseInt(value);
                                    switch ($id)
                                    {
                                        case 49:
                                            $mask="+"+value+"(qqq)qqqq-qq-q?q"
                                            break

                                        case 972:
                                            $mask="+"+value+"(qq)qqq-qq-qq";
                                            $("#ik_desc1").mask($mask)
                                            break

                                        case 380:
                                            $mask="+"+value+"(qq)qqq-qq-qq";
                                            //$("#ik_desc").mask($mask);
                                            break

                                        default:
                                            $mask="+"+value+"(qqq)qqq-qq-qq";

                                    }
                                    $("#ik_desc2").mask($mask);

                                    //if (value!=="7")
                                    //{$intercity=0.5}

                                    //if (value="1" OR value="61" OR value="972")
                                    //{$intercity=0.2}

                                });

                            }

                            function countrychange4(value)
                            {

                                jQuery(function($){
                                    $mask="+"+value+"(qqq)qqq-qq-qq";
                                    //   $("#ik_desc").mask($mask);
                                    //   $("#ik_desc1").mask($mask);
                                    $("#telephone").mask($mask);
                                    $("#tin").mask("99-9999999");
                                    $("#ssn").mask("999-99-9999");



                                    $id= parseInt(value);
                                    switch ($id)
                                    {
                                        case 49:
                                            $mask="+"+value+"(qqq)qqqq-qq-q?q"
                                            break

                                        case 972:
                                            $mask="+"+value+"(qq)qqq-qq-qq";
                                            $("#telephone").mask($mask)
                                            break

                                        case 380:
                                            $mask="+"+value+"(qq)qqq-qq-qq";
                                            //$("#ik_desc").mask($mask);
                                            break

                                        default:
                                            $mask="+"+value+"(qqq)qqq-qq-qq";

                                    }
                                    $("#telephone").mask($mask);

                                    //if (value!=="7")
                                    //{$intercity=0.5}

                                    //if (value="1" OR value="61" OR value="972")
                                    //{$intercity=0.2}

                                });

                            }



                            document.payment.btn_text.onclick= message;
                            function message()

                            {
                                var result = 0;
                                //alert ($('#ik_desc').prop("value"));
                                if ($('#ik_desc').prop("value").length>=7) { result=1; } else { alert ('Некорректно указан номер!');result=0;return false; }
                                //if ($('#selector0').prop("checked")) { result=1; } else { alert ('Перед использованием, Вы должны принять правила сервиса');result=0;return false; }

                                document.getElementById("demoo").style.visibility = "visible";
                                document.getElementById("demo").style.visibility = "hidden";
                                //var button = document.getElementById("demo").setAttribute("disabled", "disabled");
                                var discount = 1;
                                var lowdiscount = 1;
                                var urladdr = "";
                                var urlcur = "USD";
                                var now = new Date();
                                now=now.toLocaleString();
                                $lowdiscount=1;
                                $discount=0.75;
                                if ($('#selector1').prop("checked"))
                                {
                                    //$("#contenInput").val=0.5;

                                    //urlcur = $('#selector1').prop("value");
                                    $ik_x_amount=1;
                                    document.getElementById('contenInput2').value = 1;
                                    document.getElementById('contenInput').value = (1*$lowdiscount+$intercity*$ik_x_amount).toFixed(2);
                                }

                                if ($('#selector2').prop("checked"))
                                {
                                    //$("#contenInput").val=1.35;
                                    //urlcur = $('#selector2').prop("value");
                                    $ik_x_amount=3;
                                    document.getElementById('contenInput2').value = 3;
                                    //alert (1.35+$intercity*$ik_x_amount);
                                    document.getElementById('contenInput').value = (2.16*$discount+$intercity*$ik_x_amount).toFixed(2);
                                }

                                if ($('#selector3').prop("checked"))
                                {
                                    //$("#contenInput").val(0.5 * $(".mytext").val());
                                    //urlcur = $('#selector3').prop("value");
                                    $ik_x_amount=10;
                                    document.getElementById('contenInput2').value = 10;
                                    document.getElementById('contenInput').value = (6*$discount+$intercity*$ik_x_amount).toFixed(2);
                                }

                                if ($('#selector4').prop("checked"))
                                {
                                    //$("#contenInput").val(0.5 * $(".mytext").val());
                                    //urlcur = $('#selector3').prop("value");
                                    $ik_x_amount=20;
                                    document.getElementById('contenInput2').value = 20;
                                    document.getElementById('contenInput').value = (10.4*$discount+$intercity*$ik_x_amount).toFixed(2);
                                }

                                if ($('#selector5').prop("checked"))
                                {
                                    //$("#contenInput").val(0.5 * $(".mytext").val());
                                    //urlcur = $('#selector3').prop("value");
                                    $ik_x_amount=40;
                                    document.getElementById('contenInput2').value = 40;
                                    document.getElementById('contenInput').value = (17.6*$discount+$intercity*$ik_x_amount).toFixed(2);
                                }

                                if ($('#selector6').prop("checked"))
                                {
                                    //$("#contenInput").val(0.5 * $(".mytext").val());
                                    //urlcur = $('#selector3').prop("value");
                                    $ik_x_amount=120;
                                    document.getElementById('contenInput2').value = 120;
                                    document.getElementById('contenInput').value = (52.8*$discount+$intercity*$ik_x_amount).toFixed(2);
                                }


                                if ($('#selector7').prop("checked"))
                                {
                                    //$("#contenInput").val(0.5 * $(".mytext").val());
                                    //urlcur = $('#selector3').prop("value");
                                    $ik_x_amount=1440;
                                    document.getElementById('contenInput2').value = 1440;
                                    document.getElementById('contenInput').value = (423+$intercity*$ik_x_amount).toFixed(2);
                                }

                                $.ajax({url:'http://sexcall.su/ocean/payments_request.php?', type: 'GET', dataType: 'json', async: false, data:{dt: now, phone: $('#ik_desc').prop("value"), amount:document.getElementById('contenInput').value,cur:urlcur}})

                            };

                        </script>
                        <div class="response profile-content">
                            <?
                            $balsms=0;
                            $tar=$_GET[tar];
                            $sendhours = date("H:i");

                            if($sendhours >= '19:30')
                            {$balsms=1;}
                            if($sendhours <= '08:30')
                            {$balsms=1;}

                            function convert($from, $to, $var)
                            {
                                if (is_array($var))
                                {
                                    $new = array();
                                    foreach ($var as $key => $val)
                                    {
                                        $new[convert($from, $to, $key)] = convert($from, $to, $val);
                                    }
                                    $var = $new;
                                }
                                else if (is_string($var))
                                {
                                    $var = iconv($from, $to, $var);
                                }

                                return $var;
                            }
                            if($_POST[to]==true)
                            {
                                echo "<div id='buu'></div><div class='info'>Вы ввели номер $_POST[to]";
                                $prints= file_get_contents ("http://sexcall.su/ocean/oceansite_balance.php?to=$_POST[to]"."&balsms=".$balsms);
                                //$prints= file_get_contents ("http://sexcall.su/ocean/oceansite_balance_precheck.php?to=$_GET[toto]");
                                //$prints= iconv("windows-1251","UTF-8",  $prints);
                                if ($prints!=='0'){
                                    echo "<br>Осталось минут: $prints мин.</div>";

                                } else
                                {
                                    echo "<br>Осталось минут: $prints мин.";
                                    echo "<br>Чтобы моментально соединиться с девушкой, отправьте слово <b>CALL</b> на номер <b>5373</b></div>";
                                }
                            }
                            ?>
                            <?
                            if($_POST[toto]==true)
                            {
                                echo "<div class='info'>Вы ввели номер $_POST[toto]";
                                $prints= file_get_contents ("http://sexcall.su/ocean/oceansite_balance_precheck.php?to=$_POST[toto]"."&balsms=".$balsms);
	                        $prints2= file_get_contents ("http://sexcall.su/ocean/call_request.php?to=$_POST[toto]"."&from=callgirl24.ru");
                                //$prints= iconv("windows-1251","UTF-8",  $prints);
                                //echo $prints;
                                $answ = json_decode($prints);
                                ///echo $prints;
                                $pognal=$answ->ru;

                                if ($answ->action=="redirect")
                                {
                                    Header('Location: '.$pognal.'');
                                    //echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0; URL=".$pognal."\">";

                                } else {echo "<br>".$answ->answer."</div>";}

                                //echo "<br>$prints</div>";
                                //echo "<script>unholld();<//script>";

                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function () {
        var hash = window.location.hash;
        hash = hash.replace('#', '');
        if (hash){
            $('.menu-item').removeClass('active');
            $('.menu-item[data-target = '+hash+' ]').addClass('active');
            $('.profile-content').css({'height': 0});
            $('[class*=' + hash + ']').css({'height': 'auto'});
        }else {
            $('.menu-item').first().addClass('active');
            window.location.hash = $('.menu-item').first().attr('data-target');
        }
        $('.menu-item, .profile-trigger').on('click', function () {
            var target = $(this).attr('data-target');
            window.location.hash = target;
            $('.profile-content').css({'height': 0});
            $('[class*=' + target + ']').css({'height': 'auto'});
            $('.menu-item').removeClass('active');
            $(this).addClass('active');
        });
        $('.password-show').on('click', function () {
            if ($('input[id*=password]').attr('type') == 'password' ) {
                $('input[id*=password]').attr('type', 'text');
            }else{
                $('input[id*=password]').attr('type', 'password');
            }
        });
        $('.change-pass form').on('submit', function () {
           var pass_1 = $(this).find('input#password').val();
           var pass_2 = $(this).find('input#password_confirm').val();
           if (pass_1 === pass_2){
               $('.pass_not_equal').addClass('hidden');
               return true;
           }else{
               $('.pass_not_equal').removeClass('hidden');
               return false;
           }
        });
    })
</script>
<script>
    function open_popup(box) {
        $("#background").show()
        $(box).centered_popup();
        $(box).delay(100).show(1);
    }

    function close_popup(box) {
        $(box).hide();
        $("#background").delay(100).hide(1);
    }

    $(document).ready(function() {

        $.fn.centered_popup = function() {
            this.css('position', 'absolute');
            this.css('1top', ($(window).height() - this.height()) / 2 + $(window).scrollTop()*0 + 'px');
            this.css('1left', ($(window).width() - this.width()) / 2 + $(window).scrollLeft()*0 + 'px');
        }

    });
    (function($){
        $(function(){

            $("#cclick").click(hold);

            function hold() {
                if ($('#ik_desc2').prop("value").length<7) { alert ('Некорректно указан номер!');result=0;return false;} else {
                    //$("#cclick").off("click");
                    //setTimeout(function(){$("#cclick").click(hold);}, 20000);
                    $("#cclick").val('Ожидайте соединения');
                    $('#cclick').css({display: 'none'});
                    this.fadeout(1000);
                    //this.disabled=true;

                    setTimeout(function(){this.show();$("#cclick").disabled=false;$("#cclick").val('Позвони мне, позвони!');}, 20000);
                }
            }
        })
    })(jQuery);

    jQuery(function($){
        $("#ik_desc").mask("+7(qqq)qqq-qq-qq");
        $("#telephone").mask("+7(qqq)qqq-qq-qq");
        $("#ik_desc1").mask("+7(qqq)qqq-qq-qq");
        $("#ik_desc2").mask("+7(qqq)qqq-qq-qq");
        $("#tin").mask("99-9999999");
        $("#ssn").mask("999-99-9999");
    });


</script>
<? echo $footer ?>