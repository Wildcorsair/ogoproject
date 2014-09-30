<?php
    $dataSet = $this->model->getUserData();
?>
<div class="data-block">
    <div class='window-frame large'>
        <div class='caption'>Редактирование данных пользователя</div>
        <p>  
            Имя пользователя:&nbsp
            <input type='text' name='uname' class='text-field' 
                    value='<?php echo $dataSet->fname; ?>'>
            Логин:&nbsp
            <input type='text' name='login' class='text-field'><br /><br />
            E-mail адрес:&nbsp
            <input type='text' name='email' class='text-field'><br /><br />
           Дата регистрации:&nbsp
            <input type='text' name='email' class='text-field'><br /><br />
            Группа пользователя:&nbsp
            <input type='text' name='email' class='text-field'><br /><br />
        </p>
        <div class='btn-bar'>
            <button class='btn large'>Сохранить</button>
        </div>
    </div>
</div>