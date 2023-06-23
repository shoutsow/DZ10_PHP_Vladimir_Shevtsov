<?php
function translit_path($value)
{
	$converter = array(
		'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
		'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
		'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
		'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
		'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
		'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
		'э' => 'e',    'ю' => 'yu',   'я' => 'ya',

	);

	$value = mb_strtolower($value);
	$value = strtr($value, $converter);
	$value = mb_ereg_replace('[^-0-9a-z\.]', '-', $value);
	$value = mb_ereg_replace('[-]+', '-', $value);
	$value = trim($value, '-');    

	return $value;
};

function upload($result1){
    $date = date("Y-m-d-H.i.s");
    $name = $_POST['example'] . $date;
    if(!file_exists('../upload')) {
        mkdir('../upload');
    }
    while($row = mysqli_fetch_assoc($result1)){
        file_put_contents("../upload/$name.csv", implode(";;", $row) . PHP_EOL, FILE_APPEND);
    };
    ?>
    <p class='f_up'><?php echo "Файл \"$name\" сформирован";?> и доступен в папке upload</p>
    <?php
};
