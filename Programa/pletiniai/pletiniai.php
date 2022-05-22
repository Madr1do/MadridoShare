<?php
include '../sidemenu.php';


if($_FILES["zip_file"]["name"]) {
	$filename = $_FILES["zip_file"]["name"];
	$source = $_FILES["zip_file"]["tmp_name"];
	$type = $_FILES["zip_file"]["type"];

	$name = explode(".", $filename);
	$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
	foreach($accepted_types as $mime_type) {
		if($mime_type == $type) {
			$okay = true;
			break;
		}
	}

	$continue = strtolower($name[1]) == 'zip' ? true : false;
	if(!$continue) {
		$message = "Failo formatas privalo būti .ZIP";
	}
	else{

		$target_path = "../addons/".$filename;
		if(move_uploaded_file($source, $target_path)) {
			$zip = new ZipArchive();
			$x = $zip->open($target_path);
			if ($x === true) {
				$zip->extractTo("../addons/");
				$zip->close();

				unlink($target_path);
			}
			$message = "Plėtinys pridėtas";
		}

		else {
			$message = "Klaida";
		}

	}
}
?>
<style>
@media only screen and (max-width: 400px){
	.card30{
		width: 87%;
		padding: 1rem 1rem 1rem 1rem;
	}
	.plotis{
		max-width: 92%;
	}
}
@media only screen and (min-width: 400px) and (max-width: 800px){
	.card30{
		width: 92%;
		padding: 1rem 1rem 1rem 1rem;
	}
	.plotis{
		max-width: 96%;
	}
}
</style>
<body>
	<?php echo "<p>$message</p>"; ?>
	<form enctype="multipart/form-data" method="post" action="">
		<div class='card30'>
			<h3 style='margin-top: 0px; color: black'>Naujas plėtinys</h3>
			<label style="display: inline-block; cursor: pointer" class='plotis button' for="files">Įkelti failą</label>
			<input style="display: inline-block; width: 30px; visibility:hidden;" type="file" id="files" name="zip_file" />
			<input style="display: inline-block" class='button' id='issaugoti' type="submit" name="submit" value="Išsaugoti" />
		</div>
	</form>
</body>

<?php
$path    = '../addons';
$files = scandir($path);
$files = array_diff(scandir($path), array('.', '..'));
?><h5 style="color: black; margin-bottom: 3%; font-size: 1.5rem">Pridėtų plėtinių sąrašas:</h5><?php
foreach($files as $file){
	if (strpos($file, "clients") !== false){

			echo "<a style='color: transparent; margin-right: 1rem;' href='../addons/$file/$file'>
				 		 		<div class='card25'>
				 		 			<h3 style='color: #658feb'>Klientai</h3>
				 		 	 		<p style='color: black'>Plėtinys yra skirtas ekrane atvaizduoti visų registruotų klientų sąrašus, bei jų duomenis.</p>
				 		  	</div>
				 		 	</a>";
	}
	if (strpos($file, "accounts") !== false){

			echo "<a style='color: transparent; margin-right: 1rem;' href='../addons/$file/$file'>
		 		 				<div class='card25'>
		 		 					<h3 style='color: #658feb'>Vartotojai</h3>
		 		 	 				<p style='color: black'>Plėtinys yra skirtas ekrane atvaizduoti registruotų vartotojų sąrašus, bei jų duomenis.</p>
		 		  			</div>
 		 					</a>";
	}
	if (strpos($file, "myfiles") !== false){

			echo "<a style='color: transparent; margin-right: 1rem;' href='../addons/$file/$file'>
		 		 				<div class='card25'>
		 		 					<h3 style='color: #658feb'>Mano failai</h3>
		 		 	 				<p style='color: black'>Plėtinys yra skirtas ekrane atvaizduoti sukurtus nuosavus failus.</p>
		 		  			</div>
 		 					</a>";
	}
	if (strpos($file, "calendar") !== false){

			echo "<a style='color: transparent; margin-right: 1rem;' href='../addons/$file/$file'>
		 		 				<div class='card25'>
		 		 					<h3 style='color: #658feb'>Kalendorius</h3>
		 		 	 				<p style='color: black'>Plėtinys yra skirtas ekrane atvaizduoti įvykių kalendorių su svarbiomis datomis.</p>
		 		  			</div>
 		 					</a>";
	}
	if (strpos($file, "chat") !== false){

			echo "<a style='color: transparent; margin-right: 1rem;' href='../addons/$file/$file'>
		 		 				<div class='card25'>
		 		 					<h3 style='color: #658feb'>Bendravimo erdvė</h3>
		 		 	 				<p style='color: black'>Plėtinys yra skirtas atvaizduoti bendrą vartotojų susirašinėjimo erdvę bei žinučių istoriją.</p>
		 		  			</div>
 		 					</a>";
	}
}
?>
