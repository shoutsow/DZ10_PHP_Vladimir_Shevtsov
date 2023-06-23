<link rel="stylesheet" href="../css/style.css">
<?php
$result3 = $mysqli->query('SELECT AUTHORS.name, POSTS.code, POSTS.title, POSTS.category_id FROM AUTHORS, 
POSTS WHERE AUTHORS.id = POSTS.author_id');
?>
<div class="query_list">
    <?php
if($result3 -> num_rows){
    while($row = mysqli_fetch_assoc($result3)){
        if($row['category_id'] == $_GET['id']){
        ?><li><a href='/articles?category=<?php echo "$_GET[id]"?>&id=<?php echo "$row[code]"?>'><?php echo "$row[name] 
        \"$row[title]\"";?></a></li>
        <?php
        };
    } 
} else {
    echo 'No comments';
};

$result4 = $mysqli -> query('SELECT * FROM POSTS');
if($result4 -> num_rows){
    while($row = mysqli_fetch_assoc($result4)){
        if($row['code'] == $_GET['id']){
        ?><h1><?php echo "$row[title]<br>";?></h1>
        <p class='date'><?php echo (substr($row['date'], 0, 10) . "<br><br>") ?></p>
            <p><?php echo "$row[content]<br>";?></p>
        <?php
        };
    } 
} else {
    echo 'No comments';
};
?>
</div>