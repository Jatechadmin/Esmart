<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>ESDM | E-SMART - PHOTO PHOTOVOLTAIC</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- favicon
	============================================ -->
  <link rel="shortcut icon" type="image/x-icon" href="public/img/esdm.png">
    
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="public/css/bootstrap/bootstrap.min.css" />

  <!-- Fontawesome CSS -->
  <link rel="stylesheet" href="public/css/fontawesome/all.min.css" />

  <!-- Chart CSS -->
  <link rel="stylesheet" href="public/css/Chart.min.css" />


  <link rel="stylesheet" href="public/css/introjs.min.css" />
  <link rel="stylesheet" href="public/css/introjs-modern.css" />

  <!-- style CSS
    ============================================ -->
  <link rel="stylesheet/less" type="text/css" href="public/css/style.less" />

  <style type="text/css">
    /* Center the loader */

      #loader {

      position: absolute;
      left: 50%;
      top: 50%;
      z-index: 1;
      width: 150px;
      height: 150px;
      margin: -75px 0 0 -75px;
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #3498db;
      width: 120px;
      height: 120px;
      -webkit-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;
      }

      @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
      }

      @keyframes  spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
      }
      /* Add animation to "page content" */

      .animate-bottom {
      position: relative;
      -webkit-animation-name: animatebottom;
      -webkit-animation-duration: 1s;
      animation-name: animatebottom;
      animation-duration: 1s
      }

      @-webkit-keyframes animatebottom {
      from { bottom:-100px; opacity:0 }
      to { bottom:0px; opacity:1 }
      }

      @keyframes  animatebottom {
      from{ bottom:-100px; opacity:0 }
      to{ bottom:0; opacity:1 }
      }

      #myDiv {
      display: none;
      }
  </style>

