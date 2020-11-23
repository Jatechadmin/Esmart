<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Models\HomeModel;

class HomeController extends Controller
{
    public function calc2(Request $tempReq)
    {
        $test = $tempReq->input('Biaya_Investasi_');
        $tModalFinansial = "";
        $tPinjaman = "";
        $tBungaPinjaman = "";
        $tBungaDiskon = "";
        $tUmurPLTS = "";
        $tLamaPinjam = "";
        $kapasitas_plts = "";
        $Biaya_Investasi_ = "";
        $Biaya_inverter_ = "";
        $Estimasi_Penghematan_ = "";
        $Operasional = "";
        $Depresiasi_modul = "";
        $Produksi_PLTS = "";
        $tarif = "";
        $tarif_all = "";
        $irrProject = "";
        $irrEquity = "";
        $npv = "";
        $waktu_pengembalian = "";
        $Revenue_Electricity = "";
        $OPEX_Maintanance = "";
        $OPEX_Penggantian = "";
        $OPEX_Total = "";
        $EbITDA = "";
        $Depreciation = "";
        $EbIT_1 = "";
        $Interest = "";
        $Redemption = "";
        $Outstanding_Debt = "";
        $Debt_Service = "";
        $EbT_2 = "";
        $Taxes = "";
        $Cash_Flow = "";
        $Accumulated_Cash_Flow = "";
        $ROE = "";
        $Net_profit = "";
        $Accumulated_Net_profit = "";
        $self_consumption = "";
        $kwh_ekspor = "";

        if (isset($_GET['Produksi_PLTS'])) {
            initial2();
            calculate_simulasi();
        }
    }

    public function initial2(){
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
                /*echo "Param1 : ". $this->self_consumption;
                echo "<br />";
                echo "Param2&4 : ". $list_Produksi_PLTS[$i];
                echo "<br />";
                echo "Param3 : ". $this->kwh_ekspor;
                echo "<br />";
                echo "Param5 : ". $list_tarif_all[$i];
                echo "<br />";
                $test1 = ($this->self_consumption * $list_Produksi_PLTS[$i]);
                $test2 = (0.65 * $this->kwh_ekspor * $list_Produksi_PLTS[$i]);
                $test3 = ($test1 + $test2) * $list_tarif_all[$i];*/
                /*echo "Perkalian awal : ". $test1;
                echo "<br />";
                echo "Perkalian Kedua : ". $test2;
                echo "<br />";
                echo "Penjumlahan  dari perkalian awal dan kedua dan dikalikan: ". $test3;
                echo "<br />";
                echo "<br />";
                echo "Hasil E : ". $this->Revenue_Electricity;
                echo "<br />";*/
                
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
                //echo "EbITDA : ". $this->EbITDA;
                //echo "<br />";
                
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

        /*echo "tBungaDiskon : ". $this->tBungaDiskon;
        echo "<br />";
        $hasilNPV = ($TotalDcf1 / ($TotalDcf1 - $TotalDcf2));
        $hasilNPV = round($hasilNPV,2);
        echo "NPV1 / NPV1-NPV2 : ". $hasilNPV;
        echo "<br />";
        $hasilDikson12 = ($this->tBungaPinjaman - $this->tBungaDiskon);
        $hasilDikson12 = round($hasilDikson12,2);
        echo "Pengurangan i2 - i1 : ". $hasilDikson12;
        echo "<br />";
        $Hasilakhir1 = $hasilNPV * $hasilDikson12;
        $Hasilakhir1 = round($Hasilakhir1,2);
        echo "Perkalian NPV dengan Diskon : ". $Hasilakhir1;
        echo "<br />";
        $Hasilakhir_ = $this->tBungaDiskon + $Hasilakhir1;
        echo "Hasilnya : ". $Hasilakhir_;
        echo "<br />";*/

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

    public function calc(Request $tempReq2){
        $test = $tempReq2->input('luas_area');
        //echo json_encode($tempReq2->all());
        echo $test;
        die;
        $titik_kordinat;
        $luas_area;
        $luas_grid;
        $jumlah_grid;
        $daya_terpasang_pln;
        $tarif_listrik; /*dari database */
        $tagihan_listrik;
        $tahun;
        $bulan_tagihan;
        $jumlah_hari; /*cari yang auto */
        $konsumsi_listrik;
        $jenis_atap; /* user pmemilih */
        $kemiringan; /* otomatis setelah user memilih */ 
        $arah_atap;/* Jika Jenis Atap = dak beton, maka otomatis nilai arah = Utara. Selain itu, user pilih manual.  */
        $sudut_azimut = 0; /* Sesuai nilai Arah Atap (memanggil db_SudutAzimut) */
        $latLocation = 7.0135;
        $longLocation = 46.9587;
        $pv_density;
        $akses_rasio;
        $safety_factor;
        $DCAC_ratio;
        $rasio_kinerja;
        $self_consumption;
        $kwh_ekspor;
        $Konstanta_emisi_CO2;
        $Konstanta_Pohon;
        $kontanta_BBM;
        $umur_PLTS;
        $faktor_arah_kemiringan; /* Memanggil simulasi perhitungan Faktor Arah Kemiringan (on progress) */
        $intensitas_radiasi; /* db_radiasi (API web meteonorm), rumus : Total data1tahun  PV (kWh/kWp)/365 */
        $luas_aktif;
        $potensi_plts;
        $kebutuhan_plts;
        $kapasitas_disain;
        $kapasitas_inverter;
        $kapasitas_modul; /* memanggil hasil simulasi modul */
        $jumlah_modul;
        $kapasitas_plts;
        $berat_modul;/* Memanggi db_modul sesuai hasil simulasi modul yang terpilih */
        $berat_struktur; /* memanggil db_StrukturMounting */
        $harga_modul; /* Memanggi db_modul sesuai hasil simulasi modul yang terpilih */
        $harga_inverter;
        $harga_struktur; /* Memanggil db_StrukturMounting */
        $harga_asesoris;
        $harga_instalasi;
        $total_berat_beban_sistem_plts;
        $produksi_plts;
        $biaya_investasi;
        $biaya_modul;
        $biaya_inverter;
        $biaya_struktur;
        $biaya_asesoris;
        $biaya_instalasi;
        $estimasi_penghematan;
        $npv;
        $irr;
        $waktu_pengembalian;
        $emisi_karbon;
        $penanaman_pohon;
        $bbm_kendaraan_bermotor;
        $tipe_bangunan;
        $posisi_pemasangan;
        $Konsumsi_Listrik_PLN;
        $Total_kWh_Ekspor;
        $Tagihan_Listrik_PLN;
        $Tagihan_TanpaPLTS;
        $Tagihan_denganPLTS;

        //if (isset($_GET['luas_area'])) {
          //  initial();
          //  calculate();
        //}
    }

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
		$username = "root";
		$password = "";
		$dbname = "esp";

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
