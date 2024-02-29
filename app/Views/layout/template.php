<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>

    <title><?= esc($title) ?></title>

    <!-- Custom fonts for this template-->
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom syules for tables -->
    <link href="/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        #loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: none;
        }

        #loading .d-flex {
            color: white;
            font-size: 24px;
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .loader {
            width: 60px;
            display: flex;
            justify-content: space-evenly;
        }

        .ball {
            list-style: none;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #fff;
        }

        .ball:nth-child(1) {
            animation: bounce-1 2.1s ease-in-out infinite;
        }

        @keyframes bounce-1 {
            50% {
                transform: translateY(-18px);
                background-color: #3b3bd1;
            }
        }

        .ball:nth-child(2) {
            animation: bounce-3 2.1s ease-in-out 0.3s infinite;
        }

        @keyframes bounce-2 {
            50% {
                transform: translateY(-18px);
                background-color: #3b3bd1;
            }
        }

        .ball:nth-child(3) {
            animation: bounce-3 2.1s ease-in-out 0.6s infinite;
        }

        @keyframes bounce-3 {
            50% {
                transform: translateY(-18px);
                background-color: #3b3bd1;
            }
        }

        .centered-table td {
            text-align: center;
        }
    </style>

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?= $this->include('layout/sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= $this->include('layout/topbar') ?>
                <?= $this->renderSection('content') ?>
            </div>
            <?= $this->include('layout/footer') ?>
        </div>


        <div id="loading" style="display: block;">
            <div class="d-flex justify-content-center align-items-center">
                <div class="loader">
                    <li class="ball"></li>
                    <li class="ball"></li>
                    <li class="ball"></li>
                </div>
            </div>
        </div>



    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins js tables -->
    <script src="/assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level  table custom scripts -->
    <script src="/assets/js/demo/datatables-demo.js"></script>

    <!-- My Js scripts -->
    <script src="/assets/js/custom-all-pages.js"></script>
    <script src="/assets/js/custom-tambah-pages.js"></script>
    <script src="/assets/js/custom-kelola-pages.js"></script>
    <script src="/assets/js/custom-edit-pages.js"></script>
    <script src="/assets/js/custom-detail-pages.js"></script>

    <!-- CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    


</body>

</html>