<body>
<div style="display:none;" id="loader"></div>
<div style="display:none;" id="divLoading" class="animate-bottom"></div>

  <!-- Start Header Top Area -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="/">
        <img src="public/img/esmart.png" alt="app_icon" width="auto" height="40" loading="lazy" />
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto"></ul>
        <ul class="navbar-nav justify-content-end">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Jaringan Kami
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Web P3TEK</a>
              <a class="dropdown-item" href="#">Balitbang</a>
              <a class="dropdown-item" href="#">ESDM</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="main-menu">
            <div class="container">
                <ul class="nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link active" href="/home" id="menuDropdown" role="button" 
                        aria-haspopup="true" aria-expanded="false"><i class="fas fa-map-marker-alt"></i> Tentukan Lokasi</a>
                        <!-- <div class="dropdown-menu" aria-labelledby="menuDropdown">
                            <a class="dropdown-item" href="index.html">Cari Lokasi</a>
                            <a class="dropdown-item" href="#">Gambar Posisi</a>
                            </div> -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/artikel"><i class="fas fa-solar-panel"></i> Tentang PLTS
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/regulasi">
                            <i class="fas fa-book"></i> Regulasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/kontak">
                            <i class="fas fa-address-card"></i> Kontak Kami
                        </a>
                    </li>
                </ul>
            </div>
        </div>
  <!-- End Header Top Area -->

  <div style="position: relative; min-height: 200px;" id="card-Maps">
    <div class="toast" data-delay="3000" style="
          position: fixed;
          top: 0;
          right: 0;
          margin-right: 20px;
          margin-top: 20px;
          z-index: 2;
          width: 300px;
        ">
      <div class="toast-header">
        <strong class="mr-auto">Peringatan!</strong>
        <small></small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body">
        <p id="toast-message">Hello, world! This is a toast message.</p>
      </div>
    </div>

    <!-- Start Sale Statistic area-->
    <div class="sale-statistic-area">
      <div class="sale-statistic-inner">
        
        <div id="map"></div>
        <div id="mapDiv" class="maps"></div>
        <div id="infowindow-content" style="display: none;">
          <img src="" width="16" height="16" id="place-icon" />
          <span id="place-name" class="title"></span><br />
          <span id="place-address"></span>
        </div>
      </div>

      <div class="search-bar">
        <div class="container shadow-sm p-3 mb-5 rounded">
          <div class="row">
            <div class="col-md-4">
              <div class="badge badge-light">1</div>
              Zoom peta pada lokasi yang akan diukur
            </div>
            <div class="col-md-3">
              <div class="badge badge-light">2</div>
              Cari Lokasi yang akan diukur
            </div>
            <div class="col-md-5" style="padding-left: 0px !important">
              <div class="col-lg-12" style="padding-left: 0px !important">
                <div class="form-inline justify-content-end">
                    <div class="col-md-8" style="padding-right: 0px !important">
                      <div class="form-group mx-sm-2" style="padding-left: 0px !important;padding-right: 0px !important">
                          <input id="pac-input" type="text" class="form-control" placeholder="Temukan Lokasi" style="width: 100%" />
                      </div>
                    </div>
                    <div class="col-md-2" style="padding-left: 5px !important;padding-right: 0px !important">
                      <button  type="submit" class="btn btn-success" id="searchmap" style="width: 100%">
                        Cari
                      </button>
                    </div>
                    <div class="col-md-2" style="padding-left: 5px !important;padding-right: 0px !important">
                      <button  type="button" class="btn btn-success" onclick="removeLineSegment()" id="btnhapus" style="width: 100%">
                        Hapus
                      </button>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="card-guest" class="container p-0">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">Buku Tamu</h3>
        <h6 class="card-subtitle mb-2 text-muted">
          Harap isi buku tamu untuk melanjutkan proses kalkulasi
        </h6>

        <form>
          <table class="table table-borderless table-striped">
            <tbody>
              <tr>
                <th scope="row">Nama *</th>
                <td>
                  <div class="input-group input-group-sm">
                    <input type="text" id="txtNama" class="form-control" placeholder="Nama Anda" />
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Pekerjaan *</th>
                <td>
                  <div class="input-group input-group-sm">
                    <input type="text" id="txtJob" class="form-control" placeholder="Pekerjaan Anda" />
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Instansi *</th>
                <td>
                  <div class="input-group input-group-sm">
                    <input type="text" id="txtInstance" class="form-control" placeholder="Instansi Anda" />
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>

  <br />

  <div id="card-input" class="container p-0">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">Keterangan Teknis</h3>
        <h6 class="card-subtitle mb-2 text-muted">
          Tambahkan informasi mengenai rencana lokasi PLTS Anda
        </h6>
        <table class="table table-borderless table-striped">
          <tbody class="tableBody">
            <tr>
              <th scope="row">Luas Area Tersedia</th>
              <td>
                <em>Luas area yang tersedia (m2)</em>
              </td>
              <td>
                <div class="input-group input-group-sm">
                  <input id="txtAreaSize" type="text" class="form-control" placeholder="Luas area tersedia" />
                  <div class="input-group-append">
                    <span class="input-group-text">m2</span>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">Tipe Bangunan</th>
              <td>
                <em>Rumah Tangga, Bisnis, Industri, Pemerintah, Sosial</em>
              </td>
              <td>
                <div class="input-group input-group-sm">
                  <select class="custom-select" data-live-search="true" id="ddBuildingType">
                    <option selected>Pilih tipe bangunan</option>
                    <option>Rumah Tangga</option>
                    <option>Bisnis</option>
                    <option>Industri</option>
                    <option>Pemerintah</option>
                    <option>Sosial</option>
                  </select>
                </div>
              </td>
            </tr>
            <tr style="display: none">
              <th scope="row">Posisi Pemasangan</th>
              <td>
                <em>Atap, Tanah, Terapung</em>
              </td>
              <td>
                <div class="input-group input-group-sm">
                  <select class="custom-select" data-live-search="true" id="ddPosition" onchange='CheckPosition(this.value);'>
                    <option selected>Pilih posisi pemasangan</option>
                    <option>Atap</option>
                    <option>Tanah</option>
                    <option>Terapung</option>
                  </select>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">Daya Terpasang PLN</th>
              <td>
                <em>1300, 2200, 3500, 5500, 6600 VA</em>
              </td>
              <td>
                <div class="input-group input-group-sm">
                  <select class="custom-select" data-live-search="true" id="ddPower" onchange='CheckPower(this.value);'>
                    <option selected>Pilih daya</option>
                    <option>1300</option>
                    <option>2200</option>
                    <option>3500</option>
                    <option>5500</option>
                    <option>6600</option>
                    <option>Lainnya</option>
                  </select>
                  <input type="text" id="txtPowerOther" class="form-control" placeholder="Lainnya"
                    style="display:none;" />
                  <div class="input-group-append">
                    <label class="input-group-text">VA</label>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">Tagihan Listrik Perbulan</th>
              <td>
                <!--<em>Tagihan bulanan rata-rata dalam Rupiah</em>-->
                <div class="input-group input-group-sm">
                  <select class="custom-select" data-live-search="true" id="ddTagihanRatarata">
                    <option selected>Bulan Tagihan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                  </select>
                </div>
              </td>
              <td>
                <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                  </div>
                  <input type="text" id="txtElectricCharge" class="form-control"
                    placeholder="Tagihan listrik perbulan" />
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">Jenis Atap</th>
              <td>
                <em>Genteng keramik, metal sheet, dak beton, lainnya</em>
              </td>
              <td>
                <div class="input-group input-group-sm">
                  <select class="custom-select" data-live-search="true" id="ddJenisAtap" onchange='CheckAtap(this.value);'>
                    <option selected>Pilih atap</option>
                    <option>Genteng keramik</option>
                    <option>Metal Sheet</option>
                    <option>Dak Beton</option>
                    <option>Lainnya</option>
                  </select>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">Arah Atap</th>
              <td>
                <em>Utara, Timur, Selatan, Barat</em>
              </td>
              <td>
                <div class="input-group input-group-sm">
                  <select class="custom-select" data-live-search="true" id="ddArahAtap" > <!-- onchange='ChecArahAtap(this.value);' -->
                    <option selected>Pilih arah atap</option>
                    <option>Utara</option>
                    <option>Timur</option>
                    <option>Selatan</option>
                    <option>Barat</option>
                    <option>Timur Laut</option>
                    <option>Tenggara</option>
                    <option>Barat Daya</option>
                    <option>Barat Laut</option>
                  </select>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">Kemiringan Atap</th>
              <td>
                <em>Sudut kemiringan atap terhadap permukaan</em>
              </td>
              <td>
                <div class="input-group input-group-sm">
                  <input type="text" id="txtRoofTiltDegree" class="form-control" placeholder="Sudut kemiringan atap" />
                  <div class="input-group-append">
                    <span class="input-group-text">Derajat</span>
                  </div>
                </div>
              </td>
            </tr>
            
          </tbody>
        </table>
        <button id="btnCalculate" class="btn btn-success float-right">
          Hitung
        </button>
      </div>
    </div>
  </div>

  <div id="card-result" class="container p-0" style="display: none;">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">Hasil Kalkulasi</h3>
        <h6 class="card-subtitle mb-2 text-muted">
          Berikut adalah hasil kalkulasi Kami
        </h6>
          <table class="table table-borderless table-striped">
            <tbody class="tableBody">
              <tr>
                <th scope="row">Kapasitas PLTS</th>
                <td>
                  <em>Kapasitas sistem PLTS yang dapat dipasang</em>
                </td>
                <td>
                  <div class="input-group input-group-sm">
                    <input type="text" id="txtPLTSCapacity" class="form-control" placeholder="Kapasitas PLTS" readonly />
                    <div class="input-group-append">
                      <span class="input-group-text">kWp</span>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Kapasitas Modul</th>
                <td>
                  <em>Kapasitas modul yang dapat dipasang</em>
                </td>
                <td>
                  <div class="input-group input-group-sm">
                    <input type="text" id="txtModulCapacity" class="form-control" placeholder="Kapasitas modul" readonly />
                    <div class="input-group-append">
                      <span class="input-group-text">Wp</span>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Jumlah Modul</th>
                <td>
                  <em>Jumlah unit modul yang dapat dipasang</em>
                </td>
                <td>
                  <div class="input-group input-group-sm">
                    <input type="text" id="txtModulQuantity" class="form-control" placeholder="Jumlah unit modul" readonly/>
                    <div class="input-group-append">
                      <span class="input-group-text">Unit</span>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Kapasitas Inverter</th>
                <td>
                  <em>Kapasitas daya inverter</em>
                </td>
                <td>
                  <div class="input-group input-group-sm">
                    <input type="text" id="txtInverterCapacity" class="form-control"
                      placeholder="Kapasitas daya inverter" readonly />
                    <div class="input-group-append">
                      <span class="input-group-text">kW</span>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Total Berat Beban PLTS</th>
                <td>
                  <em>Total berat peralatan sistem</em>
                </td>
                <td>
                  <div class="input-group input-group-sm">
                    <input type="text" id="txtSystemWeight" class="form-control"
                      placeholder="Kapasitas daya inverter" readonly />
                    <div class="input-group-append">
                      <span class="input-group-text">Kg</span>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Estimasi Produksi PLTS (kWh/Tahun)</th>
                <td>
                  <em>Perkiraan produksi daya pertahun</em>
                </td>
                <td>
                  <div class="input-group input-group-sm">
                    <input type="text" id="txtEstimasiProduksi" class="form-control"
                      placeholder="Perkiraan Produksi Daya" readonly />
                    <div class="input-group-append">
                      <span class="input-group-text">kWh/Tahun</span>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">
                  <p onclick="ViewDetail()">Total Biaya Investasi  <span class="fas fa-angle-down"></span></p>
                </th>
                <td>
                  <p><em>Total biayakebutuhan pemasangan PLTS</em></p>
                </td>
                <td>
                  <div>
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text">RP</span>
                      </div>
                      <input type="text" id="txtInvestTotal" class="form-control" placeholder="Total biaya investasi" readonly />
                    </div>
                  </div>
                </td>
              </tr>
              <tr></tr>
              <tr id="HiddenHasil">
                <th scope="row">
                  <p>Biaya Modul</p>
                  <p>Biaya Inverter</p>
                  <p>Biaya Struktur</p>
                  <p>Biaya Aksesoris</p>
                  <p>Biaya Instalasi</p>
                </th>
                <td>
                  <p><em>Panel Surya</em></p>
                  <p><em>Pengubah arus DC menjadi arus AC</em></p>
                  <p><em>Penyangga, Mounting, Beton</em></p>
                  <p><em>Kabel, Panel Penghubung, Proteksi</em></p>
                  <p><em>Pengiriman, Instalasi</em></p>
                </td>
                <td>
                  <div>
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text">RP</span>
                      </div>
                      <input type="text" id="txtModulPrice" class="form-control" placeholder="Biaya Modul" readonly />
                    </div>
                  </div>
                  <div>
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text">RP</span>
                      </div>
                      <input type="text" id="txtInverterPrice" class="form-control"
                        placeholder="Total biaya inverter" readonly />
                    </div>
                  </div>
                  <div>
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text">RP</span>
                      </div>
                      <input type="text" id="txtStructurPrice" class="form-control"
                        placeholder="Total biaya struktur" readonly />
                    </div>
                  </div>
                  <div>
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text">RP</span>
                      </div>
                      <input type="text" id="txtAccessoriesPrice" class="form-control"
                        placeholder="Total biaya aksesoris" readonly />
                    </div>
                  </div>
                  <div>
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text">RP</span>
                      </div>
                      <input type="text" id="txtIntallPrice" class="form-control" placeholder="Total biaya instalasi" readonly />
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Estimasi Penghematan (Rp/Bulan)</th>
                <td>
                  <em>Penghematan tagihan listrik PLN rata-rata bulanan</em>
                </td>
                <td>
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text">RP</span>
                    </div>
                    <input type="text" id="txtReduction" class="form-control" placeholder="Estimasi penghematan" readonly />
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Emisi Karbon (ton CO2)</th>
                <td>
                  <em>Total pengurangan emisi karbon </em>
                </td>
                <td>
                  <div class="input-group input-group-sm">
                    <input type="text" id="txtEmisiKarbon" class="form-control"
                      placeholder="Emisi Karbon" readonly />
                    <div class="input-group-append">
                      <span class="input-group-text">Ton CO2</span>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Penanaman Pohon</th>
                <td>
                  <em>Jumlah pohon yang ditanam</em>
                </td>
                <td>
                  <div class="input-group input-group-sm">
                    <input type="text" id="txtTanamPohon" class="form-control"
                      placeholder="Penanaman Pohon" readonly />
                    <div class="input-group-append">
                      <span class="input-group-text">Pohon</span>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">BBM Kendaraan Bermotor</th>
                <td>
                  <em>Penghematan Konsumsi BBM </em>
                </td>
                <td>
                  <div class="input-group input-group-sm">
                    <input type="text" id="txtKendaraanBermotor" class="form-control"
                      placeholder="BBM Kendaraan Bermotor" readonly />
                    <div class="input-group-append">
                      <span class="input-group-text">Liter</span>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Potensi PLTS</th>
                <td>
                  <em>Potensi PLTS berdasarkan Luas</em>
                </td>
                <td>
                  <div class="input-group input-group-sm">
                    <input type="text" id="txtPotensiPLTS" class="form-control"
                      placeholder="BBM Kendaraan Bermotor" readonly />
                    <div class="input-group-append">
                      <span class="input-group-text">kWp</span>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>

          <canvas id="resultChart" height="50"></canvas>
          <br />
          <div class="float-right">
            <button id="btnBack" class="btn btn-primary">
              Kembali
            </button>
            <button id="btnSimulasiekonomi" class="btn btn-primary">
              Keekonomian
            </button>
            <!--<button class="btn btn-success" id="btnCetak">
              Cetak
            </button>-->
          </div>
      </div>
    </div>
  </div>

  <br />

  <div id="card-ekonomi" class="container p-0" style="display: none;">
    <div class="card">
      <div class="card-body" id="SimulasiInput">
        <h3 class="card-title">Keterangan Teknis</h3>
        <h6 class="card-subtitle mb-2 text-muted">
          Tambahkan informasi mengenai Aspek Finansial Anda
        </h6>
        <table class="table table-borderless table-striped">
          <tbody>
            <tr>
              <th scope="row">Modal Sendiri</th>
              <td>
                <em>Modal yang dimiliki</em>
              </td>
              <td>
                <div class="input-group input-group-sm">
                  <input type="number" id="txtModalFinansial" class="form-control" min="0" max ="100"
                    placeholder="Modal Finansial" onchange="ModalFinansial(this.value)"/>
                  <div class="input-group-prepend">
                    <span class="input-group-text">%</span>
                    <span id="error"></span>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">Pinjaman</th>
              <td>
                <em>Pinjaman (Loan)</em>
              </td>
              <td>
                <div class="input-group input-group-sm">
                  <input type="text" id="txtPinjaman" class="form-control"
                    placeholder="Pinjaman (Loan)" readonly/>

                  <div class="input-group-prepend">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">Suku Bunga Pinjaman</th>
              <td>
                <em>Suku Bunga Pinjaman</em>
              </td>
              <td>
                <div class="input-group input-group-sm">
                  
                  <input type="text" id="txtBungaPinjaman" class="form-control"
                    placeholder="Suku Bunga"/>
                  <div class="input-group-prepend">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">Bunga Diskonto</th>
              <td>
                <em>Bunga Diskonto</em>
              </td>
              <td>
                <div class="input-group input-group-sm">
                  
                  <input type="text" id="txtBungaDiskon" class="form-control"
                    placeholder="Bunga Diskon"/>
                  <div class="input-group-prepend">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
              </td>
            </tr>
            <!--<tr>
              <th scope="row">Umur PLTS</th>
              <td>
                <em>Umur PLTS (Tahun)</em>
              </td>
              <td>
                <div class="input-group input-group-sm">
                  
                  <input type="number" id="txtUmurPLTS" class="form-control"
                    placeholder="Umur PLTS" min="0" max ="100" />
                  <div class="input-group-prepend">
                    <span class="input-group-text">Tahun</span>
                  </div>
                </div>
              </td>
            </tr>-->
            <tr>
              <th scope="row">Lama Pinjam</th>
              <td>
                <em>Lama Pinjam (Tahun)</em>
              </td>
              <td>
                <div class="input-group input-group-sm">
                  
                  <input type="number" id="txtLamaPinjam" class="form-control"
                    placeholder="Lama Pinjam" min="0" max ="100" />
                  <div class="input-group-prepend">
                    <span class="input-group-text">Tahun</span>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <button id="btnSimulasiHitung" class="btn btn-success float-right">
          Simulasi
        </button>
      </div>
      <div class="card-body" id="SimulasiHasil" style="display: none;">
        <h3 class="card-title">Hasil Evaluasi Finansial</h3>
        <h6 class="card-subtitle mb-2 text-muted">
          Berikut hasil evaluasi finansial
        </h6>
        <table class="table table-borderless table-striped">
          <tbody>
            <tr>
              <th scope="row">IRR Project</th>
              <td>
                <em>IRR Project </em>
              </td>
              <td>
                <div class="input-group input-group-sm">
                  <input type="text" id="txtIRRProject" class="form-control"
                    placeholder="IRR Project" />
                  <div class="input-group-prepend">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">IRR Equity</th>
              <td>
                <em>Pengembalian Modal</em>
              </td>
              <td>
                <div class="input-group input-group-sm">
                  <input type="text" id="txtIRREquity" class="form-control"
                    placeholder="IRR Equity" />
                  <div class="input-group-prepend">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">NPV (Rp)</th>
              <td>
                <em>Total nilai pengembalian modal</em>
              </td>
              <td>
                <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <span class="input-group-text">RP</span>
                  </div>
                  <input type="text" id="txtNPV" class="form-control"
                    placeholder="NPV" />
                  
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">Waktu Pengembalian</th>
              <td>
                <em>Waktu Pengembalian (Tahun)</em>
              </td>
              <td>
                <div class="input-group input-group-sm">
                  
                  <input type="text" id="txtTimePengembalian" class="form-control"
                    placeholder="Waktu Pengembalian" />
                  <div class="input-group-prepend">
                    <span class="input-group-text">Tahun</span>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="float-right">
          
            <button id="btnBackHome" class="btn btn-primary">
              Home
            </button>
            <button id="btnBackSimulasi" class="btn btn-primary">
                  Kembali
            </button>
          <!--<button class="btn btn-success" id="btnCetak">
            Cetak
          </button>-->
        </div>
        
      </div>
    </div>
  </div>

  <br />
  <!-- Start Footer area-->
  <div class="footer">
    <div class="container p-0">
      <p class="copyright">
        COPYRIGHT &copy;
        <script type="text/javascript">
          document.write(new Date().getFullYear());
        </script>
        PUSAT PENELITIAN DAN PENGEMBANGAN TEKNOLOGI KETENAGALISTRIKAN, ENERGI
        BARU, TERBARUKAN, DAN KONVERSI ENERGI
      </p>
      <div class="info">
        <p style="padding-top: 0px; padding-bottom: 0px;">
          PUSAT PENELITIAN DAN PENGEMBANGAN TEKNOLOGI KETENAGALISTRIKAN,
          ENERGI BARU, TERBARUKAN DAN KONVERSI ENERGI
        </p>
        <p style="padding-top: 0px; padding-bottom: 0px;">
          JL. PENDIDIKAN NO.1 PENGASINAN, GUNUNG SINDUR, KABUPATEN BOGOR, JAWA
          BARAT 16340
        </p>
        <p style="padding-top: 0px;">
          TELP +62 (021) 80634050 - 51 FAX +62 (021) 80634058 - 59
        </p>
      </div>
    </div>
  </div>
  <!-- End Footer area-->

  <!-- jquery  -->
  <script src="public/js/jquery-3.5.1.min.js"></script>
  <!-- bootstrap JS  -->
  <script src="public/js/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="public/js/bootstrap/bootstrap.bundle.min.js"></script>
  <!-- Chart JS -->
  <script src="public/js/Chart.min.js"></script>

  <!-- intro JS  -->
  <script src="public/js/intro.min.js"></script>

  <!-- LESS -->
  <script src="public/js/less.min.js"></script>
  <script src="public/js/accounting.js"></script>
  <script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJ_YAen9tZXKU4Mp6lR692gCjBpybQIhk&libraries=drawing,geometry,visualization,places&sensor=false"></script>

  <script type="text/javascript">
    //introJs().start();
    var result = "";
    var dataLocation = "";
    var Biaya_Investasi = '';
    var Operasional = '';
    var Biaya_inverter = '';
    var Estimasi_Penghematan = '';
    var Depresiasi_modul = '';
    var pv_density = '';
    var akses_rasio = '';
    var safety_factor = '';
    var DCAC_ratio = '';
    var rasio_kinerja = '';
    var self_consumption = '';
    var kwh_ekspor = '';
    var faktor_arah_kemiringan = '';
    var Konstanta_emisi_CO2 = '';
    var Konstanta_Pohon = '';
    var kontanta_BBM = '';
    var umur_PLTS = '';
    var EstimasiProduksi_PLTS = '';
    var tarif_listrik;

    var gmarkers = [];
    $(document).ready(function () {

      var introKey = 'intro_storage';
      var isIntro = localStorage.getItem(introKey);
      if(!isIntro)
      {
        introguide.start();
        localStorage.setItem(introKey, 'done');
      }
      InitMaps();
    });

    var introguide = introJs();
    introguide.setOptions({
        steps: [
        {
          element: '.search-bar',
          intro: 'Cari Lokasi'
        },
        {
          element: '.maps',
          intro: 'Gambar Luas Area',
          position: 'TOP_RIGHT'
        },
        {
          element: '#card-guest',
          intro: 'Buku Tamu'
        },
        {
          element: '#card-input',
          intro: 'Isi Data Perhitungan'
        }
        ]
    });


    $("#btnSimulasiekonomi").click(function () {

        jQuery.noConflict();

        var cardInput = document.getElementById("card-input");
        cardInput.style.display = "none";

        var cardguest = document.getElementById("card-guest");
        cardguest.style.display = "none";

        var cardguest = document.getElementById("card-result");
        cardguest.style.display = "none";

        var divLoading = document.getElementById("loader");
        divLoading.style.display = "none";

        var cardResult = document.getElementById("card-Maps");
        cardResult.style.display = "none";

        var cardEkonomi = document.getElementById("card-ekonomi");
        cardEkonomi.style.display = "block";

    });

    
    function ModalFinansial(val) 
    {
      var txtLamaPinjam = document.getElementById("txtLamaPinjam");  
      var txtModalFinansial = document.getElementById("txtModalFinansial");

      var txtBungaPinjaman = document.getElementById("txtBungaPinjaman");
      var txtBungaDiskon = document.getElementById("txtBungaDiskon");

      var error = document.getElementById("error");      
      
      if(txtModalFinansial.value > 100)
      {
            error.textContent = "Modal lebih dari 100%" 
            error.style.color = "red"
            txtPinjaman.value = '';
            txtBungaPinjaman.value = '';
            txtBungaDiskon.value = '';
      }else
      {
            error.textContent = '';
            txtPinjaman.value = 100 - txtModalFinansial.value;
            txtBungaPinjaman.value = 9;
            txtBungaDiskon.value = 6;
      }
    }
    
    $("#btnSimulasiHitung").click(function () {

        jQuery.noConflict();

        var cardEkonomi = document.getElementById("SimulasiInput");
        cardEkonomi.style.display = "none";

        var txtModalFinansial_ = document.getElementById("txtModalFinansial");
        var txtPinjaman_ = document.getElementById("txtPinjaman");
        var txtBungaPinjaman_ = document.getElementById("txtBungaPinjaman");
        var txtBungaDiskon_ = document.getElementById("txtBungaDiskon");
        //var txtUmurPLTS_ = document.getElementById("txtUmurPLTS");
        var txtLamaPinjam_ = document.getElementById("txtLamaPinjam");     


        var txtIRRProject = document.getElementById("txtIRRProject"); 
        var txtIRREquity = document.getElementById("txtIRREquity"); 
        var txtNPV = document.getElementById("txtNPV"); 
        var txtTimePengembalian = document.getElementById("txtTimePengembalian"); 
        
        var self_consumption_ = self_consumption; //'0.9';//self_consumption;
        var kwh_ekspor_ = kwh_ekspor; //'0.1';//kwh_ekspor;

        var txtModalFinansial = txtModalFinansial_.value / 100;
        var txtPinjaman = txtPinjaman_.value / 100;
        var txtBungaPinjaman = txtBungaPinjaman_.value / 100;
        var txtBungaDiskon = txtBungaDiskon_.value / 100;
        var txtUmurPLTS = '20';
        var txtLamaPinjam = txtLamaPinjam_.value;

        var Biaya_Investasi_ = Biaya_Investasi; //'41659000';
        var Biaya_inverter_ = Biaya_inverter; //'10054000';
        var Estimasi_Penghematan_ = Estimasi_Penghematan; //'350125';
        var Operasional = '0.005';
        var Depresiasi_modul = '0.005';
        var Produksi_PLTS = EstimasiProduksi_PLTS; //'2968';
        var tarif = tarif_listrik;//'1467';

        jQuery.ajax({
              url: 'calc2.php',
              type: 'get',
              dataType: "json",
              contentType: "application/json;charset=utf-8",
              data: { "Biaya_Investasi_": Biaya_Investasi_, "Biaya_inverter_" : Biaya_inverter_, "Estimasi_Penghematan_" : Estimasi_Penghematan_, "Operasional" : Operasional, "Depresiasi_modul" : Depresiasi_modul,
          "Produksi_PLTS" : Produksi_PLTS, "tarif" : tarif, "tModalFinansial" : txtModalFinansial,"tPinjaman":txtPinjaman,"tBungaPinjaman":txtBungaPinjaman,"tBungaDiskon":txtBungaDiskon, "tUmurPLTS":txtUmurPLTS, "tLamaPinjam":txtLamaPinjam , "self_consumption":self_consumption_,"kwh_ekspor":kwh_ekspor_},
              success: function(response) {

                var cardSimulasiHasil = document.getElementById("SimulasiHasil");
                    cardSimulasiHasil.style.display = "block";
                //alert(response.irrProject);
                //var txtIRRProject_ = Math.round(response.irrProject).toFixed(2);
                txtIRRProject.value = response.irrProject;
                //alert(response.irrEquity);
                //var txtIRREquity_ = //Math.round(response.irrEquity).toFixed(2);
                txtIRREquity.value = response.irrEquity;
                txtNPV.value = accounting.formatNumber(response.npv);
                txtTimePengembalian.value = response.waktu_pengembalian;

              },
              error: function(response){
                alert('Error Perhitungan, Mohon dicoba kembali!')
                var cardEkonomi = document.getElementById("SimulasiInput");
                    cardEkonomi.style.display = "block";
                var cardSimulasiHasil = document.getElementById("SimulasiHasil");
                    cardSimulasiHasil.style.display = "none";
                //alert(response.responseText);
                //location.reload();
              }
          });

        return false;

    });

    $("#btnCalculate").click(function () 
    {
        var element = document.getElementById("HiddenHasil");
        element.style.display = 'none';

        document.getElementById("btnhapus").disabled = true;
        document.getElementById("searchmap").disabled = true;
        var txtJob = document.getElementById("txtJob").value;
        var txtInstance = document.getElementById("txtInstance").value;
        var toastMessage = document.getElementById("toast-message");

        // Variable yang nantinya akan dipakai
        var LuasGrid = '2';
        var JumlahGrid = '';
        var latLocation = '';
        var longLocation = '';
        var Tagihan_TanpaPLTS = '0';
        var Tagihan_denganPLTS = '0';

        if (dataLocation != "")
        {
          var dataLatLog = dataLocation.split(',');
          latLocation = dataLatLog[0];
          longLocation = dataLatLog[1];
          
        }
        else
        {
            latLocation = 7.0135;
            longLocation = 46.9587;
        }

        var isValid = validateGuest(txtJob, txtInstance);
        if (!isValid) 
        {
          toastMessage.innerHTML = "Buku tamu harus diisi.";
          $(".toast").toast("show");
        } 
        else 
        {

          jQuery.noConflict();

          var cardInput = document.getElementById("card-input");
          cardInput.style.display = "none";

          var cardguest = document.getElementById("card-guest");
          cardguest.style.display = "none";

          // var cardResult = document.getElementById("card-result");
          // cardResult.style.display = "block";

          var ddBuildingType = document.getElementById("ddBuildingType");
          var ddPosition = document.getElementById("ddPosition");
          var ddPower = document.getElementById("ddPower");
          var ddroofdirection = document.getElementById("ddArahAtap");
          var ddTagihanRatarata = document.getElementById("ddTagihanRatarata");
          var ddJenisAtap = document.getElementById("ddJenisAtap");


          var txtRoofTiltDegree = document.getElementById("txtRoofTiltDegree").value;
          var txtPowerOther = document.getElementById("txtPowerOther").value;
          var txtElectricCharge = document.getElementById("txtElectricCharge").value;
          var txtAreaSize = document.getElementById("txtAreaSize").value;
          var bulan = ddTagihanRatarata.options[ddTagihanRatarata.selectedIndex].value;
          //alert(bulan);

          var propertyType =
            ddBuildingType.options[ddBuildingType.selectedIndex].text;
          var placement = 'Atap';//ddPosition.options[ddPosition.selectedIndex].text;
          var powerExisting = ddPower.options[ddPower.selectedIndex].text;
          var roofdirection = ddArahAtap.options[ddroofdirection.selectedIndex].text;
          // var bulan = ddTagihanRatarata.options[ddTagihanRatarata.selectedIndex].text;
          var jenis_atap = ddJenisAtap.options[ddJenisAtap.selectedIndex].text;

          //Hasil dari kalkulasi digenerate di form berikut
          var txtPLTSCapacity = document.getElementById("txtPLTSCapacity");
          var txtModulCapacity = document.getElementById("txtModulCapacity");
          var txtModulQuantity = document.getElementById("txtModulQuantity");
          var txtInverterCapacity = document.getElementById("txtInverterCapacity");
          var txtSystemWeight = document.getElementById("txtSystemWeight");
          var txtEstimasiProduksi = document.getElementById("txtEstimasiProduksi");
          var txtInvestTotal = document.getElementById("txtInvestTotal");
          var txtModulPrice = document.getElementById("txtModulPrice");
          var txtInverterPrice = document.getElementById("txtInverterPrice");
          var txtStructurPrice = document.getElementById("txtStructurPrice");
          var txtAccessoriesPrice = document.getElementById("txtAccessoriesPrice");
          var txtIntallPrice = document.getElementById("txtIntallPrice");
          var txtReduction = document.getElementById("txtReduction");
          var txtEmisiKarbon = document.getElementById("txtEmisiKarbon");
          var txtTanamPohon = document.getElementById("txtTanamPohon");
          var txtKendaraanBermotor = document.getElementById("txtKendaraanBermotor");
          var txtPotensiPLTS = document.getElementById("txtPotensiPLTS");
          

          var TarifDasarDaya ='';
          JumlahGrid = txtAreaSize / LuasGrid;

          var daya='';
          if(powerExisting != 'Pilih daya')
          {
              if(powerExisting == 'Lainnya')
              {

                  daya=txtPowerOther;
              }
              else
              {
                  daya=powerExisting;
              }
          }

          var _sudutAzumut='0';
          var val = roofdirection;
          if (val == 'Utara')
          {
            _sudutAzumut = '0';
          }
          else if (val == 'Timur')
          {
            _sudutAzumut = '90';
          }
          else if (val == 'Selatan')
          {
            _sudutAzumut = '180';
          }
          else if (val == 'Barat')
          {
            _sudutAzumut ='270' ;
          }
          else if (val == 'Timur Laut')
          {
            _sudutAzumut = '45';
          }
          else if (val == 'Barat Daya')
          {
            _sudutAzumut = '315';
          }

          var defaultOperational = "12";
          var safetyfactor =  "1.25";
          var radius = "4";
          var pemakaianListrik = txtElectricCharge / TarifDasarDaya;
          var jamOperationalperhari = defaultOperational / 24;
          var kebutuhanListrikplts = (pemakaianListrik/30) * jamOperationalperhari;
          var KapasitasPLTS = kebutuhanListrikplts *  safetyfactor / radius;
          KapasitasPLTS = Math.round(KapasitasPLTS).toFixed(1);

          //latLocation = dataLatLog[0];
          //longLocation = dataLatLog[1];
          var divLoading = document.getElementById("loader");
          divLoading.style.display = "block";
          jQuery.ajax({
                  url: 'calc.php',
                  type: 'get',
                  dataType: "json",
                  contentType: "application/json;charset=utf-8",
                  data: { "luas_area": txtAreaSize, "jumlah_grid" : JumlahGrid, "tipe_bangunan" : propertyType, "posisi_pemasangan" : placement, "daya" : daya,
              "bulan" : bulan, "tagihan_listrik" : txtElectricCharge, "jenis_atap" : jenis_atap, "arah_atap" : roofdirection, "kemiringan_atap" : txtRoofTiltDegree,
              "sudut_azimut" : _sudutAzumut, "latLocation" : latLocation, "longLocation" : longLocation},
                  success: function(response) {
                    var divLoading = document.getElementById("loader");
                    divLoading.style.display = "none";
                    var cardResult = document.getElementById("card-result");
                      cardResult.style.display = "block";
                    txtPLTSCapacity.value = response.kapasitas_plts;
                    txtModulCapacity.value = response.kapasitas_modul;
                    txtModulQuantity.value = response.jumlah_modul;
                    txtInverterCapacity.value = response.kapasitas_inverter;
                    txtSystemWeight.value = accounting.formatNumber(Math.round(response.total_berat_beban_sistem_plts).toFixed(0));
                    var estimasi_produksi_ =  Math.round(response.estimasi_produksi).toFixed(0);
                    EstimasiProduksi_PLTS = estimasi_produksi_;
                    estimasi_produksi_ = accounting.formatNumber(estimasi_produksi_);
                    txtEstimasiProduksi.value = estimasi_produksi_;
                    txtInvestTotal.value = accounting.formatNumber(response.total_biaya_investasi);
                    txtModulPrice.value = accounting.formatNumber(response.biaya_modul);
                    txtInverterPrice.value = accounting.formatNumber(response.biaya_inverter);
                    txtStructurPrice.value = accounting.formatNumber(response.biaya_struktur);
                    txtAccessoriesPrice.value = accounting.formatNumber(response.biaya_asesoris);
                    txtIntallPrice.value = accounting.formatNumber(response.biaya_instalasi);
                    var estimasi_penghematan_ = response.estimasi_penghematan;
                    estimasi_penghematan_ = Math.round(estimasi_penghematan_).toFixed(0);
                    txtReduction.value = accounting.formatNumber(estimasi_penghematan_);

                    var txtEmisiKarbon_ = response.emisi_karbon;
                    txtEmisiKarbon.value = txtEmisiKarbon_;
                    var txtTanamPohon_= response.penanaman_pohon;
                    txtTanamPohon.value = accounting.formatNumber(txtTanamPohon_);//Math.round(txtTanamPohon_).toFixed(3);
                    var txtKendaraanBermotor_ = response.bbm_kendaraan_bermotor;
                    txtKendaraanBermotor.value = accounting.formatNumber(txtKendaraanBermotor_);//Math.round(txtKendaraanBermotor_).toFixed(3);

                    var Tagihan_denganPLTS_ = response.Tagihan_denganPLTS;
                    Tagihan_denganPLTS = Math.round(Tagihan_denganPLTS_).toFixed(0);

                    var Tagihan_TanpaPLTS_ = response.Tagihan_TanpaPLTS;
                    Tagihan_TanpaPLTS = Math.round(Tagihan_TanpaPLTS_).toFixed(0);
                    displayChart(Tagihan_denganPLTS,Tagihan_TanpaPLTS);
                    txtPotensiPLTS.value = response.potensi_plts;
                    Biaya_Investasi = response.total_biaya_investasi;
                    Biaya_inverter = response.biaya_inverter;
                    Estimasi_Penghematan = estimasi_penghematan_;

                    pv_density = response.pv_density;
                    akses_rasio = response.akses_rasio;
                    safety_factor = response.safety_factor;
                    DCAC_ratio = response.DCAC_ratio;
                    rasio_kinerja = response.rasio_kinerja;
                    self_consumption = response.self_consumption;
                    kwh_ekspor = response.kwh_ekspor;
                    faktor_arah_kemiringan = response.faktor_arah_kemiringan;
                    Konstanta_emisi_CO2 = response.Konstanta_emisi_CO2;
                    Konstanta_Pohon = response.Konstanta_Pohon;
                    kontanta_BBM = response.kontanta_BBM;
                    umur_PLTS = response.umur_PLTS;
                    tarif_listrik = response.tarif_listrik;

                  },
                  error: function(response){
                    alert('Error Perhitungan, Mohon dicoba kembali!');
                    location.reload();
                  }
              });
          }
        
      });

   
    var overlays = [];
    var selectedShape;
    var PathLocationDrawing = '';

    function InitMaps() {
      var currentPosition = new google.maps.LatLng(-6.124931, 106.786487);
      //removeMarkers();
      var map = new google.maps.Map(document.getElementById("map"));
      var input = document.getElementById("pac-input");
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function (position) 
          {
              currentPosition = new google.maps.LatLng(
                position.coords.latitude,
                position.coords.longitude
              );
              dataLocation = position.coords.latitude + "," + position.coords.longitude;

              var mapOptions = {
                center: currentPosition,
                zoom: 20,
                mapTypeId: "hybrid",
                zoomControl: true,
                zoomControlOptions: {
                  position: google.maps.ControlPosition.RIGHT_CENTER
                },
                fullscreenControl: true,
                fullscreenControlOptions: {
                  position: google.maps.ControlPosition.TOP_RIGHT
                },
                
              };
              //var geocoder = new google.maps.Geocoder();
              var infowindow = new google.maps.InfoWindow();
              var infowindowContent = document.getElementById("infowindow-content");
              //Getting map DOM element

              infowindow.setPosition(currentPosition);
              infowindow.setContent(infowindowContent);
              var mapElement = document.getElementById("mapDiv");

              //Creating a map with DOM element which is just obtained
              map = new google.maps.Map(mapElement, mapOptions);
              var marker = new google.maps.Marker({
                  position: currentPosition,
                  draggable: true,
                  title: 'Lokasi Saya'
              }); 

              //geocodeLatLng(geocoder, currentPosition, infowindow);
              //alert(addrs);
              marker.setMap(map);
              gmarkers.push(marker);

              var autocomplete = new google.maps.places.Autocomplete(input);
              autocomplete.bindTo("bounds", map);
              autocomplete.setFields([
                "address_components",
                "geometry",
                "icon",
                "name",
              ]);
              // Adds a marker to the map.
              $("#searchmap").click(function () {
                removeMarkers();
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                  window.alert(
                    "No details available for input: '" + place.name + "'"
                  );
                  return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                  map.fitBounds(place.geometry.viewport);
                  map.setZoom(25); 
                } else {
                  map.setCenter(place.geometry.location);
                  map.setZoom(25); // Why 17? Because it looks good.
                }

                var address = "";
                if (place.address_components) {
                  address = [
                    (place.address_components[0] && place.address_components[0].short_name) || "",
                    (place.address_components[1] && place.address_components[1].short_name) || "",
                    (place.address_components[2] && place.address_components[2].short_name) || "",
                  ].join(" ");
                }

                infowindowContent.children["place-icon"].src = place.icon;
                infowindowContent.children["place-name"].textContent = place.name;
                infowindowContent.children["place-address"].textContent = address;

                dataLocation = place.geometry.location.lat() + "," + place.geometry.location.lng();
                currentPosition = new google.maps.LatLng(
                        place.geometry.location.lat(),
                        place.geometry.location.lng()
                      );
                 var marker = new google.maps.Marker({
                      position: currentPosition,
                      title: 'Lokasi Saya'
                  }); 
                  marker.setMap(map);
                  gmarkers.push(marker);

              });

              //creating drawingManager
              var drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: true,
                drawingControlOptions: {
                  position: google.maps.ControlPosition.RIGHT_CENTER,
                  drawingModes: [
                    google.maps.drawing.OverlayType.POLYGON,
                  ],
                },
                //specific drawing mode options, this one for polygon
                polygonOptions: {
                  strokeColor: "blue",
                  strokeWeight: 3,
                  fillColor: "yellow",
                  fillOpacity: 0.2
                },
              });
              //enable drawing functionality
              drawingManager.setMap(map);
              //add event listener for completion of your polygon
              google.maps.event.addListener(
                drawingManager,
                "polygoncomplete",
                function (polygon) {
                  //get the coordinate array of your polygon
                  var path = polygon.getPath();
                  PathLocationDrawing = path;
                  var area = google.maps.geometry.spherical.computeArea(path);
                  var length = google.maps.geometry.spherical.computeLength(path);
                  
                  var fixarea = area.toFixed(2);
                  var txtAreaSize = document.getElementById("txtAreaSize");
                  txtAreaSize.value = fixarea;

                  }
              );

              google.maps.Polygon.prototype.getArea = function () {
                var area = google.maps.geometry.spherical.computeArea(this.getPath());
                return area;
              };

              //extend the Polygon class to have getLength() function
              google.maps.Polygon.prototype.getLength = function () {
                var length = google.maps.geometry.spherical.computeLength(
                  this.getPath()
                );
                return length;
              };

          });

      }
      else
      {
          alert("Geolocation tidak mendukung di browser ini.");

          var mapOptions = {
          center: currentPosition,
          zoom: 20,
          mapTypeId: "hybrid",
          zoomControl: true,
          zoomControlOptions: {
            position: google.maps.ControlPosition.RIGHT_CENTER
          },
          fullscreenControl: true,
          fullscreenControlOptions: {
            position: google.maps.ControlPosition.TOP_RIGHT
          },
          
        };
        //var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById("infowindow-content");
        //Getting map DOM element

        infowindow.setPosition(currentPosition);
        infowindow.setContent(infowindowContent);
        var mapElement = document.getElementById("mapDiv");

        //Creating a map with DOM element which is just obtained
        map = new google.maps.Map(mapElement, mapOptions);
        var marker = new google.maps.Marker({
            position: currentPosition,
            draggable: true,
            title: 'Lokasi Saya'
        }); 

        //geocodeLatLng(geocoder, currentPosition, infowindow);
        //alert(addrs);
        marker.setMap(map);
        gmarkers.push(marker);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo("bounds", map);
        autocomplete.setFields([
          "address_components",
          "geometry",
          "icon",
          "name",
        ]);
        // Adds a marker to the map.
        $("#searchmap").click(function () {
          removeMarkers();
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            window.alert(
              "No details available for input: '" + place.name + "'"
            );
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
            map.setZoom(25); 
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(25); // Why 17? Because it looks good.
          }

          var address = "";
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name) || "",
              (place.address_components[1] && place.address_components[1].short_name) || "",
              (place.address_components[2] && place.address_components[2].short_name) || "",
            ].join(" ");
          }

          infowindowContent.children["place-icon"].src = place.icon;
          infowindowContent.children["place-name"].textContent = place.name;
          infowindowContent.children["place-address"].textContent = address;

          dataLocation = place.geometry.location.lat() + "," + place.geometry.location.lng();
          currentPosition = new google.maps.LatLng(
                  place.geometry.location.lat(),
                  place.geometry.location.lng()
                );
           var marker = new google.maps.Marker({
                position: currentPosition,
                title: 'Lokasi Saya'
            }); 
            marker.setMap(map);
            gmarkers.push(marker);

        });

        //creating drawingManager
        var drawingManager = new google.maps.drawing.DrawingManager({
          drawingMode: google.maps.drawing.OverlayType.POLYGON,
          drawingControl: true,
          drawingControlOptions: {
            position: google.maps.ControlPosition.RIGHT_CENTER,
            drawingModes: [
              google.maps.drawing.OverlayType.POLYGON,
            ],
          },
          //specific drawing mode options, this one for polygon
          polygonOptions: {
            strokeColor: "blue",
            strokeWeight: 3,
            fillColor: "yellow",
            fillOpacity: 0.2
          },
        });
        //enable drawing functionality
        drawingManager.setMap(map);
        //add event listener for completion of your polygon
        google.maps.event.addListener(
          drawingManager,
          "polygoncomplete",
          function (polygon) {
            //get the coordinate array of your polygon
            var path = polygon.getPath();
            PathLocationDrawing = path;
            var area = google.maps.geometry.spherical.computeArea(path);
            var length = google.maps.geometry.spherical.computeLength(path);
            
            var fixarea = area.toFixed(2);
            var txtAreaSize = document.getElementById("txtAreaSize");
            txtAreaSize.value = fixarea;

            }
        );

        google.maps.Polygon.prototype.getArea = function () {
          var area = google.maps.geometry.spherical.computeArea(this.getPath());
          return area;
        };

        //extend the Polygon class to have getLength() function
        google.maps.Polygon.prototype.getLength = function () {
          var length = google.maps.geometry.spherical.computeLength(
            this.getPath()
          );
          return length;
        };
      }

    }

    function removeMarkers() {
      for (i = 0; i < gmarkers.length; i++) {
        gmarkers[i].setMap(null);
      }
    }

    function removeLineSegment(){
          
          var path = PathLocationDrawing;  
          for (var i=0; i <= path.length; i++)
          {
              path.pop();
          } // remove last line segment

          var txtAreaSize = document.getElementById("txtAreaSize");
          txtAreaSize.value = '';
          
      }

    function CheckPosition(val)
    {
      var txtRoofTiltDegree = document.getElementById('txtRoofTiltDegree'); 
      if (val != 'Atap')
      {
        $("#ddJenisAtap").val("Lainnya");
        txtRoofTiltDegree.value = '15';
      
      }
      else
      {
          $("#ddJenisAtap").val("Pilih atap");
          txtRoofTiltDegree.value = '';
      }

    }

    function CheckPower(val) {
      var element = document.getElementById('txtPowerOther');
      if (val == 'Lainnya')
        element.style.display = 'block';
      else
        element.style.display = 'none';
    }
    var sudutAzumut = '';

    function CheckAtap(val) { 
      var txtRoofTiltDegree = document.getElementById('txtRoofTiltDegree');    
      if (val == 'Genteng keramik')
      {
          txtRoofTiltDegree.value = '30';
          $("#ddArahAtap").val("Pilih arah atap");
          sudutAzumut = '';
      }
      else if (val == 'Metal Sheet')
      {
          txtRoofTiltDegree.value = '10';
          $("#ddArahAtap").val("Pilih arah atap");
          sudutAzumut = '';
      }
      else if (val == 'Dak Beton')
      {
          $("#ddArahAtap").val("Utara");
          sudutAzumut = '0';
          txtRoofTiltDegree.value = '15';
      }
      else
      {
          txtRoofTiltDegree.value = '15';
          $("#ddArahAtap").val("Pilih arah atap");
          sudutAzumut = '';
      }
    }

    function validateGuest(job, instance) {
      if (job.length > 0 && instance.length > 0) {
        return true;
      } else {
        return false;
      }
    }

    function displayChart(tdp,ttp) {
      var ctx = document.getElementById("resultChart");
      var chart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
          labels: ["Tanpa PLTS", "Dengan PLTS"],
          datasets: [
            {
              label: "Ilustrasi Tagihan",
              data: [ttp, tdp],
              backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(54, 162, 235, 0.2)",
              ],
              borderColor: [
                "rgba(255, 99, 132, 1)",
                "rgba(54, 162, 235, 1)",
              ],
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            xAxes: [
              {
                ticks: {
                  beginAtZero: true,
                },
              },
            ],
          },
        },
      });
    }

    $("#btnBack").click(function () {
      jQuery.noConflict();

      var cardInput = document.getElementById("card-input");
      cardInput.style.display = "block";

      var cardResult = document.getElementById("card-result");
      cardResult.style.display = "none";

      document.getElementById("btnhapus").disabled = false;
        document.getElementById("searchmap").disabled = false;
      location.reload();
    });

    $("#btnBackHome").click(function () {
      jQuery.noConflict();

      var cardInput = document.getElementById("card-input");
      cardInput.style.display = "block";

      var cardResult = document.getElementById("card-result");
      cardResult.style.display = "none";

      document.getElementById("btnhapus").disabled = false;
        document.getElementById("searchmap").disabled = false;
      location.reload();
    });

    $("#btnBackSimulasi").click(function () {
      jQuery.noConflict();

      var cardEkonomi = document.getElementById("SimulasiInput");
          cardEkonomi.style.display = "block";
      var cardSimulasiHasil = document.getElementById("SimulasiHasil");
          cardSimulasiHasil.style.display = "none";

    });
    var countClik = 1;
    function ViewDetail()
    {
      if(countClik == 1)
      {
          var element = document.getElementById("HiddenHasil");
          element.style.display = '';  
          countClik = countClik + 1;
      }
      else if(countClik = 2)
      {
          var element = document.getElementById("HiddenHasil");
          element.style.display = 'none';  
          countClik = 1;
      }
    }
    
    $("#btnCetak").click(function () {
      jQuery.noConflict();
      return false;

    });
  </script>
</body>

</html><?php /**PATH /home/u774182381/domains/hospod.id/public_html/drsmart01/resources/views/home.blade.php ENDPATH**/ ?>