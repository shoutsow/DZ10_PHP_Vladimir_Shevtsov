<link rel="stylesheet" href="../frontend/css/style.css">
<?php
require_once '../frontend/header.html';
require_once './connection.php';
require_once './function.php';
if (empty($_COOKIE['LogIn'])){
    ?><p class='all'>Пожалуйста, <a href='./LogIn.php'>войдите</a> в систему или пройдите <a href='./LogIn.php'>регистрацию</a>!</p>
    
    <?php 
} else {
?>

<div class='up'>
<div class="upPost">
<form class='upload' method='post'>
<div class="forms">
    <label for="title" class="form-label">Все статьи</label>
    <input type="hidden" name="example" value="upPost" />
    <button type="submit" class="btn-primary">Выгрузить</button>
    </div>
</form>
</div>

<div class="upAuth">
<form class='upload' method='post'>
<div class="forms">
    <label for="title" class="form-label">Все авторы</label>
    <input type="hidden" name="example" value="upAuth" />
    <button type="submit" class="btn-primary">Выгрузить</button>
    </div>
    </form>
</div>

<div class="upCat">
<form class='upload' method='post'>
<div class="forms">
    <label for="title" class="form-label">Все категории</label>
    <input type="hidden" name="example" value="upCat" />
    <button type="submit" class="btn-primary">Выгрузить</button>
    </div>
    </form>
</div>
</div>
<?php 
    require_once './connection.php';
    $result1 = $mysqli -> query('SELECT * FROM POSTS');
    $result2 = $mysqli -> query('SELECT * FROM AUTHORS');
    $result3 = $mysqli -> query('SELECT * FROM CATEGORIES');

if (!empty($_POST['example']) && ($_POST['example'] == 'upPost')){
    upload($result1);
} elseif(!empty($_POST['example']) && ($_POST['example'] == 'upAuth')){
    upload($result2);
} elseif(!empty($_POST['example']) && ($_POST['example'] == 'upCat')){
    upload($result3);
}
};

require_once '../frontend/footer.html';