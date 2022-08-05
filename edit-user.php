<!DOCTYPE html>
<html>
<?php


require "_inc/config.php";


if (!empty($_GET['user-id']) && filter_var($_GET['user-id'], FILTER_VALIDATE_INT)) {

    $id = $_GET['user-id'];

    test_input($id);

    $query = $db->prepare('SELECT * FROM users WHERE id = :id');

    $query->execute(['id' => $id]);

    if ($query->rowCount() === 1) {

        (object)$user = $query->fetchAll(PDO::FETCH_OBJ);
    } else {
        header('Location: index.php ');
    }
} else {
    header('Location: index.php ');
}

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Uloha</title>
    <link rel="stylesheet" href="<?= asset('/css/base.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital@1&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>


<body class="bg-light">
    <main>
        <div class="container-lg text-center d-flex flex-column align-items-center">
            <div class="col-12 d-flex flex-column align-items-center py-2">
                <div id="msg-success" class="position-absolute col-6 alert alert-success" role="alert">
                    <h4>Zmena bolo úspešné !</h4>
                    <span>X</span>
                </div>
                <div id="msg-alert" class=" position-absolute col-6 alert alert-danger" role="alert">
                    <h4>Skúste znova !</h4>
                    <span>X</span>
                </div>
            </div>
            <form action="partial/UsersDatabase.php" method="POST" id="edit-form" class="p-2 col-xl-6 col-md-8 col-10 d-flex flex-column mb-3  rounded shadow p-3 mb-5 bg-body align-items-center 
                          edit-validation justify-content-end" novalidate>
                <h1 class="p-4">Formulár</h1>
                <div class="col-12 d-flex flex-rows justify-content-center ">
                    <div class="col-md-6   mx-1">
                        <label for="validationCustom01" class="form-label">Meno<span class="text-danger fw-semibold">&nbsp;*</span></label>
                        <input id="first_name" type="text" name="first_name" value="<?php echo $user[0]->first_name ?>" class="form-control" id="validationCustom01" required>
                    </div>
                    <div class="col-md-6   mx-1">
                        <label for="validationCustom02" class="form-label">Prizvisko<span class="text-danger fw-semibold">&nbsp;*</span></label>
                        <input id="last_name" type="text" name="last_name" value="<?php echo $user[0]->last_name ?>" class="form-control" id="validationCustom02" required>
                    </div>
                </div>
                <div class="col-12 d-flex flex-rows justify-content-center ">
                    <div class="col-md-8 mx-1">
                        <label for="validationCustom03" class="form-label">Ulica<span class="text-danger fw-semibold">&nbsp;*</span></label>
                        <input id="street_address" type="text" name="street_address" value="<?php echo $user[0]->street_address ?>" class="form-control" id="validationCustom03" required>
                    </div>
                    <div class="col-md-4 mx-1">
                        <label for="validationCustom04" class="form-label">Čislo<span class="text-danger fw-semibold">&nbsp;*</span></label>
                        <input id="address_number" type="text" name="address_number" value="<?php echo $user[0]->address_number ?>" class="form-control" id="validationCustom04" required>
                    </div>
                </div>
                <div class="col-12 d-flex flex-rows justify-content-center ">
                    <div class="col-md-8 mx-1">
                        <label for="validationCustom05" class="form-label">Mesto<span class="text-danger fw-semibold">&nbsp;*</span></label>
                        <input id="city" type="text" name="city" class="form-control" value="<?php echo $user[0]->city ?>" id="validationCustom05" required>
                    </div>
                    <div class="col-md-4 mx-1">
                        <label for="validationCustom06" class="form-label">PSČ<span class="text-danger fw-semibold">&nbsp;*</span></label>
                        <input id="zip_code" type="text" name="zip_code" value="<?php echo $user[0]->zip_code ?>" class="form-control" id="validationCustom06" required>
                    </div>
                </div>
                <div class="col-xl-10 col-8 mx-1">
                    <label for="validationCustom06" class="form-label">IBAN<span class="text-danger fw-semibold">&nbsp;*</span></label>
                    <input id="iban" type="text" name="iban" value="<?php echo $user[0]->iban ?>" class="form-control" id="validationCustom06" required>

                </div>
                <div class="col-12">
                    <a class="mx-1" href="javascript:history.back()">Späť</a>
                    <input type="hidden" name="PUT-id" value="<?php echo $user[0]->id ?>">
                    <button class="btn btn-primary mx-2 btn-lg" type="submit">Zmeniť</button>
                </div>
            </form>
        </div>
    </main>
</body>
<script src="<?= asset('/js/function.js') ?>"></script>
<script src="<?= asset('/js/jquery-3.6.0.min.js') ?>"></script>

<script>
    //opacity 
    animatedOpacity('edit-form');

    //validation form
    (() => {
        'use strict'

        const forms = document.querySelectorAll('.edit-validation')

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



</html>