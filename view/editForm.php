<?php
function filter_ids($key) {
	$except = array('id', 'user_id');

	return !in_array($key, $except);
}

$labels = array(
	'title' => 'Название',
	'date' =>'Дата публикации',
	'date_actual' =>'Дата актуальности',
	'text' =>'Текст',
	'source' =>'Источник',
	'author' =>'Автор',
);
?>
<!DOCTYPE html>
<html>
<head>
<title>Редактирование</title>
</head>
<body>
	<form method="post">
		<?php
		$publication = array_filter($arr['publication']->properties, 'filter_ids', ARRAY_FILTER_USE_KEY);
		foreach ($publication as $key => $value) {
			switch ($key) {
				case 'date':
					echo '<label>'.$labels[$key].'</label><input type="date" value="'.date_format(date_create($value), "Y-m-d").'" name="'.$key.'" placeholder="'.$key.'"><br>';
					break;
				case 'date_actual':
					echo '<label>'.$labels[$key].'</label><input type="date" value="'.date_format(date_create($value), "Y-m-d").'" name="'.$key.'" placeholder="'.$key.'"><br>';
					break;
				case 'text':
					echo '<label>'.$labels[$key].'</label><textarea name="'.$key.'" placeholder="'.$key.'">'.$value.'</textarea><br>';
					break;
				default:
					echo '<label>'.$labels[$key].'</label><input type="text" value="'.$value.'" name="'.$key.'" placeholder="'.$key.'"><br>';
					break;
			}
		}
		?>
		<input type="submit">
	</form>
</body>
</html>
