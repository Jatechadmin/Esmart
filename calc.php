<?php
class hasilbalikan{
	public $kapasitas_plts;
	public $kapasitas_modul;
	public $jumlah_modul;
	public $kapasitas_inverter;
	public $total_berat_beban_sistem_plts;
	public $estimasi_produksi;
	public $total_biaya_investasi;
	public $biaya_modul;
	public $biaya_inverter;
	public $biaya_struktur;
	public $biaya_asesoris;
	public $biaya_instalasi;
	public $estimasi_penghematan;
	public $emisi_karbon;
	public $penanaman_pohon;
	public $bbm_kendaraan_bermotor;
	public $Konsumsi_Listrik_PLN;
	public $Total_kWh_Ekspor;
	public $Tagihan_Listrik_PLN;
	public $Tagihan_TanpaPLTS;
	public $Tagihan_denganPLTS;
	public $pv_density;
	public $akses_rasio;
	public $safety_factor;
	public $DCAC_ratio;
	public $rasio_kinerja;
	public $self_consumption;
	public $kwh_ekspor;
	public $faktor_arah_kemiringan;
	public $Konstanta_emisi_CO2;
	public $Konstanta_Pohon;
	public $kontanta_BBM;
	public $umur_PLTS;
	public $tarif_listrik;
    public $potensi_plts;

}
class coba
{
	private $titik_kordinat;
	private $luas_area;
	private $luas_grid;
	private $jumlah_grid;
	private $daya_terpasang_pln;
	private $tarif_listrik; /*dari database */
	private $tagihan_listrik;
	private $tahun;
	private $bulan_tagihan;
	private $jumlah_hari; /*cari yang auto */
	private $konsumsi_listrik;
	private $jenis_atap; /* user pmemilih */
	private $kemiringan; /* otomatis setelah user memilih */ 
	private $arah_atap;/* Jika Jenis Atap = dak beton, maka otomatis nilai arah = Utara. Selain itu, user pilih manual.  */
	private $sudut_azimut = 0; /* Sesuai nilai Arah Atap (memanggil db_SudutAzimut) */
	private $latLocation = 7.0135;
	private $longLocation = 46.9587;
	private $pv_density;
	private $akses_rasio;
	private $safety_factor;
	private $DCAC_ratio;
	private $rasio_kinerja;
	private $self_consumption;
	private $kwh_ekspor;
	private $Konstanta_emisi_CO2;
	private $Konstanta_Pohon;
	private $kontanta_BBM;
	private $umur_PLTS;
	private $faktor_arah_kemiringan; /* Memanggil simulasi perhitungan Faktor Arah Kemiringan (on progress) */
	private $intensitas_radiasi; /* db_radiasi (API web meteonorm), rumus : Total data1tahun  PV (kWh/kWp)/365 */
	private $luas_aktif;
	private $potensi_plts;
	private $kebutuhan_plts;
	private $kapasitas_disain;
	private $kapasitas_inverter;
	private $kapasitas_modul; /* memanggil hasil simulasi modul */
	private $jumlah_modul;
	private $kapasitas_plts;
	private $berat_modul;/* Memanggi db_modul sesuai hasil simulasi modul yang terpilih */
	private $berat_struktur; /* memanggil db_StrukturMounting */
	private $harga_modul; /* Memanggi db_modul sesuai hasil simulasi modul yang terpilih */
	private $harga_inverter;
	private $harga_struktur; /* Memanggil db_StrukturMounting */
	private $harga_asesoris;
	private $harga_instalasi;
	private $total_berat_beban_sistem_plts;
	private $produksi_plts;
	private $biaya_investasi;
	private $biaya_modul;
	private $biaya_inverter;
	private $biaya_struktur;
	private $biaya_asesoris;
	private $biaya_instalasi;
	private $estimasi_penghematan;
	private $npv;
	private $irr;
	private $waktu_pengembalian;
	private $emisi_karbon;
	private $penanaman_pohon;
	private $bbm_kendaraan_bermotor;
	private $tipe_bangunan;
	private $posisi_pemasangan;
	private $Konsumsi_Listrik_PLN;
	private $Total_kWh_Ekspor;
	private $Tagihan_Listrik_PLN;
	private $Tagihan_TanpaPLTS;
	private $Tagihan_denganPLTS;

