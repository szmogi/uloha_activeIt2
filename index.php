<!DOCTYPE html>
<html>
<?php

session_start();

require "_inc/config.php";


                


if (isset($_POST['reset']) && !empty($_POST['reset'])) {
    if ($_POST['reset'] == true) {
        session_destroy();
    }
}


if (empty($_SESSION['first_name']) || empty($_SESSION['last_name'])) {  
    $_SESSION['first_name'] = '';
    $_SESSION['last_name'] = '';
}

unset($_SESSION["updated"]);


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
            <div class=" col-lg-6 col-md-8 col-10 d-flex flex-row justify-content-between">
                <a href="table-user.php">Registrovaný</a>
                <a href="" id='reset-form'>Resetovať formulár</a>
            </div>
            <form id="name-form" action="address-form.php" method="GET" class="p-3 col-lg-6 col-md-8 col-10 d-flex flex-column mb-3 shadow p-3 mb-5 bg-body
                  rounded align-items-center name-validation" novalidate>
                <h1 class="p-1">Formulár</h1>
                <div class="col-md-8 col-12 ">
                    <label for="validationCustom01" class="form-label">Meno<span class="text-danger fw-semibold">&nbsp;*</span></label>
                    <input id="first_name" name="first_name" value="<?php echo $_SESSION['first_name']  ?>" type="text" class="form-control" id="validationCustom01" required>
                </div>
                <div class="col-md-10 col-lg-8 col-12 ">
                    <label for="validationCustom02" class="form-label">Priezvisko<span class="text-danger fw-semibold">&nbsp;*</span></label>
                    <input id="last_name" name="last_name" value="<?php echo  $_SESSION['last_name'] ?>" type="text" class="form-control" id="validationCustom02" required>
                </div>
                <div class="col-md-10 col-12 ">
                    <button class="btn btn-primary btn-lg" type="submit">Ďalej</button>
                </div>
            </form>
        </div>
    </main>
</body>
<script src="<?= asset('/js/function.js') ?>"></script>
<script src="<?= asset('/js/jquery-3.6.0.min.js') ?>"></script>
<script>
    animatedOpacity('name-form');
    //validation form
    (() => {
        'use strict'

        const forms = document.querySelectorAll('.name-validation')

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



    $('#reset-form').on('click', function(event) {
        event.preventDefault();
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {
                reset: true
            },
            success: function(res) {
                $('#first_name').val('')
                $('#last_name').val('')
            }
        })

    })
</script>


</html>