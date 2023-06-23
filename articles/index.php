<?php
require_once '../frontend/header.html';
require_once '../backend/connection.php';
?>
<link rel="stylesheet" href="../frontend/css/style.css">

<div class="class1">
    <ul>
<?php
$result = $mysqli -> query('SELECT * FROM CATEGORIES');

if($result -> num_rows){
    while($row = mysqli_fetch_assoc($result)) {
        ?><li><a href='/articles?id=<?php echo "$row[id]"?>'><?php echo "$row[name]<br>"; ?></a></li>
        <?php

    } 
} else {
    echo 'Категории отсутствуют';
};


?>
</ul>
</div>
<?php if (empty($_GET)){?>
<div class="p_views">
<ul>
    <?php
     $result2 = $mysqli -> query('SELECT * FROM POSTS Order by id desc LIMIT 6');
    if($result2 -> num_rows){
        while($row = mysqli_fetch_assoc($result2)){
            ?><li><a href='/articles?id=<?php echo "$row[code]"?>'><b><?php echo "$row[title]<br>"; ?></b></a>
            <p class='date'><?php echo substr($row['date'], 0, 10) ?></p>
            <p><?php echo "$row[content]<br><br>"; ?></p>
        </li>
    <?php
        } 
    } else {
        echo 'Статьи отсутствуют';
    };
    ?>
</ul>
</div>

<?php

} else { require_once './pages.php';
};
require_once '../frontend/footer.html';