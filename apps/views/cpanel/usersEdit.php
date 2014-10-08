<?php
    $dataSet = $this->model->getUserData();
?>
<div class="data-block">
    <div class='window-frame large'>
        <div class='caption'>Редактирование данных пользователя</div> 
        <div class='workspace'>
            <table class='form-controls-grid'>
                <tr>
                    <td>Имя пользователя</td>
                    <td><input type='text' name='uname' class='text-field' 
                                value='<?php echo $dataSet->fname; ?>'></td>
                    <td class='large'>Логин</td>
                    <td>
                        <input type='text' name='login' 
                                class='text-field' disabled 
                                value='<?php echo $dataSet->flogin; ?>'>
                    </td>
                </tr>
                <tr>
                    <td>E-mail адрес</td>
                    <td><input type='text' name='email' class='text-field'></td>
                </tr>
                <tr>
                    <td>Дата регистрации</td>
                    <td>
                        <input type='text' name='regDate' 
                                class='text-field' size='8'>
                    </td>
                </tr>
                <tr>
                    <td>Группа пользователя</td>
                    <td>
                        <div id='1' class='dropdown'>
                            <input class='' type='text' 
                                    name='prmVal' value='Select ...'>
                            <input type='hidden' name='prmId' value='1'>
                            <div class='dd-btn ico-down'></div>                     
                            <div class='items' id='1'>
                                <ul>
                                    <li data-value='read'>Чтение</li>
                                    <li data-value='write'>Запись</li>
                                    <li data-value='full'>Полный доступ</li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class='btn-bar'>
            <button class='btn large success'>Сохранить</button>
            <button class='btn normal'>Отмена</button>
        </div>
    </div>
</div>