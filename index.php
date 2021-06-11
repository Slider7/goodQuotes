<!DOCTYPE html>
<html lang='ru'>
<head>
<title>Простейший пример скрипта</title>
<meta charset='utf-8'>
</head>
<bcdy>
<hl>Добрый день!</hl>
<p>
<?php
	$dat = date("d.m y");
	$tm = date("H:i:s");
	echo "Текущая дата: $dat года<br />\n";
	echo "Текущее время: $tm<br />\n";
	echo "Квадраты и кубы 5ти первых чисел:<br />\n";
	echo "<ul>\n";
	for ($i = 1; $i <= 5; $i++) {
		echo "<li>$i в квадрате = " . ($i * $i) . ", $i в кубе = " . ($i * $i * $i) . "</li>\n";
	}

	$a = [];
	foreach (range(1, 10) as $r) {
		array_push($a, $r*$r*$r);
	}
	print_r($a);

	echo("<br>");

	$func = fn(int $num) => $num % 2 == 0 ? 2 : 1;
	print_r(array_map($func, $a));
	
	class User{
		private $id;
		public $name;

		function __construct($name=''){
			$this->name = $name;
			$this->id = random_int(0, 999999);
		}
		
		function getId(){
			return $this->id;
		}
	}
	
	$user1 = new User("Tester");
	print_r($user1);
	echo("<h2> name: $user1->name, id: {$user1->getId()} </h2>")

?>
</ul>
</p>
</body></html>