<!DOCTYPE html>
<html>
<head>
	<style>
		.error {color: #FF0000;}
	</style>
</head>
<body>
	<?php
		$nimErr = $namaErr = $jkelErr = $alamatErr = $tgllhrErr = "";
		$nim = $nama = $jkel = $alamat = $tgllhr = "";

		$flag = true;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["nim"])) {
				$imErr = "NIM harus diisi";
				$flag = false;
			}else {
				$nim = test_input($_POST["nim"]);
			}

			if (empty($_POST["nama"])) {
				$namaErr = "Nama harus diisi";
				$flag = false;
				}else {
					$nama = test_input($_POST["nama"]);
				}

			if (empty($_POST["jkel"])) {
				$jkel = "Jenis Kelamin harus diisi";
				$flag = false;
			}else {
				$jkel = test_input($_POST["jkel"]);
			}

			if (empty($_POST["alamat"])) {
				$alamat = "Alamat harus diisi";
				$flag = false;
			}else {
				$alamat = test_input($_POST["alamat"]);
			}

			if (empty($_POST["tgllhr"])) {
				$tgllhrErr = "Tanggal Lahir harus diisi";
			}else {
				$tgllhr = test_input($_POST["tgllhr"]);
			}

			//form submit ketika berhasil validasi
			if ($flag){
				$conn = new mysqli("localhost","root","","akademik");

				if ($conn->connect_error) {
					die("connection failed error: ". $conn->connect_error);
				}

				$sql = "INSERT INTO mahasiswa(nim, nama, jkel, alamat, tgllhr) VALUES('$nim', '$nama', '$jkel', '$alamat', '$tgllhr') ";
				if ($conn->query($sql) === TRUE) {
					echo "<script> alert('data saved successfully');</script>";
				}
			}
		}

		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		?>

		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
			<h2>Validasi Data Mahasiswa </h2>
			<table>
			<tr>
				<td>NIM :</td>
				<td><input type = "text" name = "nim" placeholder="NIM">
				<span class = "error">* <?php echo $nimErr;?></span>
				</td>
			</tr>
			<tr>
				<td>Nama : </td>
				<td><input type = "text" name = "nama" placeholder="Nama">
				<span class = "error">* <?php echo $namaErr;?></span>
				</td>
			</tr>
			<tr>
				<td>Jenis Kelamin :</td>
				<td> <input type = "radio" name = "jkel" value="L">Laki-Laki 
					<input type="radio" name="jkel" value="P"> Perempuan
				<span class = "error"><?php echo $jkelErr;?></span>
				</td>
			</tr>
				<tr>
				<td>Alamat :</td>
				<td> <textarea name = "alamat" rows = "5" cols = "40"></textarea></td>
				<span class="error"> <?= $alamatErr; ?></span>
			</tr>
			<tr>
				<td>Tanggal Lahir:</td>
				<td>
				<input type = "date" name = "tgllhr"></input></td>
				<span class = "error">* <?php echo $tgllhrErr;?></span>
				</td>
			</tr>
			<td>
				<td>
				<input class="button btn btn-primary" type = "submit" name = "button">
				</td>
			</td>
</table>
</form>
</body>
</html>