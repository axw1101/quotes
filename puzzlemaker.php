<head>

	<link rel="stylesheet" type="text/css" href="../css/spectrum.css">
	<script src= "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script> 
	<script type="text/javascript" src="../js/spectrum.js"></script>

	<style>

		.title {
			text-align: center;
			color: darkgoldenrod;
		}

		.words {
			height: 50px;
			text-align: center;
		}

		h1,
		h2,
		h3 {
			text-align: center;
		}

		table {
			border-collapse: separate;
			table-layout: fixed;
			width: 100px;
			height: 200px;
			text-align: center;
		}

		table td,

		table th {
			font-size: 20px;
			padding: 10px;
		}

		.answerkey td {
			width: 200px;
			height: 200px;
			border: 1px solid black;
			padding: none
		}

		#solution {
			display: none;
		}

		#solution2 {
			display: none;
		}
	</style>
	<script>

		function dropInputFocusedOut(e) {
			e.target.remove();
		}

		function dropInputKeyedUp(e,col) {
			var index = +e.target.id.substring(5);
			var j = index%col;
			
			while(document.getElementById('td'+j) != null) {
					
				var td = document.getElementById('td'+j);
				var drag = document.getElementById('drag'+j);
				if(drag!= null && drag.parentNode.id.substring(0,2) != 'td') {
					if(drag.innerText.toLowerCase() == e.target.value.toLowerCase()) {
						e.target.blur();
						document.getElementById('td'+index).appendChild(drag);
						index = index + 1;
						while(document.getElementById('td'+index) != null) {
							if(document.getElementById('td'+index).hasChildNodes() == false) {
								document.getElementById('td'+index).click();
								break;
							}
							index++;
						}
						return true;
					}
				}
				j += col;
			}
			e.target.value = "";
		}

		function dropClicked(ev, col) {
			if(ev.target.hasChildNodes())
				return false;
			ev.target.innerHTML = "<input id='input"+ev.target.id.substring(2)+"' type='text' style='width:100%; outline:none; border:none; padding:0; margin:0;' onfocusout='dropInputFocusedOut(event)' onkeyup='dropInputKeyedUp(event,"+col+")'>";
			document.getElementById('input'+ev.target.id.substring(2)).focus();
		}

		function allowDrop(ev) {
			ev.preventDefault();
			}

		function drag(ev) {
			ev.dataTransfer.setData("text", ev.target.id);
		}

		function drop(ev) {
			ev.preventDefault();
			var data = ev.dataTransfer.getData("text");
			ev.target.appendChild(document.getElementById(data));
		}

		function viewSolution() {
			document.getElementById("solution").style.display = "table";
			document.getElementById("solution2").style.display = "table";
		}

		function clicked(index,col) {
			var i = index%col;
			var dest = `td${i}`;
					
			while(document.getElementById(dest).hasChildNodes()) {
				i += col;
				dest = `td${i}`;
			}
			var src = `drag${index}`;
			document.getElementById(dest).appendChild(document.getElementById(src));
		}

		function clicked_a(index,col) {
			var i = index%col;
			var dest = `td_a${i}`;
					
			while(document.getElementById(dest).hasChildNodes()) {
				i += col;
				dest = `td_a${i}`;
			}
			var src = `drag_a${index}`;
			document.getElementById(dest).appendChild(document.getElementById(src));
		}

		function clicked_b(index,col) {
			var i = index%col;
			var dest = `td_b${i}`;
					
			while(document.getElementById(dest).hasChildNodes()) {
				i += col;
				dest = `td_b${i}`;
			}
			var src = `drag_b${index}`;
			document.getElementById(dest).appendChild(document.getElementById(src));
		}

		function dropClicked_a(ev, col) {
			if(ev.target.hasChildNodes())
				return false;
			ev.target.innerHTML = "<input id='input_a"+ev.target.id.substring(4)+"' type='text' style='width:100%; outline:none; border:none; padding:0; margin:0;' onfocusout='dropInputFocusedOut(event)' onkeyup='dropInputKeyedUp_a(event,"+col+")'>";
			document.getElementById('input_a'+ev.target.id.substring(4)).focus();
		}

		function dropClicked_b(ev, col) {
			if(ev.target.hasChildNodes())
				return false;
			ev.target.innerHTML = "<input id='input_b"+ev.target.id.substring(4)+"' type='text' style='width:100%; outline:none; border:none; padding:0; margin:0;' onfocusout='dropInputFocusedOut(event)' onkeyup='dropInputKeyedUp_b(event,"+col+")'>";
			document.getElementById('input_b'+ev.target.id.substring(4)).focus();
		}

		function dropInputKeyedUp_a(e,col) {
			var index = +e.target.id.substring(7);
			var j = index%col;
		
			while(document.getElementById('td_a'+j) != null) {
				
				var td = document.getElementById('td_a'+j);
				var drag = document.getElementById('drag_a'+j);
				if(drag!= null && drag.parentNode.id.substring(0,4) != 'td_a') {
					if(drag.innerText.toLowerCase() == e.target.value.toLowerCase()) {
						e.target.blur();
						document.getElementById('td_a'+index).appendChild(drag);
						index = index + 1;
						while(document.getElementById('td_a'+index) != null) {
							if(document.getElementById('td_a'+index).hasChildNodes() == false) {
								document.getElementById('td_a'+index).click();
								break;
							}
							index++;
						}
						return true;
					}
				}
				j += col;
			}

			j = index%col;
		
			while(document.getElementById('td_b'+j) != null) {
				
				var td = document.getElementById('td_b'+j);
				var drag = document.getElementById('drag_b'+j);
				if(drag!= null && drag.parentNode.id.substring(0,2) != 'td') {
					//console.log(drag.innerText+" "+e.target.value);
					if(drag.innerText.toLowerCase() == e.target.value.toLowerCase()) {
						e.target.blur();
						document.getElementById('td_a'+index).appendChild(drag);
						index = index + 1;
						while(document.getElementById('td_a'+index) != null) {
							if(document.getElementById('td_a'+index).hasChildNodes() == false) {
								document.getElementById('td_a'+index).click();
								break;
							}
							index++;
						}
						return true;
					}
				}
				j += col;
			}

			e.target.value = "";
		}

		function dropInputKeyedUp_b(e,col) {
			var index = +e.target.id.substring(7);
			var j = index%col;
		
			while(document.getElementById('td_b'+j) != null) {
				
				var td = document.getElementById('td_b'+j);
				var drag = document.getElementById('drag_b'+j);
				if(drag!= null && drag.parentNode.id.substring(0,2) != 'td') {
					//console.log(drag.innerText+" "+e.target.value);
					if(drag.innerText.toLowerCase() == e.target.value.toLowerCase()) {
						e.target.blur();
						document.getElementById('td_b'+index).appendChild(drag);
						index = index + 1;
						while(document.getElementById('td_b'+index) != null) {
							if(document.getElementById('td_b'+index).hasChildNodes() == false) {
								document.getElementById('td_b'+index).click();
								break;
							}
							index++;
						}
						return true;
					}
				}
				j += col;
			}

			j = index%col;
		
			while(document.getElementById('td_a'+j) != null) {
				
				var td = document.getElementById('td_a'+j);
				var drag = document.getElementById('drag_a'+j);
				if(drag!= null && drag.parentNode.id.substring(0,2) != 'td') {
					//console.log(drag.innerText+" "+e.target.value);
					if(drag.innerText.toLowerCase() == e.target.value.toLowerCase()) {
						e.target.blur();
						document.getElementById('td_b'+index).appendChild(drag);
						index = index + 1;
						while(document.getElementById('td_b'+index) != null) {
							if(document.getElementById('td_b'+index).hasChildNodes() == false) {
								document.getElementById('td_b'+index).click();
								break;
							}
							index++;
						}
						return true;
					}
				}
				j += col;
			}

			e.target.value = "";
		}

	</script>
