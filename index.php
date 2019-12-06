<?php
	require_once "./backend/func.php";
	require_once "./backend/Point.php";
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="public/css/style-less.css">
		<title>Guilherme Lautert - Teste</title>
	</head>

	<body>
		<ul>
			<li>
				<a href="public/file/_testes.programacao.v3.pdf">Teste PDF</a>
			</li>
			<li>
				<fieldset>
					<legend>Questão 1:</legend>
					<div>
						<span>Input : <pre>Func::rotateArray([1,2,3,4,5,6], 2)</pre></span>
						<span>Output : <?php pr(Func::rotateArray([1,2,3,4,5,6], 2)); ?></span>
					</div>
				</fieldset>
			</li>

			<li>
				<fieldset>
					<legend>Questão 2:</legend>
					<div>
						<span>Input : 
							<pre>
for ($vet = [], $i=1; $i <= 20; $i++){ 
	$vet[] = $i;
}
shuffle($vet);
Func::oddEvenOrder($vet);
							</pre>
						</span>
						<span>Output :
							<?php 
							for ($vet = [], $i=1; $i <= 20; $i++){ 
								$vet[] = $i;
							}
							shuffle($vet);
							pr(Func::oddEvenOrder($vet));
							?>
						</span>
					</div>
				</fieldset>
			</li>

			<li>
				<fieldset>
					<legend>Questão 3:</legend>
					<div>
						<span>Input : <pre>Func::betweenDate('01/03/2003', '01/03/2009')</pre></span>
						<span>Output : <?php pr(Func::betweenDate('01/03/2003', '01/03/2009')); ?></span>
					</div>
				</fieldset>
			</li>

			<li>
				<fieldset>
					<legend>Questão 4:</legend>
					<div>
						<span>Input : <pre>Func::checkCombinations(5,7,5,4,4,4)</pre></span>
						<span>Output : <?php pr(Func::checkCombinations(5,7,5,4,4,4)); ?></span>
					</div>
				</fieldset>
			</li>

			<li>
				<fieldset>
					<legend>Questão 5:</legend>
					<div>
						<span>Input :<pre>
$text = 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting';
$search = 'type';
Func::searchInText($search, $text);</pre>
						</span>
						<span>Output : <?php 
							$text = 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting';
							$search = 'type';
							$lenSearch = strlen($search);

							$results = Func::searchInText($search, $text);
							$results = array_reverse($results);

							$result = $text;
							foreach ($results as $key => $value) {
								$result = substr($result, 0, $value) . '<b>' . substr($result, $value, $lenSearch) . '</b>' . substr($result, $value + $lenSearch);
							}
							pr($result);
						?></span>
					</div>
				</fieldset>
			</li>

			<li>
				<fieldset>
					<legend>Questão 6:</legend>
					<div>
						<span>Input : <pre>
$s1 = new AxisPoint(1,0);
$e1 = new AxisPoint(3,2);
$s2 = new AxisPoint(2,1);
$e2 = new AxisPoint(5,3);
Func::getAreaFromOverlapRetangles($s1, $e1, $s2, $e2);
						</pre></span>
						<span>Output :
							<?php
								$s1 = new AxisPoint(1,0);
								$e1 = new AxisPoint(3,2);
								$s2 = new AxisPoint(2,1);
								$e2 = new AxisPoint(5,3);
								pr(Func::getAreaFromOverlapRetangles($s1, $e1, $s2, $e2));
							?>
						</span>
					</div>
				</fieldset>
			</li>

			<li>
				<fieldset>
					<legend>Questão 7:</legend>
					<div>
						<span>Input : <pre>
$A = new Point('A');
$B = new Point('B');
$C = new Point('C');
$D = new Point('D');
$E = new Point('E');
$F = new Point('F');
$G = new Point('G');
$H = new Point('H');

$structure = new Structure('Map');
$structure->addPoint($A);
$structure->addPoint($B);
$structure->addPoint($C);
$structure->addPoint($D);
$structure->addPoint($E);
$structure->addPoint($F);
$structure->addPoint($G);

$structure->addLink($A, $B, 7);
$structure->addLink($A, $D, 5);
$structure->addLink($B, $D, 9);
$structure->addLink($B, $C, 8);
$structure->addLink($C, $E, 5);
$structure->addLink($B, $E, 7);
$structure->addLink($D, $E, 15);
$structure->addLink($D, $F, 6);
$structure->addLink($F, $E, 8);
$structure->addLink($F, $G, 11);
$structure->addLink($E, $G, 9);

$structure->searchConnection($A, $E);
						</pre></span>
						<span>Output :
							<?php
								$A = new Point('A');
								$B = new Point('B');
								$C = new Point('C');
								$D = new Point('D');
								$E = new Point('E');
								$F = new Point('F');
								$G = new Point('G');
								$H = new Point('H');

								$structure = new Structure('Map');
								$structure->addPoint($A);
								$structure->addPoint($B);
								$structure->addPoint($C);
								$structure->addPoint($D);
								$structure->addPoint($E);
								$structure->addPoint($F);
								$structure->addPoint($G);

								$structure->addLink($A, $B, 7);
								$structure->addLink($A, $D, 5);
								$structure->addLink($B, $D, 9);
								$structure->addLink($B, $C, 8);
								$structure->addLink($C, $E, 5);
								$structure->addLink($B, $E, 7);
								$structure->addLink($D, $E, 15);
								$structure->addLink($D, $F, 6);
								$structure->addLink($F, $E, 8);
								$structure->addLink($F, $G, 11);
								$structure->addLink($E, $G, 9);

								pr($structure->searchConnection($A, $E));
							?>
						</span>
					</div>
				</fieldset>
			</li>

			<li>
				<a href="backend/ER">SQL - Modelo relacional</a>
			</li>
		</ul>

		<script type="text/javascript" src="public/js/jquery-3.4.1.js"></script>
		<script type="text/javascript" src="public/js/application.js"></script>
	</body>
</html>