<?php
class hasilbalikan{
	
    public $irrProject;
    public $irrEquity;
    public $npv;
    public $waktu_pengembalian;
    

}

class simulasi
{
	private $tModalFinansial;
	private $tPinjaman;
	private $tBungaPinjaman;
	private $tBungaDiskon;
	private $tUmurPLTS;
	private $tLamaPinjam;
	private $kapasitas_plts;
	private $Biaya_Investasi_;
    private $Biaya_inverter_;
    private $Estimasi_Penghematan_;
    private $Operasional;
    private $Depresiasi_modul;
    private $Produksi_PLTS;
    private $tarif;
    private $tarif_all;
    private $irrProject;
    private $irrEquity;
    private $npv;
    private $waktu_pengembalian;
    private $Revenue_Electricity;
    private $OPEX_Maintanance;
	private $OPEX_Penggantian;
	private $OPEX_Total;
	private $EbITDA;
	private $Depreciation;
	private $EbIT_1;
	private $Interest;
	private $Redemption;
	private $Outstanding_Debt;
	private $Debt_Service;
	private $EbT_2;
	private $Taxes;
	private $Cash_Flow;
	private $Accumulated_Cash_Flow;	
	private $ROE;
	private $Net_profit;
	private $Accumulated_Net_profit;
	private $self_consumption;
	private $kwh_ekspor;

	public function initial(){
		$this->kapasitas_plts = $_GET['Produksi_PLTS'];
		$this->Biaya_Investasi_ = $_GET['Biaya_Investasi_'];
	    $this->Biaya_inverter_ = $_GET['Biaya_inverter_'];
	    $this->Estimasi_Penghematan_ = $_GET['Estimasi_Penghematan_'];
	    $this->Operasional = $_GET['Operasional'];
	    $this->Depresiasi_modul = $_GET['Depresiasi_modul'];
	    $this->tModalFinansial = $_GET['tModalFinansial'];
		$this->tPinjaman = $_GET['tPinjaman'];
		$this->tBungaPinjaman = $_GET['tBungaPinjaman'];
		$this->tBungaDiskon = $_GET['tBungaDiskon'];
		$this->tUmurPLTS = $_GET['tUmurPLTS'];
		$this->tLamaPinjam = $_GET['tLamaPinjam'];
	    $this->tarif = $_GET['tarif'];
	    $this->self_consumption = $_GET['self_consumption'];
		$this->kwh_ekspor = $_GET['kwh_ekspor'];

    	$this->tarif_all;
	    $this->Produksi_PLTS;
	    $this->irrProject;
	    $this->irrEquity;
	    $this->npv;
	    $this->waktu_pengembalian;
	    $this->Revenue_Electricity;
	    $this->OPEX_Maintanance;
		$this->OPEX_Penggantian;
		$this->OPEX_Total;
		$this->EbITDA;
		$this->Depreciation;
		$this->EbIT_1;
		$this->Interest;
		$this->Redemption;
		$this->Outstanding_Debt;
		$this->Debt_Service;
		$this->EbT_2;
		$this->Taxes;
		$this->Cash_Flow;
		$this->Accumulated_Cash_Flow;	
		$this->ROE;
		$this->Net_profit;
		$this->Accumulated_Net_profit;

	}
	
