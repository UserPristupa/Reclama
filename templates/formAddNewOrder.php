<?php
//добавление заказа в базу
/**
 * Created by PhpStorm.
 * User: marevo
 * Date: 05.07.2017
 * Time: 16:30
 */
//require '../autoload.php';
//функция вернет всех Client
function clientsOptions(){
    $option='';
    $clientsAll = \App\Models\Client::findAll();
    foreach ($clientsAll as $rowItem){
            $option .= "<option data-id = '$rowItem->id' value='$rowItem->id'>$rowItem->name</option>";
    }
    return $option;
}
//функция вставки в базу нового заказа
?>
<!DOCTYPE HTML>
<html lang="ru-RU">
<?php //include('../head.html') ?>
<body>
<div class="container">
    <!--<div class="row">
        <?php //require_once('header.html'); ?>
    </div>
    <div class="row"><!-- навигация 
        <?php //include('../navigation.html');?>
        <script>
showLi('создать заказ')
        </script>

    </div>-->
    <div class="row">
       <!-- <div class="col-lg-2 backForDiv">
            этот див слева от таблицы в нем можно расположить дополнительные кнопки добавить редактировать удалить
        </div>-->
        <div class="col-lg-12 backForDiv">
            <!--строка показа времени и показа результата добавки материала в базу  -->
            <?php  include_once 'App/html/forDisplayTimeShowAnswerServer.html'?>
            <div class="row">
                <div class="col-lg-12   col-md-12 col-sm-12 col-xs-12 bg-primary  h2 text-center text-info">создание и добавление в базу нового заказа</div>

            </div>

            <div class="row"><!--форма добавления нового заказа в базу -->
                <div class="col-lg-6">
                        <form  id="formOneOrder"   method="post" action="App/controllers/controllerAddNewOrderToBase.php">
                            <table>
                                <thead><tr>
                                    <td>название поля</td>
                                    <td>значение поля</td></tr></thead>
                                <tbody>
                                <tr><td><label for="idClient">клиент</label></td>
                                    <td><select name="idClient"  required class="fontSizeMedium"><option value="0">выберите клиента</option>
                                            <?php echo clientsOptions();  ?>
                                            <!--                                            <option data-id="1">чп Пупкин В C</option>-->
                                            <!--                                            <option data-id="2">фирма Рога и Копыта</option>-->
                                        </select></td></tr>

                                <tr><td class="text-right"><label for="nameOrder">название заказа</label></td>
                                    <td class="text-left"><textarea type="text" name="nameOrder" cols="60" rows="2" maxlength="120" placeholder="введите название заказа" autofocus required>
                                        </textarea></td>
                                </tr>
                                <tr><td class="text-right"><label for="descriptionOrder">описание заказа заказа</label></td>
                                    <td class="text-left"><textarea type="text" name="descriptionOrder" maxlength="3000"
                                                                    placeholder= "подробное описание заказа максимум 3000 символов"
                                                                    cols="100" rows="5"  required>
                                        </textarea></td>
                                </tr>
                                <tr><td> <label for="source">источник заказа</label></td>
                                    <td><input type="radio" name="source" value="0" checked/> не известен</br>
                                    <input type="radio" name="source" value="1"/> входящий звонок</br>
                                    <input type="radio" name="source" value="2"/> prom.ua</br>
                                    <input type="radio" name="source" value="3"/> olx</br>
                                    <input type="radio" name="source" value="4"/> сайте</br>
                                    <input type="radio" name="source" value="5"/> объявление в газете</br>
                                    <input type="radio" name="source" value="6"/> другой</td></tr>

                                <tr><td><label for="orderPrice">цена заказа</label></td>
                                    <td><input type="text" name="orderPrice" value="0.00" pattern="\d{1,5}(\.)?\d{1,2}" placeholder="введите цену заказа"/></td></tr>
                                <tr><td><label for="manufacturingPrice"> цена составляющих материалов</label></td>
                                    <td><input type="text" name="manufacturingPrice" pattern="\d{1,5}(\.)?\d{2}" value="0.00"/></td></tr>
                                <tr><td><label for="isCompleted">состояние заказа</label></td>
                                    <td><input type="radio" name="isCompleted" value="0" checked/> не укомплектован<br>
                                    <input type="radio" name="isCompleted" value="1"/> укомплектован</td></tr>
                               <tr>
                                   <td><label for="isReady">степень готовности</label></td>
                                   <td><input type="radio" name="isReady" value="0" checked/> новый<br>
