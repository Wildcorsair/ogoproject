<?php
    $dataSet = $this->model->getUserData();
    $dataSet = $dataSet[0];
?>
<form action='/cpanel/userSave' method='POST'>
    <div class="data-block">
        <div class='window-frame grey large'>
            <div class='caption'>Редактирование данных пользователя</div> 
            <div class='workspace'>
                <table class='form-controls-grid'>
                    <tr>
                        <td>Имя пользователя</td>
                        <td><input type='text' name='uname' class='text-field' 
                                    value='<?php echo $dataSet->fname; ?>'>
                            <input type='hidden' name='uID'
                                    value='<?php echo $dataSet->fid; ?>'>
                        </td>
                        <td class='large'>Логин</td>
                        <td>
                            <input type='text' name='login' 
                                    class='text-field' disabled 
                                    value='<?php echo $dataSet->flogin; ?>'>
                        </td>
                    </tr>
                    <tr>
                        <td>E-mail адрес</td>
                        <td>
                            <input type='text' name='email' class='text-field' 
                            value='<?php echo $dataSet->fuserMail; ?>'>
                        </td>
                    </tr>
                    <tr>
                        <td>Дата регистрации</td>
                        <td>
                            <input type='text' name='regDate' 
                            class='text-field' size='8'
                            value='<?php echo $this->model->dateExtract($dataSet->fcreateAccount); ?>'>
                        </td>
                    </tr>
                    <tr>
                        <td>Группа пользователя</td>
                        <td>
                            <div id='1' class='dropdown'>
                                <input class='' type='text' 
                                name='groupVal' value='<?php echo $dataSet->fgroup_name; ?>'>
                                <input type='hidden' name='groupId' 
                                value='<?php echo $dataSet->fgroup_id; ?>'>
                                <div class='dd-btn ico-down'></div>                     
                                <div class='items' id='1'>
                                    <ul>
                                        <?php
                                            $this->model->getGroups();
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class='btn-bar'>    
                <button class='btn large success' name='usrDataSave'>Сохранить</button>
                <button class='btn normal' name='usrDataCancel'>Отмена</button>
            </div>
        </div>
    </div>
<form>