	public function calculate_simulasi(){

		$tUmurPLTS = $this->tUmurPLTS;
		$list_Produksi_PLTS = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				array_push($list_Produksi_PLTS,"0");
			}
			else if($i == '1')
			{
				$this->Produksi_PLTS = $this->kapasitas_plts;
				array_push($list_Produksi_PLTS,$this->Produksi_PLTS);
			}
			else 
			{
				$this->Produksi_PLTS = (1-$this->Depresiasi_modul) * $this->Produksi_PLTS;
				$this->Produksi_PLTS = round($this->Produksi_PLTS);
				array_push($list_Produksi_PLTS,$this->Produksi_PLTS);
			}
		}

		$list_tarif_all = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				array_push($list_tarif_all,"0");
			}
			else if($i == '1')
			{
				$this->tarif_all = $this->tarif;
				array_push($list_tarif_all,$this->tarif_all);
			}
			else 
			{
				$EskalasiTarif = '0.02';
				$this->tarif_all = (1+$EskalasiTarif) * $this->tarif_all;
				$this->tarif_all = round($this->tarif_all);
				array_push($list_tarif_all,$this->tarif_all);
			}
		}

		$list_Revenue_Electricity = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				array_push($list_Revenue_Electricity,"0");
			}
			else if($i == '1')
			{
				$this->Revenue_Electricity = (($this->self_consumption * $list_Produksi_PLTS[$i]) + (0.65 * $this->kwh_ekspor * $list_Produksi_PLTS[$i])) * $list_tarif_all[$i];
				$this->Revenue_Electricity = round($this->Revenue_Electricity);
				array_push($list_Revenue_Electricity,$this->Revenue_Electricity);
				
			}
			else 
			{
				$this->Revenue_Electricity = (($this->self_consumption * $list_Produksi_PLTS[$i]) + (0.65 * $this->kwh_ekspor * $list_Produksi_PLTS[$i])) * $list_tarif_all[$i];
				$this->Revenue_Electricity = round($this->Revenue_Electricity);
				array_push($list_Revenue_Electricity,$this->Revenue_Electricity);
				
			}
		}

		$list_OPEX_Maintanance = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				array_push($list_OPEX_Maintanance,"0");
			}
			else if($i == '1')
			{
				$this->OPEX_Maintanance = $this->Operasional * $this->Biaya_Investasi_;
				$this->OPEX_Maintanance = round($this->OPEX_Maintanance);
				array_push($list_OPEX_Maintanance,$this->OPEX_Maintanance);
			}
			else 
			{
				$this->OPEX_Maintanance = $this->OPEX_Maintanance;
				array_push($list_OPEX_Maintanance,$this->OPEX_Maintanance);
			}
		}

		$list_OPEX_Penggantian = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				array_push($list_OPEX_Penggantian,"0");
			}
			else if($i == '1')
			{
				$this->OPEX_Penggantian = 0;
				array_push($list_OPEX_Penggantian,$this->OPEX_Penggantian);
				//echo "Hasil G : ". $this->OPEX_Penggantian;
				//echo "<br />";
			}
			else if($i == '11')
			{
				$this->OPEX_Penggantian_tahun = $this->Biaya_inverter_;
				array_push($list_OPEX_Penggantian,$this->OPEX_Penggantian_tahun);
				//echo "Hasil G : ". $this->OPEX_Penggantian_tahun;
				//echo "<br />";
			}
			else 
			{
				$this->OPEX_Penggantian = $this->OPEX_Penggantian;
				array_push($list_OPEX_Penggantian,$this->OPEX_Penggantian);
				//echo "Hasil G : ". $this->OPEX_Penggantian;
				//echo "<br />";
			}
		}

		$list_OPEX_Total = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				array_push($list_OPEX_Total,"0");
			}
			else
			{
				$this->OPEX_Total = $list_OPEX_Maintanance[$i] + $list_OPEX_Penggantian[$i];;
				$this->OPEX_Total = round($this->OPEX_Total,0);
				array_push($list_OPEX_Total,$this->OPEX_Total);
			}
		}

		$list_EbITDA = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				$default_EbITDA = -($this->Biaya_Investasi_);
				array_push($list_EbITDA,$default_EbITDA);
				
			}
			else
			{
				$this->EbITDA = $list_Revenue_Electricity[$i] - $list_OPEX_Total[$i];
				array_push($list_EbITDA,$this->EbITDA);
				
			}
		}

		$list_Depreciation = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				array_push($list_Depreciation,"0");
			}
			else 
			{
				$this->Depreciation = $this->Biaya_Investasi_ / $this->tUmurPLTS;
				$this->Depreciation = round($this->Depreciation,0);
				array_push($list_Depreciation,$this->Depreciation);
			}
		}

		$list_EbIT_1 = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				array_push($list_EbIT_1,"0");
			}
			else
			{
				$this->EbIT_1 = $list_EbITDA[$i] - $list_Depreciation[$i];
				array_push($list_EbIT_1,$this->EbIT_1);
			}
		}

		$DefaultOutstanding_Debt = $this->tPinjaman * $this->Biaya_Investasi_;
		$list_Redemption = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				array_push($list_Redemption,"0");
			}
			else
			{
				if($i <= $this->tLamaPinjam)
				{
					$this->Redemption = $DefaultOutstanding_Debt / $this->tLamaPinjam;
				}
				else
				{
					$this->Redemption = "0";
				}
				array_push($list_Redemption,$this->Redemption);
			}
		}

		$list_Outstanding_Debt = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				array_push($list_Outstanding_Debt,$DefaultOutstanding_Debt);
			}
			else
			{
				$x = $i-1;
				//echo $list_Redemption[$i];
				$this->Outstanding_Debt = $list_Outstanding_Debt[$x] - $list_Redemption[$i];
				array_push($list_Outstanding_Debt,$this->Outstanding_Debt);
			}
		}

		$list_Interest = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				array_push($list_Interest,"0");
			}
			else
			{
				$x = $i-1;
				$this->Interest = $this->tBungaPinjaman * $list_Outstanding_Debt[$x];
				array_push($list_Interest,$this->Interest);
			}
		}

		$list_Debt_Service = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				array_push($list_Debt_Service,"0");
			}
			else
			{
				$this->Debt_Service = $list_Interest[$i] + $list_Redemption[$i] ;
				array_push($list_Debt_Service,$this->Debt_Service);
			}
		}

		$list_EbIT_2 = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				array_push($list_EbIT_2,"0");
			}
			else
			{
				$this->EbIT_2 = $list_EbIT_1[$i] - $list_Interest[$i];
				array_push($list_EbIT_2,$this->EbIT_2);
			}
		}

		$list_Taxes = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				array_push($list_Taxes,"0");
			}
			else
			{
				$pajak = 0;
				$this->Taxes = max(0,$pajak * $list_EbIT_2[$i]);
				array_push($list_Taxes,$this->Taxes);
			}
		}

		$DafultCash_Flow = -($this->tModalFinansial * $this->Biaya_Investasi_);
		$list_Cash_Flow = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				
				array_push($list_Cash_Flow,$DafultCash_Flow);
			}
			else
			{
				$this->Cash_Flow = $list_EbIT_2[$i] - $list_Taxes[$i] - $list_Redemption[$i] + $list_Depreciation[$i];
				array_push($list_Cash_Flow,$this->Cash_Flow);
			}
		}

		$DefaultAccumulated_Cash_Flow = $DafultCash_Flow;
		$list_Accumulated_Cash_Flow = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				
				array_push($list_Accumulated_Cash_Flow,$DefaultAccumulated_Cash_Flow);
			}
			else
			{
				$x = $i-1;
				$this->Accumulated_Cash_Flow = $list_Accumulated_Cash_Flow[$x] + $list_Cash_Flow[$i];
				array_push($list_Accumulated_Cash_Flow,$this->Accumulated_Cash_Flow);
				
			}
		}

		$list_Net_profit = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				array_push($list_Net_profit,"0");
			}
			else
			{
				$this->Net_profit = $list_EbIT_2[$i] - $list_Taxes[$i];
				array_push($list_Net_profit,$this->Net_profit);
			}
		}

		$list_Accumulated_Net_profit = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				array_push($list_Accumulated_Net_profit,"0");
			}
			else
			{
				$x = $i-1;
				$this->Accumulated_Net_profit = $list_Accumulated_Net_profit[$x] + $list_Net_profit[$i];
				array_push($list_Accumulated_Net_profit,$this->Accumulated_Net_profit);
				
			}
		}

		//Perhitungan IRR EQUITY =================================================================
		$listDCF1 = array();
		$listDCF2 = array();
		$TotalDcf1 = 0;
		$TotalDcf2 = 0;
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				array_push($listDCF1,$DafultCash_Flow);
				array_push($listDCF2,$DafultCash_Flow);
			}
			else
			{

				$PV1 = pow((1 + $this->tBungaDiskon),$i);
				$PV2 = pow((1 + $this->tBungaPinjaman),$i);

				$dcf1_ = $list_Cash_Flow[$i] / $PV1;
				$dcf1 = round($dcf1_,0);
				array_push($listDCF1,$dcf1);


				$dcf2_ = $list_Cash_Flow[$i] / $PV2;
				$dcf2 = round($dcf2_,0);
				array_push($listDCF2,$dcf2);
			}
		}

		foreach($listDCF1 as $items_listDCF1)
		{
			$TotalDcf1 = $TotalDcf1 + $items_listDCF1;
		}
		//echo "Hasil Total DCF1 : ". $TotalDcf1;
		//echo "<br />";


		foreach($listDCF2 as $items_listDCF2)
		{
			$TotalDcf2 = $TotalDcf2 + $items_listDCF2;
		}
		//echo "Hasil Total DCF2 : ". $TotalDcf2;
		//echo "<br />";
		//hasil IRR EQUITY
		$irrHasil = $this->tBungaDiskon + (($TotalDcf1 / ($TotalDcf1 - $TotalDcf2)) * ($this->tBungaPinjaman - $this->tBungaDiskon));
		$irrHasil  = round(($irrHasil * 100),2);
		//echo "Hasil IRR EQUITY : ". $irrHasil;
		//echo "<br />";

		//Perhitungan IRR EQUITY =================================================================
		

		//Perhitungan NPV =================================================================
		$list_NPV = array();
		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				array_push($list_NPV,$DafultCash_Flow);
			}
			else
			{

				$PV = pow((1 + $this->tBungaDiskon),$i);
				$npvperhitungan_ = $list_Cash_Flow[$i] / $PV;
				$npvperhitungan = round($npvperhitungan_,0);
				array_push($list_NPV,$npvperhitungan);
			}
		}
		//hasil NPV
		$HasilNPV = 0;
		foreach($list_NPV as $items_NPV)
		{
			$HasilNPV = $HasilNPV + $items_NPV;
		}
		//Perhitungan NPV =================================================================

		//Perhitungan IRR Project =================================================================
		$listDCF1_Project = array();
		$listDCF2_Project = array();
		$TotalDcf1_Project = 0;
		$TotalDcf2_Project = 0;

		for($i=0;$i<=$tUmurPLTS;$i++)
		{
			if($i == '0')
			{
				$default_EbITDA = -($this->Biaya_Investasi_);
				array_push($listDCF1_Project,$default_EbITDA);
				array_push($listDCF2_Project,$default_EbITDA);
			}
			else
			{

				$PV1 = pow((1 + $this->tBungaDiskon),$i);
				$PV2 = pow((1 + $this->tBungaPinjaman),$i);

				$dcf1_Project_ = $list_EbITDA[$i] / $PV1;
				$dcf1_Project = round($dcf1_Project_,0);
				array_push($listDCF1_Project,$dcf1_Project);


				$dcf2_Project_ = $list_EbITDA[$i] / $PV2;
				$dcf2_Project = round($dcf2_Project_,0);
				array_push($listDCF2_Project,$dcf2_Project);

				//echo "Hasil 1 : ". $dcf1;
				//echo "<br />";
				//echo "Hasil 2 : ". $dcf2;
				//echo "<br />";
			}
		}

		foreach($listDCF1_Project as $items_listDCF1_Project)
		{
			$TotalDcf1_Project = $TotalDcf1_Project + $items_listDCF1_Project;
		}

		foreach($listDCF2_Project as $items_listDCF2_Project)
		{
			$TotalDcf2_Project = $TotalDcf2_Project + $items_listDCF2_Project;
		}

		//Hasil IRR Project
		$irrHasil_Project_= $this->tBungaDiskon + (($TotalDcf1_Project / ($TotalDcf1_Project - $TotalDcf2_Project)) * ($this->tBungaPinjaman - $this->tBungaDiskon));

		$irrHasil_Project = round(($irrHasil_Project_ * 100),2);//round($irrHasil_Project_,4) * 100;
		//echo "Hasil IRR Project : ". $irrHasil_Project;
		//echo "<br />";

		//Perhitungan IRR Project =================================================================

		$waktuPengebalian = '';

		$Count_Accumulated_Cash_Flow = 0;
		$counts = 0;
		foreach($list_Accumulated_Cash_Flow as $items_Accumulated_Cash_Flow)
		{
			if($counts == '0')
			{

			}
			else
			{
				if($items_Accumulated_Cash_Flow < 0)
				{
					$Count_Accumulated_Cash_Flow++;
				}
			}
			$counts++;
		}

		$value_Accumulated_Cash_Flow = abs($list_Accumulated_Cash_Flow[$Count_Accumulated_Cash_Flow]);

		$Count_cashFlow = $Count_Accumulated_Cash_Flow + 1;
		$value_Cash_Flow = abs($list_Cash_Flow[$Count_cashFlow]);

		$waktuPengebalian = $Count_Accumulated_Cash_Flow + ($value_Accumulated_Cash_Flow / $value_Cash_Flow);
		$waktuPengebalian = round($waktuPengebalian,1);

		//Nilai Balikan JSON
		$new_hasilbalikan = new hasilbalikan();
		$new_hasilbalikan->irrProject = $irrHasil_Project;
		$new_hasilbalikan->irrEquity = $irrHasil;
		$new_hasilbalikan->npv = $HasilNPV;
		$new_hasilbalikan->waktu_pengembalian = $waktuPengebalian;

		return json_encode($new_hasilbalikan);
	}
}

$new_simulasi = new simulasi();

if (isset($_GET['Produksi_PLTS'])) {
	$new_simulasi->initial();
	echo $new_simulasi->calculate_simulasi();
}

?>