</head>
<body>
	
	<?php

		include("telugu_parser.php");
		include("usefultool.php");

		function ScrambleMaker($quote) {
			$words = explode(" ", $quote );
				foreach($words  as $x => $val){
					$newWords[$x] = mb_str_shuffle($val);
				}
				return implode(" ",$newWords);
		}

		function str_split_unicode($str, $l = 0) {
	    if ($l > 0) {
		        $ret = array();
		        $len = mb_strlen($str, "UTF-8");
			        for ($i = 0; $i < $len; $i += $l) {
			            $ret[] = mb_substr($str, $i, $l, "UTF-8");
			        }
			        return $ret;
		    }
		    return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
		    //return preg_split("/\pL\pM*|./u", $str, -1, PREG_SPLIT_NO_EMPTY);
		}

		function mb_str_shuffle($str) {
		    $tmp = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
		    shuffle($tmp);
		    return join("", $tmp);
		}

		function SplitMaker($quote, $chunks) {
			$quote = str_replace("\n", " ", $quote);
			$t2 = parseToCodePoints($quote);
			$t = array();
			foreach ($t2 as $axe) {
				if (ctype_cntrl($axe) == false) //this exists so we can strip control characters from the set.
				{
					array_push($t, $axe);
				}
			}

			$noletters = Count($t);

			if ($noletters % $chunks == 0) {
				$fodder = 0;
			} else $fodder = 1;
			$fodder2 = ($noletters / $chunks) + $fodder;

			$sample = array();
			$wheeloffortune = array_fill(0, $fodder2, $sample);

			for ($x = 0; $x < $noletters; $x++) {
				$tested = parseToCharacter($t[$x]);

				array_push($wheeloffortune[$x / $chunks], $tested);
			}
			shuffle($wheeloffortune);


			?>
			<button id="captureTable" onclick="takeshot()">Generate</button> 
			<div id="output"></div>
			<script type="text/javascript" src="js/html2canvas.js"></script>
			
			<table border="1" style="width:100%">
			<tbody>
				
			<?php
			$counter = 0;

			foreach ($wheeloffortune as $value) {
				if ($counter % 5 == 0) {
					echo "<tr>";
				}
				echo "<td>";
				foreach ($value as $value2) {
					echo $value2;
				}
				echo "</td>";
				if ($counter % 5 == 4) {
					echo "</tr>";
				}
				$counter++;
			}

			echo "  </tbody>
			</table>
			<br> ";
		}

		function DropM($quote, $col) {
			$quote = str_replace("\n", " ", $quote);
			$t = parseToCodePoints($quote);
			$noletters = Count($t);
			$spaces = array();

			$fodder = ($col - ($noletters % $col));
			$trash = array("-");
			for ($arrayfod2 = 0; $arrayfod2 < $fodder; $arrayfod2++) {
			}

			$nohope = $noletters;
			$noletters = $noletters + $fodder;

			$sample = array();
			$wheeloffortune = array_fill(0, $col, $sample);
			$x = 0;
			$quote_array = array();
			foreach ($t as $axe) {
				$tested = parseToCharacter($axe);
				if (ctype_space($tested) == false && ctype_punct($tested) == false && ctype_cntrl($tested) == false && $x < $nohope) {
					$t = $x % $col;
					array_push($wheeloffortune[$t], $tested);
					array_push($quote_array, $tested);
				} else {
					$t = $x % $col;
					array_push($spaces, $x);
					}
				$x++;
			}
			for ($x = $nohope; $x < $noletters; $x++) {
				array_push($spaces, $x);
			}

			for ($r = 0; $r < $col; $r++) {
				shuffle($wheeloffortune[$r]);
			} ?>


				<br>
				<button id="captureTable" onclick="takeshot()">Generate </button>
				<div id="output"></div>
				<script type="text/javascript" src="js/html2canvas.js"></script>
					<div class="panel" id="capture">
						<div class="panel-group">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<div class="row">
										<div class="col-sm-12">
											<div align="center"><h2>Puzzle</h2></div>
										</div>
									</div>
								</div>
								<br>
								<div id="">
									<table  id="convert" class = "puzzle" border="1" style="width:100%">
									<tbody>
									<?php
										$i = 0;
										for ($y = $noletters - 1; $y > -1; $y--) {
											if ($y % $col == $col - 1) {
												echo "<tr>";
											}

											if (isset($wheeloffortune[$col - 1 - $y % $col][$y / $col])) {
												$alpha = $wheeloffortune[$col - 1 - $y % $col][$y / $col];
												echo "<td><div draggable='true' ondragstart='drag(event)' id='drag$i' onclick='clicked($i,$col)'>$alpha</div></td>";
											} else {
												echo "<td>&#160</td>";
												}

											if ($y % $col == 0) {
												echo "</tr>";
											}
											$i++;
										}


									?>
									
									<tr>
									<?php
										$i=0;
										for ($y = 0; $y < $noletters; $y++) {
											if ($y % $col == 0) {
												echo "<tr>";
											}

											if (in_array($y, $spaces) == false) {
												echo "<td id='td$i' onclick='dropClicked(event,$col)' ondrop='drop(event)' ondragover='allowDrop(event)'></td>";
											} else {
												echo "<td id='td$i' style=\"background-color:#000000;\">&#160</td>";
												}

											if ($y % $col == $col - 1) {
												echo "</tr>";
											}
											$i++;
										}
										echo "<t/body> 
										</table>
										</body> <br> <h1>";							
										echo "</h1>";
									?>
									<div class="panel panel-primary body">
										<div  class="panel-heading">
											<div class="row">
												<div class="col-sm-12">
													<div align="center"><h2>Puzzle Options</h2></div>
												</div>
											</div>
										</div>

										<div class="panel-body">
											<div class="row">
												<div class="col-sm-12" align="center">
													<div class="col-sm-16" >
														<div class="row">
															<div class="col-sm-16" >
																<h3>Choose Option</h3>
															</div>
															<br>
															<div align="center" >
																<div class="row">
																	<div class="col-sm-6" >
																		<label>Square Color</label>
																	</div>
																	<div class="col-sm-6" >
																		<input type="color" id="squarePicker">
																	</div>
																</div>
																<br>

																<div class="row">
																	<div class="col-sm-6" >
																		<label>Letter Color</label>
																	</div>
																	<div class="col-sm-6" >
																		<input type="color" id="colorPicker">
																	</div>
																</div>
																<br>

																<div class="row">
																	<div class="col-sm-6" >
																		<label>Line Color</label>
																	</div>
																	<div class="col-sm-6" >
																		<input type="color" id="linePicker">
																	</div>
																</div>
																<br>
															</div>
														</div>
													</div>											
												</div>
											</div>
										</div>
									</div>										
									<br>

									<div class="panel panel-primary solutionSection">
										<div class="panel-heading ">
											<div class="row">
												<div class="col-sm-12">
													<div align="center"><h2>Solution</h2></div>
												</div>
											</div>
										</div>

										<div class="panel-body">
											<?php
												echo $quote;
											?>
											<br>

											<button id="btnSolution" onclick="viewSolution()">Solution</button><br>
											<table id="solution" border="1" style="width:100%">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<tbody>			
					<tr>
					<?php
						$i = 0;
						for ($y = 0; $y < $noletters; $y++) {
							if ($y % $col == 0) {
								echo "<tr>";
							}

							if (in_array($y, $spaces) == false) {
								echo "<td>".$quote_array[$i]."</td>";
								$i++;
							} else {
								echo "<td style=\"background-color:#000000;\">&#160</td>";
								}

							if ($y % $col == $col - 1) {
								echo "</tr>";
							}	
						}
		}

		function FloatM($quote, $col){
			$quote = str_replace("\n", " ", $quote);
				$t = parseToCodePoints($quote);
				$noletters = Count($t);
				$spaces = array();

				$fodder = ($col - ($noletters % $col));
				$trash = array(" ");
				for ($arrayfod2 = 0; $arrayfod2 < $fodder; $arrayfod2++) {
					array_push($t, $trash);
				}
				$nohope = $noletters;
				$noletters = $noletters + $fodder;


				$sample = array();
				$wheeloffortune = array_fill(0, $col, $sample);
				$x = 0;
				$quote_array = array();
				foreach ($t as $axe) {

					$tested = parseToCharacter($axe);

					if (ctype_space($tested) == false && ctype_punct($tested) == false && ctype_cntrl($tested) == false && $x < $nohope) {
						$t = $x % $col;
						array_push($wheeloffortune[$t], $tested);
						array_push($quote_array,$tested);
					} else {
						$t = $x % $col;
						array_push($spaces, $x);
						}
					$x++;
				}

				for ($r = 0; $r < $col; $r++) {
					shuffle($wheeloffortune[$r]);
				} 

				?>

			<br>
			<button id="captureTable" onclick="takeshot()">Generate</button> 
			<div id="output"></div>
			<script type="text/javascript" src="js/html2canvas.js"></script>		  
				<div class="panel panel-primary" id="capture">
					<div class="panel-group">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-sm-12">
										<div align="center"><h2>Puzzle</h2></div>
									</div>
								</div>
							</div>
							<br>
							<div id="">
								<table  id="convert" class = "puzzle" border="1" style="width:100%">
								<tbody>
								<?php
									$i=0;
									for ($y = 0; $y < $noletters; $y++) {
										if ($y % $col == 0) {
											echo "<tr>";
										}
										$alpha = $wheeloffortune[$y % $col][$y / $col];
										if (in_array($y, $spaces) == false) {
										echo "<td id='td$i' onclick='dropClicked(event,$col)' ondrop='drop(event)' ondragover='allowDrop(event)'></td>";
										} else {
											echo "<td id='td$i' style=\"background-color:#000000;\"> 
											&#160
											</td>";
										}

										if ($y % $col == $col - 1) {
											echo "</tr>";
										}
										$i++;
									}
									
								?>
								<tr>
								<?php
									$i=0;
									for ($y = 0; $y < $noletters; $y++) {
										if ($y % $col == 0) {
											echo "<tr>";
										}
										if (isset($wheeloffortune[$y % $col][$y / $col])) {
											$alpha = $wheeloffortune[$y % $col][$y / $col];

											echo "<td><div draggable='true' ondragstart='drag(event)' onclick='clicked($i,$col)' id='drag$i'>$alpha</div></td>";
										} else {
											echo "<td>&#160</td>";
											}
										if ($y % $col == $col - 1) {
											echo "</tr>";
										}
										$i++;
									}

									echo "</tbody> 
									</table>
									</body> <br> <h1>";
									echo "</h1>";
								?>
								<div class="panel panel-primary body">
									<div  class="panel-heading">
										<div class="row">
											<div class="col-sm-12">
												<div align="center"><h2>Puzzle Options</h2></div>
											</div>
										</div>
									</div>

									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12" align="center">
												<div class="col-sm-16" >
													<div class="row">
														<div class="col-sm-16" >
															<h3>Choose Option</h3>
														</div>
														<br>
														<div align="center" >
															<div class="row">
																<div class="col-sm-6" >
																	<label>Square Color</label>
																</div>
																<div class="col-sm-6" >
																	<input type="color" id="squarePicker">
																</div>
															</div>
															<br>

															<div class="row">
																<div class="col-sm-6" >
																	<label>Letter Color</label>
																</div>
																<div class="col-sm-6" >
																	<input type="color" id="colorPicker">
																</div>
															</div>
															<br>

															<div class="row">
																<div class="col-sm-6" >
																	<label>Line Color</label>
																</div>
																<div class="col-sm-6" >
																	<input type="color" id="linePicker">
																</div>
															</div>
															<br>
														</div>
													</div>
												</div>											
											</div>
										</div>
									</div>
								</div>								
								<br>

								<div class="panel panel-primary solutionSection">
									<div class="panel-heading ">
										<div class="row">
											<div class="col-sm-12">
												<div align="center"><h2>Solution</h2></div>
											</div>
										</div>
									</div>

									<div class="panel-body">
										<?php
										echo $quote;
										?>
										<br>

										<button id="btnSolution" onclick="viewSolution()">Solution</button><br>
										<table id="solution" border="1" style="width:100%">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<tbody>
				<tr>
				<?php
					$i = 0;
					for ($y = 0; $y < $noletters; $y++) {
						if ($y % $col == 0) {
							echo "<tr>";
						}
								
						if (in_array($y, $spaces) == false) {
							echo "<td>".$quote_array[$i]."</td>";
							$i++;
						} else {
							echo "<td style=\"background-color:#000000;\">&#160</td>";
							}
								
						if ($y % $col == $col - 1) {
							echo "</tr>";
						}	
					}		
		}

		function FloatDrop($quote, $quote2, $col) {

			$quote = str_replace("\n", " ", $quote);
			$quote2 = str_replace("\n", " ", $quote2);
			$t = parseToCodePoints($quote);
			$noletters = Count($t);
			$spaces = array();
			$spaces2 = array();

			if (($noletters % $col) != 0)
			$fodder = ($col - ($noletters % $col));
			$trash = array("-");
			for ($arrayfod2 = 0; $arrayfod2 < $fodder; $arrayfod2++) {
				array_push($t, $trash);
			}
			$nohope = $noletters;
			$noletters = $noletters + $fodder;

			$sample = array();
			$wheeloffortune = array_fill(0, $col, $sample);

			$wheeloffortune2 = array_fill(0, $col, $sample);
			$x = 0;
			$quote_array1 = array();
			foreach ($t as $axe) {
				$tested = parseToCharacter($axe);
				if (ctype_space($tested) == false && ctype_punct($tested) == false && ctype_cntrl($tested) == false && $x < $nohope) {
					$tt = $x % $col;
					array_push($quote_array1, $tested);
					array_push($wheeloffortune[$tt], $tested);
				} else {
					array_push($spaces, $x);
					}
				$x++;
			}

			$t2 = parseToCodePoints($quote2);
			$noletters2 = Count($t2);
														
			if (($noletters2 % $col) != 0)
			$fodder = ($col - ($noletters2 % $col));
			for ($arrayfod2 = 0; $arrayfod2 < $fodder; $arrayfod2++) {
				array_push($t2, $trash);
			}
			$nohope2 = $noletters2;
			$noletters2 = $noletters2 + $fodder;
																
			$quote_array2 = array();
			$x = 0;
			foreach ($t2 as $axe) {
				$tested = parseToCharacter($axe);

				if (ctype_space($tested) == false && ctype_punct($tested) == false && ctype_cntrl($tested) == false && $x < $nohope2) {
					$tt = $x % $col;
					array_push($wheeloffortune2[$tt], $tested);
					array_push($quote_array2, $tested);
				} else {
					array_push($spaces2, $x);
					}
					$x++;
			}

			for ($r = 0; $r < $col; $r++) {
				shuffle($wheeloffortune[$r]);
				shuffle($wheeloffortune2[$r]);
				SwapBoy($wheeloffortune[$r], $wheeloffortune2[$r]);
			} ?>

			<br>
			<button id="captureTable" onclick="takeshot()">Generate </button>
			<div id="output"></div>
			<script type="text/javascript" src="js/html2canvas.js"></script>
			<div class="panel" id="capture">
				<div class="panel-group">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="row">
								<div class="col-sm-12">
									<div align="center"><h2>Puzzle</h2></div>
								</div>
							</div>
						</div>
						<br>
						<div id="">
							<table  id="convert" class = "puzzle" border="1" style="width:100%">
							<tbody>

							<?php
								$i=0;
								for ($y = $noletters - 1; $y > -1; $y--) {
									if ($y % $col == $col - 1) {
										echo "<tr>";
									}

									if (isset($wheeloffortune[$col - 1 - $y % $col][$y / $col])) {
										$alpha = $wheeloffortune[$col - 1 - $y % $col][$y / $col];

										echo "<td><div draggable='true' ondragstart='drag(event)' onclick='clicked_a($i,$col)' id='drag_a$i'>$alpha</div></td>";
									} else {
										echo "<td>&#160</td>";
										if ($y % $col == 0) {
											echo "</tr>";
										}
									}
									$i++;
								}

							?>
							<table border="1" style="width:100%">
							<tbody>
							<tr>
							<?php
								$i=0;
								for ($y = 0; $y < $noletters; $y++) {
									if ($y % $col == 0) {
										echo "<tr>";
									}
									$alpha = $wheeloffortune[$y % $col][$y / $col];
									if (in_array($y, $spaces) == false) {
										echo "<td id='td_a$i' ondrop='drop(event)' onclick='dropClicked_a(event,$col)' ondragover='allowDrop(event)'></td>";
									} else {
										echo "<td id='td_a$i' style=\"background-color:#000000;\"> &#160</td>";
										}
										if ($y % $col == $col - 1) {
											echo "</tr>";
										}
										$i++;
								}
								echo "</tbody>";
							?>
							<table border="1" style="width:100%">
							<tbody>
							<tr>
							<?php
								$i=0;
								for ($y = 0; $y < $noletters2; $y++) {
									if ($y % $col == 0) {
										echo "<tr>";
									}
									if (in_array($y, $spaces2) == false) {
										echo "<td id='td_b$i' onclick='dropClicked_b(event,$col)' ondrop='drop(event)' ondragover='allowDrop(event)'></td>";
									} else {
										echo "<td id='td_b$i' style=\"background-color:#000000;\"> &#160</td>";
										}
										if ($y % $col == $col - 1) {
											echo "</tr>";
										}
									$i++;
								}
								//echo "  </tbody>";
							?>
							<table border="1" style="width:100%">
							<tbody>
							<?php
								$i=0;
								for ($y = 0; $y < $noletters2; $y++) {
									if ($y % $col == 0) {
										echo "<tr>";
									}
									if (isset($wheeloffortune2[$y % $col][$y / $col])) {
										$alpha = $wheeloffortune2[$y % $col][$y / $col];
										echo "<td><div draggable='true' ondragstart='drag(event)' onclick='clicked_b($i,$col)' id='drag_b$i'>$alpha</div></td>";
									} else {
										echo "<td>&#160</td>";
										}
									if ($y % $col == $col - 1) {
										echo "</tr>";
									}
									$i++;
								}
								echo "<t/body> 
								</table>
								</body> <br> <h1>";			
								echo "</h1>";
							?>

							<div class="panel panel-primary body">
								<div class="panel-heading">
									<div class="row">
										<div class="col-sm-12">
											<div align="center"><h2>Puzzle Options</h2></div>
										</div>
									</div>
								</div>

								<div class="panel-body">
									<div class="row">
										<div class="col-sm-12" align="center">
											<div class="row">
												<div class="col-sm-6" >
													<label>Letter Square Color</label>
													<input type="color" id="squarePicker" name="squareColor">
												</div>
											</div>
											<br>

											<div class="row">
												<div class="col-sm-6" >
													<label>Letter Color</label>
													<input type="color" id="colorPicker" name="letterColor">
												</div>
											</div>
											<br>

											<div class="row">
												<div class="col-sm-6" >
													<label>Line Color</label>
													<input type="color" id="linePicker" name="lineColor">
												</div>
											</div>
											<br>										
										</div>
									</div>
								</div>
							</div>
							<br>

							<div class="panel panel-primary solutionSection">
								<div class="panel-heading ">
									<div class="row">
										<div class="col-sm-12">
											<div align="center"><h2>Solution</h2></div>
										</div>
									</div>
								</div>

								<div class="panel-body">
									<?php
										echo $quote;
										echo " / "; 
										echo $quote2;
									?>
									<br>
									<button id="btnSolution" onclick="viewSolution()">Solution</button><br>
									<table id="solution" border="1" style="width:100%">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<tbody>
			<?php
				$i = 0;
				for ($y = 0; $y < $noletters; $y++) {
					if ($y % $col == 0) {
						echo "<tr>";
					}
					if (in_array($y, $spaces) == false) {
						echo "<td>".$quote_array1[$i]."</td>";
						$i++;
					} else {
						echo "<td style=\"background-color:#000000;\">&#160</td>";
						}
						if ($y % $col == $col - 1) {
							echo "</tr>";
						}	
				}
			?>
			</tbody>
			<table id="solution2" border="1" style="width:100%">

			<tbody>
			<?php		
				$i = 0;
				for ($y = 0; $y < $noletters2; $y++) {
					if ($y % $col == 0) {
						echo "<tr>";
					}
					if (in_array($y, $spaces2) == false) {
						echo "<td>".$quote_array2[$i]."</td>";
						$i++;
					} else {
						echo "<td style=\"background-color:#000000;\">&#160</td>";
						}
					if ($y % $col == $col - 1) {
						echo "</tr>";
						}	
				}
				echo "</tbody>
				</table></body>";
				}
			?>

	<script> 	
		$(document).ready(function(){ // <-- use correct syntax
			$('#squarePicker').change(function(){ // <-- use change event
				$('td').css('background-color', $(this).val());
			}); 
		})

		$(document).ready(function(){ // <-- use correct syntax
			$('#colorPicker').change(function(){ // <-- use change event
				$('table').css('color', $(this).val());
			}); 
		})

		$(document).ready(function(){ // <-- use correct syntax
			$('#linePicker').change(function(){ // <-- use change event
				$('td').css('border-color', $(this).val());
			}); 
		})

	</script>
</body>
</html>