<link rel="stylesheet" href="../frontend/css/style.css">
<?php
require_once '../frontend/header.html';
require_once './connection.php';
require_once './function.php';

if (!empty($_COOKIE['LogIn'])){
    ?><p class='up'>Добро пожаловать, username!</p>
        
        <form class='up' method='post'>
        <div class="forms">
            <input type="hidden" name="logOut" value="logOut" />
            <button type="submit" class="btn-primary">Выйти</button>
        </div>
    </form>

    <?php
} else {
?>

<div class="class1">
    <div>Регистрация</div>
<form method="post">
    <div class="forms">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="Rusername" pattern="[A-Za-zА-Яа-яЁё]{2,15}" required>
    </div>
    <div class="forms">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="Rpassword" pattern="[A-Za-zА-Яа-яЁё0-9]{5,20}" required>
    </div>
    <button type="submit" class="btn-primary">Зарегистрироваться</button>
</form>
</div>

<div class="class1">
<div>Вход</div>
<link rel="stylesheet" href="../frontend/css/style.css">
<form method="post">
    <div class="forms">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="forms">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn-primary">Вход</button>
</form>
</div>

<?php
};

if (!empty($_POST['logOut'])){
    setcookie('LogIn', 'Welcome_2_the_system', time()-10);
    header('Location: ?');
};

if (!empty($_POST['username'])){
    $result1 = $mysqli -> query('SELECT * FROM users');

    if($result1 -> num_rows){
        while($row = mysqli_fetch_assoc($result1)){
        if (($row['username'] == $_POST['username']) && ($row['password'] == sha1($_POST['password'] . 'shoutsow'))){
            setcookie('LogIn', 'Welcome_2_the_system');
        break;
        } else {?><p>Пользователь, <?php echo $_POST['username'];?>, не найден</p>
        <?php
        };
        };
        header('Location: ?');
    };
};


if (!empty($_POST['Rusername'] && $_POST['Rpassword'])){
    $result = $mysqli -> query('SELECT * FROM users');
        $data['id'] = $mysqli -> insert_id;
        $data['username'] = $_POST['Rusername'];
        $data['password'] = sha1($_POST['Rpassword'] . 'shoutsow');
        $response = array_filter($data, function($el){
            if (empty($el)){
                return false;
            }
            return true;
        });
        insertToDb1($mysqli, $data);
    };
    function insertToDb1($mysqli, array $data)
    {
        $keys = implode(',', array_keys($data));
        $vals = "'" . implode('\',\'', array_values($data)) . "'";
        $query = "INSERT INTO users ($keys) VALUES ($vals)";
        $mysqli -> query($query);

        header('Location: ?');
    };
    echo $query;


require_once '../frontend/footer.html';