	public function initial(){
		$this->titik_kordinat = 10;
		$this->luas_area=$_GET['luas_area'];
		$this->luas_grid=2;
		$this->jumlah_grid=$_GET['jumlah_grid'];
		$this->daya_terpasang_pln=$_GET['daya'];
		$this->tarif_listrik=1467; /*dari database */
		$this->tagihan_listrik=$_GET['tagihan_listrik'];
		$this->bulan_tagihan=$_GET['bulan'];
		$this->tahun=date('Y');
		$this->jumlah_hari=cal_days_in_month(CAL_GREGORIAN, $this->bulan_tagihan, $this->tahun); /*cari yang auto */
		$this->konsumsi_listrik;
		$this->jenis_atap=$_GET['jenis_atap']; /* user pmemilih */
		$this->kemiringan=$_GET['kemiringan_atap']; /* otomatis setelah user memilih */ 
		$this->arah_atap=$_GET['arah_atap']; /* Jika Jenis Atap = dak beton, maka otomatis nilai arah = Utara. Selain itu, user pilih manual.  */
		$this->sudut_azimut=$_GET['sudut_azimut']; /* Sesuai nilai Arah Atap (memanggil db_SudutAzimut) */
		$this->latLocation=$_GET['latLocation']; 
		$this->longLocation=$_GET['longLocation']; 
		$this->pv_density=6; 
		$this->akses_rasio=0.6;
		$this->safety_factor=1.25;
		$this->DCAC_ratio=1.2;
		$this->rasio_kinerja=0.8;
		$this->self_consumption=(90/100);
		$this->kwh_ekspor=(10/100);
		$this->Konstanta_emisi_CO2 = 0.75;
		$this->Konstanta_Pohon = 0.160;
		$this->kontanta_BBM = 8.98;
		$this->umur_PLTS= 20;
		$this->faktor_arah_kemiringan=1.1; /* Memanggil simulasi perhitungan Faktor Arah Kemiringan (on progress) */
		$this->intensitas_radiasi=0; /* db_radiasi (API web meteonorm), rumus : Total data1tahun  PV (kWh/kWp)/365 */
		$this->luas_aktif;
		$this->potensi_plts;
		$this->kebutuhan_plts;
		$this->kapasitas_disain;
		$this->kapasitas_inverter;
		$this->kapasitas_modul=330; /* memanggil hasil simulasi modul */
		$this->jumlah_modul;
		$this->kapasitas_plts;
		$this->berat_modul=0; /* Memanggi db_modul sesuai hasil simulasi modul yang terpilih */
		$this->berat_struktur=9.7; /* memanggil db_StrukturMounting */
		$this->harga_modul=2700000; /* Memanggi db_modul sesuai hasil simulasi modul yang terpilih */
		$this->harga_inverter;
		$this->harga_struktur=1500; /* Memanggil db_StrukturMounting */
		$this->harga_asesoris=2000; 
		$this->harga_instalasi=2000;
		$this->total_berat_beban_sistem_plts;
		$this->produksi_plts;
		$this->biaya_investasi;
		$this->biaya_modul;
		$this->biaya_inverter;
		$this->biaya_struktur;
		$this->biaya_asesoris;
		$this->biaya_instalasi;
		$this->estimasi_penghematan;
		$this->npv;
		$this->irr;
		$this->waktu_pengembalian;
		$this->emisi_karbon;
		$this->penanaman_pohon;
		$this->bbm_kendaraan_bermotor;
		$this->tipe_bangunan=$_GET['tipe_bangunan'];
		$this->posisi_pemasangan=$_GET['posisi_pemasangan'];
		$this->Konsumsi_Listrik_PLN;
		$this->Total_kWh_Ekspor;
		$this->Tagihan_Listrik_PLN;
		$this->Tagihan_TanpaPLTS;
		$this->Tagihan_denganPLTS;
	}
	