<!--                                       <input type="radio" name="isReady" value="1"/>закрыт успешно<br>-->
<!--                                       <input type="radio" name="isReady" value="2"/>закрыт неуспешно<br>-->
<!--                                       <input type="radio" name="isReady" value="3"/>запущен в производство</td>-->
                               </tr>
                               <tr class="trDisplayNone">
                                   <td><label for="isInstall">установлен у клиента</label></td>
                                   <td><input type="radio" name="isInstall" value="0" checked/> не установлен<br>
<!--                                       <input type="radio" name="isInstall" value="1"/>в процессе установки<br>-->
<!--                                       <input type="radio" name="isInstall" value="2"/>установлен</td>-->
                               </tr>
                               <tr>
                                    <td><label for="dateOfOrdering">дата взятия заказа</label></td>
                                    <td><input type="date"  name="dateOfOrdering" required/></td></tr>
<script>
//установить максимальную дату сегодня
document.addEventListener('DOMContentLoaded', function() {
    $('input[name = "dateOfOrdering"]').val(getDate());
    $('input[name = "dateOfComplation"]').val(datePlusDays(14));
});
</script>
                                <tr>
                                    <td><label for="dateOfComplation">дата закрытия заказа</label></td>
                                    <td><input type="date" name="dateOfComplation"></td></tr>
                                <tr style="display: none;">
                                    <td><label for="isAllowCalculateCost">разрешить менять цену комплектующих при изменении стоимости</label></td>
                                    <td><input type="radio" name="isAllowCalculateCost" value="0" /> не разрешать<br><input type="radio" name="isAllowCalculateCost" value="1" checked/>разрешать</td></tr>
                                <tr>
                                    <td></td>
                                    <td><div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="rezZaprosaKServer" >
                                            <div class="uspeh text-center "><span class="glyphicon glyphicon-import "> успешно</span></div>
                                            <div class="noUspeh text-center "><span class="glyphicon glyphicon-alert "> ошибка обратитесь к разработчику</span></div>
                                            <!-- в поле с классом divForAnswerServer будем получать ответы сервера (script ) -->
                                            <div class="divForAnswerServer"></div>
                                        </div></td></tr>
                                <tr><td>кнопка для отправки</td><td><input type="submit" name="submitFromFormOneOrder"/></td></tr>
                                <tr class="trDisplayNone"><td><label for="controlka"></label> контролька</td><td><input name="controlka" value="sendNewOrderToBase"/></td></tr>
                                </tbody>
                            </table>
                        </form>
                    <script>
                        $('form').submit(function(){
                            $(this).find('.alert .alert-info').remove();
//проверка данных отправляемых с формы
                            if($(this).find('select').val() == 0){
                                $(this).find('select').before('<div class="alert alert-info">выберитите клиента из выпадающего списка</div>');
                                return false;
                            }
//                               return;
//                            return false;
//                            $url = $(this).attr('action');
//                            $data=$(this).serializeArray();
//                            $.post(
//                                $(this).attr('action'),//ссылка куда идут данные
////                                $(this).serialize() ,   //Данные формы
//                                $(this).serializeArray()//сериализирует в виде массива
//                            );
////                            return false;
                            $.ajax({
                                type:'POST',
                                url:$(this).attr('action'),//куда идут данные
                                data:$(this).serializeArray(),//данные в виде массива метод serializeArray()
                                success:function (data) {
                                $('.divForAnswerServer').html(data);
                                }
                                
                            });

                            $(this).find('.alert').remove();
                            return false;
                        });
                    </script>
                </div>
            </div><!-- .row ->
        </div>
    </div>
</div>


</body>
</html>
