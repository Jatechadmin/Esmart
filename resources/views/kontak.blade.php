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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="public/css/bootstrap/bootstrap.min.css" />

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="public/css/fontawesome/all.min.css" />
    <link rel="stylesheet" href="public/css/font-awesome.min.css">
    <!-- Chart CSS -->
    <link rel="stylesheet" href="public/css/Chart.min.css" />

    <!-- style CSS
    ============================================ -->
    <link rel="stylesheet/less" type="text/css" href="public/css/style.less" />
    <style>
    .row {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px
    }
    </style>

    <body>

        <!-- Start Header Top Area -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <img src="public/img/esmart.png" alt="app_icon" width="auto" height="40" loading="lazy" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto"></ul>
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <a class="nav-link" href="/home" id="menuDropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-map-marker-alt"></i> Tentukan Lokasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/artikel"><i class="fas fa-solar-panel"></i> Tentang PLTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/regulasi">
                            <i class="fas fa-book"></i> Regulasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/kontak">
                            <i class="fas fa-address-card"></i> Kontak Kami
                        </a>
                    </li>
                </ul>

                <ul class="nav right">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <!--<i class="far fa-user"></i>-->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Header Top Area -->

        <hr></hr>
        <section id="appointment" class="appointment">
            <div class="appointment_area bg-light">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-5 col-md-6 col-lg-6">
                            <div class="appiontment_thumb d-none d-lg-block">
                                <img src="public/img/p3tek.png" alt="">
                            </div>
                        </div>
                        <div class="col-xl-6 offset-xl-1 col-md-6 col-md-12 col-lg-6">
                            <div class="appointment_info">
                                <div class="opacity_icon d-none d-lg-block">
                                    <i class="flaticon-balance"></i>
                                </div>
                                <h3>Kontak kami</h3>
                                <p>Merencanakan PLTS sesuai dengan kebutuhan anda.</p>
                                <form action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6">
                                            <input type="text" name="name" id="name" placeholder="Nama">
                                        </div>
                                        <br />
                                        <div class="col-xl-6 col-md-6">
                                            <input type="email" name="email" id="email" placeholder="Email">
                                        </div>
                                        <br />
                                        <div class="col-xl-6 col-md-6">
                                            <input type="Number" min="0" name="phone" id="phone" placeholder="No Telepon">
                                        </div>
                                        <br />
                                        <div class="col-xl-12">
                                            <textarea type="text" name="message" id="message" placeholder="Pesan" cols="62"></textarea>
                                        </div>
                                        <br />
                                        <div class="col-xl-12">
                                            <div class="appoinment_button">
                                                <button class="boxed-btn5 " type="submit" onclick="return notifikasi();">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <hr></hr>
        <!-- Start Footer area-->
        <div class="footer">
            <div class="container p-0">
                <p class="copyright">
                    COPYRIGHT &copy;
                    <script type="text/javascript">
                        document.write(new Date().getFullYear());
                    </script>
                    PUSAT PENELITIAN DAN PENGEMBANGAN TEKNOLOGI KETENAGALISTRIKAN, ENERGI BARU, TERBARUKAN, DAN KONVERSI ENERGI
                </p>
                <div class="info">
                    <p style="padding-top: 0px; padding-bottom: 0px;">
                        PUSAT PENELITIAN DAN PENGEMBANGAN TEKNOLOGI KETENAGALISTRIKAN, ENERGI BARU, TERBARUKAN DAN KONVERSI ENERGI
                    </p>
                    <p style="padding-top: 0px; padding-bottom: 0px;">
                        JL. PENDIDIKAN NO.1 PENGASINAN, GUNUNG SINDUR, KABUPATEN BOGOR, JAWA BARAT 16340
                    </p>
                    <p style="padding-top: 0px;">
                        TELP +62 (021) 80634050 - 51 FAX +62 (021) 80634058 - 59
                    </p>
                </div>
            </div>
        </div>
        <!-- End Footer area-->
        <!-- kontak -->
        <script>
        function notifikasi()
        {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
            if (name && email && phone)
            {
                alert('Data telah terkirim!');
                window.location.reload();
            }
            else
            {
                alert('Data tidak lengkap!')
            }
        }
        </script>
        <!-- jquery  -->
        <script src="public/js/jquery-3.5.1.min.js"></script>

        <!-- bootstrap JS  -->
        <script src="public/js/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="public/js/bootstrap/bootstrap.bundle.min.js"></script>

        <!-- Chart JS -->
        <script src="public/js/Chart.min.js"></script>

        <!-- LESS -->
        <script src="public/js/less.min.js"></script>

        <script src="public/js/contact.js"></script>
        <script src="public/js/jquery.ajaxchimp.min.js"></script>
        <script src="public/js/jquery.form.js"></script>
        <script src="public/js/jquery.validate.min.js"></script>
        <script src="public/js/mail-script.js"></script>


        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJ_YAen9tZXKU4Mp6lR692gCjBpybQIhk&libraries=drawing,geometry,visualization,places&sensor=false"></script>
    </body>

</html>