	public function calculate(){

		$db_modul;
		$db_pelanggan;
		$db_strukturmounting;
		$servername = "localhost";
        $username = "u774182381_ag28m";
        $password = "EspESDM@123";
        $dbname = "u774182381_DT3Tt";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT Daya_Pelanggan1, Daya_Pelanggan2, Tarif_Listrik FROM db_pelanggan Where RowStatus = 1 AND Jenis_Pelanggan = '".$this->tipe_bangunan."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  $db_pelanggan = mysqli_fetch_all($result,MYSQLI_ASSOC);
		} else {
		  echo "0 results";
		}
		mysqli_free_result($result);

		$sql = "SELECT konstanta_perhitungan,Nilai FROM db_konstanta Where RowStatus = 1 ";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  $db_konstanta = mysqli_fetch_all($result,MYSQLI_ASSOC);
		} else {
		  echo "0 results";
		}
		mysqli_free_result($result);

		$sql = "SELECT merk_modul, outputpower_modul, berat_modul, harga_modul FROM db_modul Where RowStatus = 1";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		  // output data of each row
		  $db_modul = mysqli_fetch_all($result,MYSQLI_ASSOC);
		} else {
		  echo "0 results";
		}
		mysqli_free_result($result);
		if($this->posisi_pemasangan != 'Atap')
		{
			$this->jenis_atap = '-';
		}
		$sql = "SELECT Berat_Mounting, Harga_Struktur, Kemiringan FROM db_strukturmounting Where RowStatus = 1 AND posisi_pemasangan = '".$this->posisi_pemasangan."' AND jenis_atap = '".$this->jenis_atap."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  $db_strukturmounting = mysqli_fetch_all($result,MYSQLI_ASSOC);
		} else {
		  echo "0 results";
		}
		mysqli_free_result($result);
		$conn->close();
		
		/*DB init*/
		foreach($db_pelanggan as $pelanggan){
			if($pelanggan["Daya_Pelanggan1"] == ">")
			{
				if($pelanggan["Daya_Pelanggan2"] != "-"){
					if($this->daya_terpasang_pln > $pelanggan["Daya_Pelanggan2"])
					{
						$this->tarif_listrik = $pelanggan["Tarif_Listrik"];
					}
				}
			}
			else if($pelanggan["Daya_Pelanggan1"] == "<")
			{
				if($pelanggan["Daya_Pelanggan2"] != "-"){
					if($this->daya_terpasang_pln < $pelanggan["Daya_Pelanggan2"])
					{
						$this->tarif_listrik = $pelanggan["Tarif_Listrik"];
					}
				}
			}
			else if($pelanggan["Daya_Pelanggan1"] != "-")
			{
				
				if($pelanggan["Daya_Pelanggan2"] == "-"){
					if($this->daya_terpasang_pln == $pelanggan["Daya_Pelanggan1"])
					{
						$this->tarif_listrik = $pelanggan["Tarif_Listrik"];
					}
				}
				else{
					if($this->daya_terpasang_pln >= $pelanggan["Daya_Pelanggan1"] && $this->daya_terpasang_pln <= $pelanggan["Daya_Pelanggan2"])
					{
						$this->tarif_listrik = $pelanggan["Tarif_Listrik"];
						//echo $this->tarif_listrik;
					}
				}
			}
		}
		
		foreach($db_konstanta as $konstanta){
			if("PV_density" == $konstanta["konstanta_perhitungan"]){
				$this->pv_density=$konstanta["Nilai"];
			}
			if("Akses_Rasio" == $konstanta["konstanta_perhitungan"]){
				$this->akses_rasio=$konstanta["Nilai"];
			}
			if("Safety_Factor" == $konstanta["konstanta_perhitungan"]){
				$this->safety_factor=$konstanta["Nilai"];
			}
			if("DC/AC ratio" == $konstanta["konstanta_perhitungan"]){
				$this->DCAC_ratio=$konstanta["Nilai"];
			}
			if("Rasio Kinerja (RK)" == $konstanta["konstanta_perhitungan"]){
				$this->rasio_kinerja=$konstanta["Nilai"];
			}
			if("Konsumsi_PLTS" == $konstanta["konstanta_perhitungan"]){
				$this->self_consumption=$konstanta["Nilai"];
			}
			if("kWH_Ekspor" == $konstanta["konstanta_perhitungan"]){
				$this->kwh_ekspor=$konstanta["Nilai"];
			}
			if("Faktor_Arah_Kemiringan" == $konstanta["konstanta_perhitungan"]){
				$this->faktor_arah_kemiringan=$konstanta["Nilai"];
			}
			if("Konstanta_emisi_CO2" == $konstanta["konstanta_perhitungan"]){
				$this->Konstanta_emisi_CO2=$konstanta["Nilai"];
			}
			if("Konstanta_Pohon" == $konstanta["konstanta_perhitungan"]){
				$this->Konstanta_Pohon=$konstanta["Nilai"];
			}
			if("kontanta_BBM" == $konstanta["konstanta_perhitungan"]){
				$this->kontanta_BBM=$konstanta["Nilai"];
			}
			if("Umur PLTS" == $konstanta["konstanta_perhitungan"]){
				$this->umur_PLTS=$konstanta["Nilai"];
			}
		}
		
		foreach($db_strukturmounting as $strukturmounting){
			$this->berat_struktur= $strukturmounting["Berat_Mounting"];
			$this->harga_struktur= $strukturmounting["Harga_Struktur"];
		}
		$list_modul = array();
		foreach($db_modul as $modul){
			array_push($list_modul, (object) [
							'outputpower_modul' => $modul["outputpower_modul"],
							'berat_modul' 		=> $modul["berat_modul"],
							'harga_modul' 		=> $modul["harga_modul"],
					  ]);
		}
		//intensitas_radiasi
		$total = 0;

		$lat = $this->latLocation;
		$lon = $this->longLocation;
		$azumut = $this->sudut_azimut;
		$year = date('Y', strtotime('-1 years'));
		try
		{
			$url = "https://mdx.meteotest.ch/api_v1?key=1B462FCFEDB965FDB5A99A826FD8D2B0&service=meteonorm&action=calculatestandardmonthly&lat=".$lat."&lon=".$lon."&azimuth=".$azumut."&inclination=12&format=json&year=".$year;

			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "cache-control: no-cache",
				"content-Type: application/json"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
		}
		catch (Exception $e)
		{
			//echo 'Message: ' .$e->getMessage();
		}

		$response = json_decode($response, true); //because of true, it's in an array

		$checkerror = $response["status"];
		$checkerror = strtoupper($checkerror);
		if($checkerror = "ERROR")
		{
			$total = '4.8';
			//$this->intensitas_radiasi=($total/365);
			$this->intensitas_radiasi= 4.8;
		}
		else
		{
			$meteonorm_target = $response['payload']['meteonorm']['target'];
			foreach($meteonorm_target as $items)
			{
				$total = $total + $items['PV'];
			}
			
			$this->intensitas_radiasi=($total/365);
			//$this->intensitas_radiasi= 4.8;
		}
		/*echo 'Total 1 tahun: '. $total . '<br/>'; */
		
		/*echo "Jumlah intensitas_radiasi :". $this->intensitas_radiasi;
		echo "<br>"; */

		/* menghitung jumlah grid */
		$this->jumlah_grid=$this->luas_area/$this->luas_grid;
		/* echo "Jumlah Grid :". $this->jumlah_grid;
		echo "<br>"; */

		/* menghitung konsumsi listrik */
		$this->konsumsi_listrik=$this->tagihan_listrik/$this->tarif_listrik;
		$this->konsumsi_listrik = ceil($this->konsumsi_listrik);
		 /*echo "Konsumsi Listrik :". $this->konsumsi_listrik;
		echo "<br>"; */

		/* menghitung luas aktif */
		$this->luas_aktif=$this->jumlah_grid*$this->luas_grid*$this->akses_rasio;
		/* echo "Luas Aktif:". $this->luas_aktif;
		echo "<br>"; */

		/* menghitung potensi plts */
		$this->potensi_plts=$this->luas_aktif/$this->pv_density;
		/* echo "Potensi PLTS :". $this->potensi_plts;
		echo "<br>"; */

		/* menghitung kebutuhan plts */
		$this->kebutuhan_plts=($this->konsumsi_listrik*$this->safety_factor)/($this->jumlah_hari*$this->intensitas_radiasi);
		/* echo "Kebutuhan PLTS :". $this->kebutuhan_plts;
		echo "<br>"; */

		/* menghitung kapasitas disain */
		$this->kapasitas_disain=MIN($this->daya_terpasang_pln/1000,$this->potensi_plts,$this->kebutuhan_plts);
		/* echo "Kapasitas Disain :". $this->kapasitas_disain;
		echo "<br>"; */

		/* menghitung kapasitas inverter */
		$this->kapasitas_inverter=ceil($this->kapasitas_disain/$this->DCAC_ratio);
		/* echo "Kapasitas Inverter :". $this->kapasitas_inverter;
		echo "<br>"; */
		
		//Modul simulation
		// sort($list_modul);
		$arrayModulCal = array();
		$_kapasitas_modul=0; 
		$_berat_modul=0; 	  
		$_harga_modul=0; 	  
		$_jumlah_modul=0;
		$_kapasitas_plts=0;
		
		foreach($list_modul as $modul){
			$_kapasitas_modul = $modul->outputpower_modul;
			$_berat_modul 	  = $modul->berat_modul;
			$_harga_modul 	  = $modul->harga_modul;
			
			$_jumlah_modul = ceil($this->kapasitas_inverter*1000/$_kapasitas_modul);
			$_kapasitas_plts = $_kapasitas_modul*$_jumlah_modul/1000;
			if($_kapasitas_plts <= $this->kapasitas_disain){//Kapasitas PLTS tidak lebih dari $kapasitas_disain;
				array_push($arrayModulCal, (object) [
							'_kapasitas_modul' 	=> $_kapasitas_modul,
							'_harga_modul' 	=> $_harga_modul,
							'_jumlah_modul' 	=> $_jumlah_modul,
							'_kapasitas_plts' 	=> $_kapasitas_plts,
							'_berat_modul'		=> $_berat_modul,
							]);
			}
			
			/*echo $this->kapasitas_disain." ----> Kapasitas desain <br/>";
			echo $_kapasitas_plts." ----> Kapasitas plts <br/><br/>";
			echo $_jumlah_modul." ----> _jumlah_modul <br/><br/>";
			echo $this->kapasitas_inverter." ----> Kapasitas inverter <br/>";
			echo $_kapasitas_modul." ----> Kapasitas modul <br/>";
			echo $_berat_modul ." ----> Berat <br/>";
			echo $_harga_modul 	." ----> Harga <br/><br/><br/><br/><br/>";*/
			
		}
		if(empty($arrayModulCal)){
			for($i=0;$i<2;$i++)
			{
				array_push($arrayModulCal, (object) [
								'_kapasitas_modul' 	=> $_kapasitas_modul,
								'_harga_modul' 	=> $_harga_modul,
								'_jumlah_modul' 	=> $_jumlah_modul,
								'_kapasitas_plts' 	=> $_kapasitas_plts,
								'_berat_modul'		=> $_berat_modul,
								]);
			}
		}
		// var_dump(arrayModulCal);
		
		//Pengurutan sesuai kapasitas PLTS
		usort($arrayModulCal, function($a, $b) {
			return strcmp($b->_kapasitas_plts, $a->_kapasitas_plts);
		});
		
		//check apakah ada kesamaan kapasitas_plts : jika ya gunakan kapasitas modul terbesar
		$i = 0;
		$arrayIndexOfHighest = 0;
		$temp_kapasitas_plts = -1;
		foreach($arrayModulCal as $ModulCal){
			
			if($temp_kapasitas_plts == $ModulCal->_kapasitas_plts && $i > 0)
			{
				if($temp_kapasitas_modul < $ModulCal->_kapasitas_modul)
				{
					$arrayIndexOfHighest=$i;
					$this->kapasitas_modul	= $ModulCal->_kapasitas_modul;
					$this->jumlah_modul 	= $ModulCal->_jumlah_modul;
					$this->kapasitas_plts 	= $ModulCal->_kapasitas_plts;
					$this->harga_modul 		= $ModulCal->_harga_modul;
					$this->berat_modul  	= $ModulCal->_berat_modul;

				}else{
					$arrayIndexOfHighest=$i-1;
					$this->kapasitas_modul = $temp_kapasitas_modul;
					$this->jumlah_modul = $temp_jumlah_modul;
					$this->kapasitas_plts = $temp_kapasitas_plts;
					$this->harga_modul = $temp_harga_modul;
					$this->berat_modul  	= $temp_berat_modul;
				}
			}else if($i > 0){
				$arrayIndexOfHighest=$i-1;
				$this->kapasitas_modul = $temp_kapasitas_modul;
				$this->jumlah_modul = $temp_jumlah_modul;
				$this->kapasitas_plts = $temp_kapasitas_plts;
				$this->harga_modul = $temp_harga_modul;
				$this->berat_modul  	= $temp_berat_modul;
				break;
			}
			
			$temp_kapasitas_modul= $ModulCal->_kapasitas_modul;
			$temp_jumlah_modul 	 = $ModulCal->_jumlah_modul;
			$temp_kapasitas_plts = $ModulCal->_kapasitas_plts;
			$temp_harga_modul 	 = $ModulCal->_harga_modul;
			$temp_berat_modul	 = $ModulCal->_berat_modul;
			$i++;
		}
		
		/* menghitung jumlah modul */
		//////////$this->jumlah_modul=ceil($this->kapasitas_inverter*1000/$this->kapasitas_modul);
		/* echo "Jumlah Modul :". $this->jumlah_modul;
		echo "<br>"; */

		/* menghitung kapasitas PLTS */
		/////////$this->kapasitas_plts=$this->kapasitas_modul*$this->jumlah_modul/1000;
		/* echo "Kapasitas PLTS :". $this->kapasitas_plts;
		echo "<br>"; */
		
		/* menghitung biaya modul */
		$this->biaya_modul=$this->harga_modul*$this->jumlah_modul;
		/*echo "jumlah_modul :". $this->jumlah_modul;
		echo "<br>"; */
		
		/* menghitung harga inverter */
		if($this->kapasitas_inverter<=5) {
			$this->harga_inverter=5027;
		}else if ($this->kapasitas_inverter<=10) {
			$this->harga_inverter=4372;
		}else if ($this->kapasitas_inverter<=15) {
			$this->harga_inverter=3210;
		}else {
			$this->harga_inverter=2710;
		}
		/* echo "Harga Inevrter :". $this->harga_inverter;
		echo "<br>"; */

		/* menghitung total berat peralatan sistem */
		

		$this->total_berat_beban_sistem_plts=($this->berat_modul*$this->jumlah_modul)+($this->berat_struktur*$this->kapasitas_plts);
		/*echo $this->berat_modul ." ----> berat_modul <br/>";
		echo $this->jumlah_modul  ." ----> jumlah_modul <br/><br/>";
		echo $this->berat_struktur  ." ----> berat_struktur <br/><br/>";
		echo $this->kapasitas_disain." ----> Kapasitas desain <br/>";

		echo $this->total_berat_beban_sistem_plts ." ----> total_berat_beban_sistem_plts <br/><br/>";*/
		/* echo "Total Berat Peralatan Sistem :". $this->total_berat_beban_sistem_plts;
		echo "<br>"; */

		/* menghitung Perkiraan Produksi Daya Pertahun */
		$this->produksi_plts=($this->kapasitas_modul*$this->jumlah_modul*365*$this->intensitas_radiasi*$this->rasio_kinerja)*$this->faktor_arah_kemiringan/1000;

		/*echo "Perkiraan Produksi Daya Pertahun :". $this->produksi_plts;
		echo "<br>"; */

		/* menghitung biaya inverter */
		$this->biaya_inverter=$this->kapasitas_inverter*$this->harga_inverter*1000;
		/* echo "Biaya Inverter :". $this->biaya_inverter;
		echo "<br>"; */

		/* menghitung biaya struktur */
		$this->biaya_struktur=$this->harga_struktur*$this->kapasitas_plts*1000;
		/* echo "Biaya Struktur :". $this->biaya_struktur;
		echo "<br>"; */

		/* menghitung biaya aksesoris */
		$this->biaya_asesoris=$this->harga_asesoris*$this->kapasitas_plts*1000;;
		/* echo "Biaya Asesoris :". $this->biaya_asesoris;
		echo "<br>"; */

		/*menghitung biaya instalasi */
		$this->biaya_instalasi=$this->harga_instalasi*$this->kapasitas_plts*1000;
		/** echo "Biaya Instalasi :". $this->biaya_instalasi;
		echo "<br>"; */

		/* menghitung biaya investasi */
		$this->biaya_investasi=$this->biaya_modul+$this->biaya_inverter+$this->biaya_struktur+$this->biaya_asesoris+$this->biaya_instalasi;
		/* echo "Biaya Investasi :". $this->biaya_investasi;
		echo "<br>"; */

		/* menghitung Estimasi Pengematan */
		$this->estimasi_penghematan=(($this->self_consumption*$this->tarif_listrik)+(65/100*$this->kwh_ekspor*$this->tarif_listrik))*$this->produksi_plts/12;
		/* echo "Estimasi Penghematan :". $this->estimasi_penghematan;
		echo "<br>"; */

		/* Emisi Karbon (ton CO2) */
		$this->emisi_karbon = ($this->Konstanta_emisi_CO2 * $this->produksi_plts * $this->umur_PLTS) / 1000;
		$this->emisi_karbon = round($this->emisi_karbon,3);
		/*echo $this->Konstanta_emisi_CO2;
		echo "<br>";
		echo $this->produksi_plts;
		echo "<br>";
		$this->emisi_karbon = round($this->emisi_karbon,3);
		echo $this->emisi_karbon;
		echo "<br>";*/

		/* Penanam Pohon  */
		$this->penanaman_pohon = ($this->Konstanta_Pohon * $this->produksi_plts * $this->umur_PLTS);
		$this->penanaman_pohon = ceil($this->penanaman_pohon);
		
		/* BBM Kendaraan Bermotor  */
		$this->bbm_kendaraan_bermotor = ($this->kontanta_BBM * $this->produksi_plts * $this->umur_PLTS);
		$this->bbm_kendaraan_bermotor = round($this->bbm_kendaraan_bermotor,1);

		//Perhitungan data grafik
		$this->Konsumsi_Listrik_PLN = $this->konsumsi_listrik - ($this->self_consumption * $this->produksi_plts / 12);
		$this->Konsumsi_Listrik_PLN  = round($this->Konsumsi_Listrik_PLN ,1);
		/*
		echo "konsumsi_listrik :". $this->konsumsi_listrik;
		echo "<br>"; 
		echo "self_consumption :". $this->self_consumption;
		echo "<br>"; 
		echo "Konsumsi_Listrik_PLN :". $this->Konsumsi_Listrik_PLN;
		echo "<br>"; */


		$this->Total_kWh_Ekspor = $this->kwh_ekspor * $this->produksi_plts / 12;
		$this->Total_kWh_Ekspor = round($this->Total_kWh_Ekspor,1);
		$this->Tagihan_Listrik_PLN = $this->tarif_listrik * ($this->Konsumsi_Listrik_PLN - (0.65 * $this->Total_kWh_Ekspor));
		$this->Tagihan_Listrik_PLN = round($this->Tagihan_Listrik_PLN,0);
		
		$this->Tagihan_TanpaPLTS = $this->tagihan_listrik;
		$this->Tagihan_denganPLTS = $this->Tagihan_Listrik_PLN;



		$new_hasilbalikan = new hasilbalikan();
		$new_hasilbalikan->kapasitas_plts = $this->kapasitas_plts;
		$new_hasilbalikan->kapasitas_modul = $this->kapasitas_modul;
		$new_hasilbalikan->jumlah_modul = $this->jumlah_modul;
		$new_hasilbalikan->kapasitas_inverter = $this->kapasitas_inverter;
		$new_hasilbalikan->total_berat_beban_sistem_plts = $this->total_berat_beban_sistem_plts;
		$new_hasilbalikan->estimasi_produksi = $this->produksi_plts;
		$new_hasilbalikan->total_biaya_investasi = $this->biaya_investasi;
		$new_hasilbalikan->biaya_modul = $this->biaya_modul;
		$new_hasilbalikan->biaya_inverter = $this->biaya_inverter;
		$new_hasilbalikan->biaya_struktur = $this->biaya_struktur;
		$new_hasilbalikan->biaya_asesoris = $this->biaya_asesoris;
		$new_hasilbalikan->biaya_instalasi = $this->biaya_instalasi;
		$new_hasilbalikan->estimasi_penghematan = $this->estimasi_penghematan;
		$new_hasilbalikan->emisi_karbon = $this->emisi_karbon;
		$new_hasilbalikan->penanaman_pohon = $this->penanaman_pohon;
		$new_hasilbalikan->bbm_kendaraan_bermotor = $this->bbm_kendaraan_bermotor;

		$new_hasilbalikan->Konsumsi_Listrik_PLN = $this->Konsumsi_Listrik_PLN;
		$new_hasilbalikan->Total_kWh_Ekspor = $this->Total_kWh_Ekspor;
		$new_hasilbalikan->Tagihan_Listrik_PLN = $this->Tagihan_Listrik_PLN;
		$new_hasilbalikan->Tagihan_TanpaPLTS = $this->Tagihan_TanpaPLTS;
		$new_hasilbalikan->Tagihan_denganPLTS = $this->Tagihan_denganPLTS;
		
		//paramkonstanta
		$new_hasilbalikan->pv_density = $this->pv_density;
		$new_hasilbalikan->akses_rasio = $this->akses_rasio;
		$new_hasilbalikan->safety_factor = $this->safety_factor;
		$new_hasilbalikan->DCAC_ratio = $this->DCAC_ratio;
		$new_hasilbalikan->rasio_kinerja = $this->rasio_kinerja;
		$new_hasilbalikan->self_consumption = $this->self_consumption;
		$new_hasilbalikan->kwh_ekspor = $this->kwh_ekspor;
		$new_hasilbalikan->faktor_arah_kemiringan = $this->faktor_arah_kemiringan;
		$new_hasilbalikan->Konstanta_emisi_CO2 = $this->Konstanta_emisi_CO2;
		$new_hasilbalikan->Konstanta_Pohon = $this->Konstanta_Pohon;
		$new_hasilbalikan->kontanta_BBM = $this->kontanta_BBM;
		$new_hasilbalikan->umur_PLTS = $this->umur_PLTS;
		$new_hasilbalikan->tarif_listrik = $this->tarif_listrik;
		$new_hasilbalikan->potensi_plts = round($this->potensi_plts,1);

		return json_encode($new_hasilbalikan);
	}
}

$new_coba = new coba();

if (isset($_GET['luas_area'])) {
	$new_coba->initial();
	echo $new_coba->calculate();
}

?>