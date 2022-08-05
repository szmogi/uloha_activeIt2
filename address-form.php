<!DOCTYPE html>
<html>
<?php


require "_inc/config.php";

session_start();

$_SESSION['first_name'] = $_GET['first_name'];
$_SESSION['last_name'] = $_GET['last_name'];

if (empty($_SESSION['street_address']) || empty($_SESSION['city'])) {
    $_SESSION['street_address'] = '';
    $_SESSION['address_number'] = '';
    $_SESSION['city'] = '';
    $_SESSION['zip_code'] = '';
}



?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulár</title>
    <link rel="stylesheet" href="<?= asset('/css/base.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital@1&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>


<body class="bg-light">
    <main>
        <div class="container-lg text-center d-flex flex-column align-items-center">
            <form action="iban-form.php" method="GET" id="address-form" class="p-3 form col-lg-6 col-md-8 col-10 d-flex flex-column mb-3  rounded shadow p-3 mb-5 bg-body align-items-center 
                          address-validation justify-content-end" novalidate>
                <h1 class="p-4 m-0">Formulár</h1>
                <div class="regg-user-info col-12 mb-4 text-start p-2">
                    <div class="col-4 p-2 rounded  shadow-sm">
                        <label class="col-12 text-start">Meno:</label>
                        <span class="col-12 fw-bold fs-6 text-start"><?php echo ucfirst($_SESSION['first_name']);
                                                                        echo ' ';
                                                                        echo ucfirst($_SESSION['last_name']) ?></span>

                    </div>
                </div>
                <div class="col-12 d-flex flex-rows justify-content-center ">
                    <div class="col-md-8 mx-1">
                        <label for="validationCustom01" class="form-label">Ulica<span class="text-danger fw-semibold">&nbsp;*</span></label>
                        <input id="street_address" type="text" name="street_address" value="<?php echo ($_SESSION['street_address']) ?>" class="form-control" id="validationCustom01" required>
                    </div>
                    <div class="col-md-4 mx-1">
                        <label for="validationCustom02" class="form-label">Čislo<span class="text-danger fw-semibold">&nbsp;*</span></label>
                        <input id="address_number" type="text" name="address_number" value="<?php echo $_SESSION['address_number'] ?>" class="form-control" id="validationCustom02" required>
                    </div>

                </div>
                <div class="col-12 d-flex flex-rows justify-content-center ">
                    <div class="col-md-8 mx-1">
                        <label for="validationCustom03" class="form-label">Mesto<span class="text-danger fw-semibold">&nbsp;*</span></label>
                        <input id="city" type="text" name="city" class="form-control" value="<?php echo $_SESSION['city']  ?>" id="validationCustom03" required>
                    </div>
                    <div class="col-md-4 mx-1">
                        <label for="validationCustom04" class="form-label">PSČ<span class="text-danger fw-semibold">&nbsp;*</span></label>
                        <input id="zip_code" type="text" name="zip_code" value="<?php echo $_SESSION['zip_code']  ?>" class="form-control" id="validationCustom04" required>
                    </div>
                </div>

                <div class="col-12">
                    <a class="mx-1" href="javascript:history.back()">Späť</a>
                    <button class="btn btn-primary mx-2 btn-lg" type="submit">Ďalej</button>
                </div>
            </form>
        </div>
    </main>
</body>
<script src="<?= asset('/js/function.js') ?>"></script>
<script>
    //opacity 
    animatedOpacity('address-form');
    //validation form
    (() => {
        'use strict'

        const forms = document.querySelectorAll('.address-validation')

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')

            }, false)
        })
    })()
</script>
<script src="<?= asset('/js/jquery-3.6.0.min.js') ?>"></script>



</html>