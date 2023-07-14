<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Forms / Elements - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/assets/img/favicon.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
               <span class="d-none d-lg-block">
                    <i class="bi bi-grid"></i>
                    <i class="bi bi-grid"></i>
                    Event</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->




            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#"  style="background-color: rgb(132, 168, 221);">
                    <i class="bi bi-person"></i>
                    <span>Administrateur</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/artiste/liste">
                    <i class="bi bi-grid"></i>
                    <span>Artiste</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bar-chart"></i><span>Sonorisation</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/typesonorisation/liste">
                            <i class="bi bi-circle"></i><span>Type de Sonorisation</span>
                        </a>
                        <a href="/sonorisation/liste">
                            <i class="bi bi-circle"></i><span>Sonorisation</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#charts-nav1" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bar-chart"></i><span>Logistique</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav1" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/typelogistique/liste">
                            <i class="bi bi-circle"></i><span>Type de Logistique</span>
                        </a>
                        <a href="/logistique/liste">
                            <i class="bi bi-circle"></i><span>Logistique</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#charts-nav2" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bar-chart"></i><span>Lieu</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav2" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/typelieu/liste">
                            <i class="bi bi-circle"></i><span>Type de Lieu</span>
                        </a>
                        <a href="/lieu/liste">
                            <i class="bi bi-circle"></i><span>Lieu</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#charts-nav3" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bar-chart"></i><span>Categorie de lieu</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav3" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/categorie/liste">
                            <i class="bi bi-circle"></i><span>Categorie</span>
                        </a>
                        <a href="/categorielieu/listelieu">
                            <i class="bi bi-circle"></i><span>Place par categorie</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/divers/liste">
                    <i class="bi bi-journal"></i>
                    <span>Divers dépenses</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/taxe/form">
                    <i class="bi bi-journal"></i>
                    <span>Taxe</span>
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link collapsed" href="/util/deconnexionadmin">
                    <i class="bi bi-grid"></i>
                    <span>Deconnexion</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->

            {{-- <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Vente</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/client/list">
                            <i class="bi bi-circle"></i><span>Client</span>
                        </a>
                    </li>
                    <li>
                        <a href="/commande/list">
                            <i class="bi bi-circle"></i><span>Commande</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Components</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="components-alerts.html">
                            <i class="bi bi-circle"></i><span>Alerts</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Components Nav -->

            <li class="nav-item">
                <a class="nav-link " data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="forms-elements.html" class="active">
                            <i class="bi bi-circle"></i><span>Form Elements</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="tables-general.html">
                            <i class="bi bi-circle"></i><span>General Tables</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Tables Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="charts-chartjs.html">
                            <i class="bi bi-circle"></i><span>Chart.js</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Charts Nav -->


            <li class="nav-heading">Pages</li> --}}


        </ul>

    </aside><!-- End Sidebar-->
    <main id="main" class="main">

        <section class="section">
            @yield('content')
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/chart.js/chart.min.js"></script>
    <script src="/assets/vendor/echarts/echarts.min.js"></script>
    <script src="/assets/vendor/quill/quill.min.js"></script>
    <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/assets/js/main.js"></script>

</body>

</html>
