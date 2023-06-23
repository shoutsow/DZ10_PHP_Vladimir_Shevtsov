<link rel="stylesheet" href="../frontend/css/style.css">

<?php
require_once '../frontend/header.html';
require_once './connection.php';
require_once './function.php';
?>

<div class="query_list">

    <form method="post" class='upl'>
        <div class="forms">
            <label for="title" class="form-label">Название статьи</label>
            <input type="text" class="form-control" name="title" required>
        </div>

    <div class="forms">
        <label for="author" class="form-label">Автор статьи</label>
        <input list="author" class="form-author" name="author" required>
        <datalist id="author">

        <?php

        $result2 = $mysqli -> query ('SELECT * FROM AUTHORS');
        ?>

        <div class="all">

        <?php
        if($result2 -> num_rows)
        {
            while($row = mysqli_fetch_assoc($result2)){
        ?>
        
        <option><?php echo "$row[id]";?></option>
        
        <?php
            } 
        } else {
        ?>
        <option><?php echo "Нет авторов";?></option>
        
        <?php
        };
        ?>

        </datalist>
    </div>
</div>

<div class="forms">
    <label for="categories" class="form-label">Категория статьи</label>
    <input list="categories" class="form-categories" name="categories" required>
    <datalist id="categories">

    <?php

        $result4 = $mysqli -> query ('SELECT * FROM CATEGORIES');
    ?>
    <div class="query_list">

        <?php
        if($result4 -> num_rows)
        {
            while($row = mysqli_fetch_assoc($result4)){
        ?>

        <option><?php echo "$row[id]";?></option>

        <?php
            }
        } else {
        ?>
        
        <option><?php echo "Нет категории";?></option>

        <?php
        };
        ?>

    </datalist>
    </div>
</div>
    
<div class="forms">
    <label for="text" class="form-label">Описание</label>
    <textarea rows="1" cols="26" name="text" required></textarea>
</div>

<button type="submit" class="btn-primary">Отправить</button>
</form>

</div>


<?php

if (!empty($_POST)) {
    $data['id'] = $mysqli -> insert_id;
    $data['title'] = $_POST['title'];
    $data['code'] = translit_path($_POST['title']);
    $data['content'] = $_POST['text'];
    $data['category_id'] = (int) $_POST['categories'];
    $data['author_id'] = (int) ($_POST['author']);
    $response = array_filter($data, function($el){
        if (empty($el)){
            return false;
        }
        return true;
    });
        insertToDb($mysqli, $data);

}

function insertToDb($mysqli, array $data)
{
    $keys = implode(',', array_keys($data));
    $vals = "'" . implode('\',\'', array_values($data)) . "'";
    $query = "INSERT INTO POSTS ($keys) VALUES ($vals)";
    $mysqli -> query($query);
    header('Location: /');
}
echo $query;

require_once '../frontend/footer.html';
