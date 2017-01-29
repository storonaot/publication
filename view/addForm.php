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

$session = isset($_COOKIE['session']) ? $_COOKIE['session'] : false;
$user = $session ? new Model_user($session) : false;
?>

<!DOCTYPE html>
<html>
<head>
<title>Добавить новость</title>
</head>

<?php include_once('partial/header.php'); ?>

<div class="container">
  <div class="content">
    <?php
    	if ($user) {
    		?>
    	<form method="post" class="form">
        <h1 class="like-h1">Добавить запись</h1>
    		<?php
    		$properties = array_filter($arr['properties'], 'filter_ids', ARRAY_FILTER_USE_KEY);
    		foreach ($properties as $key => $value) {
    			switch ($key) {
    				case 'date':
    					echo '<div class="form__field"><label class="form__label">'.$labels[$key].'</label><input type="date" name="'.$key.'" placeholder="'.$key.'"></div>';
    					break;
    				case 'date_add':
    					echo '<div class="form__field"><label class="form__label">'.$labels[$key].'</label><input type="date" name="'.$key.'" placeholder="'.$key.'"></div>';
    					break;
    				case 'date_actual':
    					echo '<div class="form__field"><label class="form__label">'.$labels[$key].'</label><input type="date" name="'.$key.'" placeholder="'.$key.'"></div>';
    					break;
    				case 'text':
    					echo '<div class="form__field"><label class="form__label">'.$labels[$key].'</label><textarea name="'.$key.'" placeholder="'.$key.'"></textarea></div>';
    					break;
    				default:
    					echo '<div class="form__field"><label class="form__label">'.$labels[$key].'</label><input type="text" name="'.$key.'" placeholder="'.$key.'"></div>';
    					break;
    			}
    		}
    		?>
    		<input type="hidden" name="user_id" value="<?=$user->id?>">
    		<input type="submit" class="button">
    	</form>
    	<?php }
    	else {
    		echo '<a href="/'.BASE.'">Авторизируйтесь, чтобы добавить запись</a>';
    	}
    	 ?>
  </div>

</div>

</body>
</html>
