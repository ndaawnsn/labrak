<?php 
    session_start();
    require "function/functions.php";


?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW92+wZxRZpfpicUBCF7rLKemVjVyFeonpyQt50uNKzW84zsDDgzXsxRT/KoSv9l0nFM6U8YT/+JPPO" crossorigin="anonymous" />
	<title>Lihat-Data Pelaporan</title>
	<link rel="shortcut icon" href="img/logoIcon.png">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<style>
		body {
			font-family: 'Open Sans', sans-serif;
			background-color: #f7f7f7;
		}

		.container {
			max-width: 800px;
			margin: 50px auto;
			padding: 20px;
			background-color: #fff;
			border: 1px solid #ddd;
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
		}

		.header {
			display: flex;
			align-items: center;
			margin-bottom: 20px;
		}

		.title {
			font-size: 24px;
			font-weight: bold;
			margin-left: 10px;
			color: #337ab7;
		}

		.form-group {
			margin-bottom: 20px;
		}

		.label {
			font-weight: bold;
			margin-bottom: 10px;
		}

		.input_nama {
			width: 100%;
			padding: 10px;
			border: 1px solid #ccc;
		}

		.input_simpan {
			width: 100%;
			padding: 10px;
			border: none;
			border-radius: 5px;
			background-color: #337ab7;
			color: #fff;
			cursor: pointer;
		}

		.input_simpan:hover {
			background-color: #23527c;
		}

		.red {
			color: #FF0000;
		}

		.white {
			color: #FFFFFF;
		}
		.bek{
			background: #337ab7;
			padding: 5px;
		}
	</style>
</head>
<body>
	<div class="bek">
		<a href="laporan.php">
		<svg xmlns="http://www.w3.org/2000/svg" height="34px" viewBox="0 -960 960 960" width="34px" fill="#e8eaed"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
		</a>
		
	</div>

	<?php 
		if(isset($_GET['noreg']) && isset($_GET['lihat'])){
			$queryta=mysqli_query($koneksi,"SELECT * FROM pelaporan WHERE nomor_register='$_GET[noreg]'");
			$datata=mysqli_fetch_assoc($queryta);
	?>
	
	<div class="container">
		<div class="header">
			<i class="fas fa-user" style="width:20px; height:20px;"></i>
			<div class="title">Data Tugas Akhir - No. Registrasi : <?php echo $_GET['noreg'];?></div>
		</div>

		<form action="simpan_data.php?noreg=<?php echo $datata['nomor_register'];?>" method="POST">
			<div class="row">
				<!-- col-1 -->
			<div class="row g-2">
       		 <div class="col-6">
         		 <div class="form-group">
						<label for="nim" class="label">Tanggal Pengajuan:</label>
						<input class="input_nama" type="text" readonly value="<?php echo $datata['tanggal'];?>">
					</div>
					<div class="form-group">
						<label for="nim" class="label">NIK :</label>
						<input class="input_nama" type="text" readonly value="<?php echo $datata['nik'];?>">
					</div>
					<div class="form-group">
						<label for="nim" class="label">Nama Pelapor :</label>
						<input class="input_nama" type="text" readonly value="<?php echo $datata['nama_pelapor'];?>">
					</div>
					<div class="form-group">
						<label for="nim" class="label">Nomor Pelapor :</label>
						<input class="input_nama" type="text" readonly value="<?php echo $datata['nomor_pelapor'];?>">
					</div>
					<div class="form-group">
						<label for="nim" class="label">Pekerjaan Pelapor :</label>
						<input class="input_nama" type="text" readonly value="<?php echo $datata['pekerjaan_pelapor'];?>">
					</div>
					<div class="form-group">
						<label for="nim" class="label">Alamat Pelapor :</label>
						<textarea class="input_nama" name="" id="" cols="30" rows="5" readonly><?php echo $datata['alamat_pelapor'];?></textarea>
					</div>
          			
        	</div>

				<div class="col-6">
					<div class="form-group">
						<label for="nim" class="label">NAMA KORBAN :</label>
						<input class="input_nama" type="text" readonly value="<?php echo $datata['nama_korban'];?>">
					</div>
					<div class="form-group">
						<label for="nim" class="label">ALAMAT KORBAN :</label>
						<textarea class="input_nama" name="" id="" cols="30" rows="5" readonly><?php echo $datata['alamat_korban'];?></textarea>
					</div>
					<div class="form-group">
						<label for="nim" class="label">JENIS KELAMIN KORBAN :</label>
						<input class="input_nama" type="text" readonly value="<?php echo $datata['jk_korban'];?>">
					</div>
          		<div class="form-group">
						<label for="nim" class="label">Hubungan Pelapor dan Korban :</label>
						<input class="input_nama" type="text" readonly value="<?php echo $datata['hub_peldankor'];?>">
					</div>
					<div class="form-group">
						<label for="nim" class="label">PEKERJAAN KORBAN :</label>
						<input class="input_nama" type="text" readonly value="<?php echo $datata['pekerjaan_korban'];?>">
					</div>
          		<div class="form-group">
						<label for="nim" class="label">NOMOR KORBAN :</label>
						<input class="input_nama" type="text" readonly value="<?php echo $datata['nomor_korban'];?>">
					</div>
					<div class="form-group">
						<label for="nim" class="label">Jenis Kasus :</label>
						<input class="input_nama" type="text" readonly value="<?php echo $datata['jenis_kasus'];?>">
					</div>
			</div>
		</div>
			<div class="d-flex flex-column w-100">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="nim" class="label">Kronologi :</label>
							<textarea class="input_nama" name="" id="" cols="30" rows="10" readonly><?php echo $datata['kronologi'];?></textarea>
						</div>
						<div class="form-group">
							<label for="nim" class="label">Tindak Lanjut Yang Diinginkan :</label>
							<textarea class="input_nama" name="" id="" cols="30" rows="10" readonly><?php echo $datata['tindak_lanjut'];?></textarea>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="nama" class="label">Status :</label>
					<select class="input_nama" name="status" id="" required>
						<option value=""></option>
						<option value="Selesai">Selesai</option>
						<option value="Tidak Selesai">Tidak Selesai</option>
					</select>
				</div>

				<div class="form-group">
					<input class="input_simpan" type="submit" value="Simpan">
				</div>
				
			</div>

		</form>
	</div>

<?php }
?>
