<!DOCTYPE html>
<html>
<?php

require "_inc/config.php";

session_start();


$_SESSION['street_address'] = $_GET['street_address'];
$_SESSION['address_number'] = $_GET['address_number'];
$_SESSION['city'] = $_GET['city'];
$_SESSION['zip_code'] = $_GET['zip_code'];


if (isset($_GET['iban'])) {
    $_SESSION['iban'] =  $_GET['iban'];
} else {
    if (empty($_SESSION['iban'])) {
        $_SESSION['iban'] = '';
    }
}


foreach ($_SESSION as $key => $value) {
    if (!isset($value)) {
        header('Location: index.php ');
    }
}

$FormData = $_SESSION;


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
        <div id="msg-group" class="container-lg text-center d-flex flex-column align-items-center">
            <div class="col-12 d-flex flex-column align-items-center py-2">
                <div id="msg-success" class="fixed-top col-12 alert alert-success" role="alert">
                    <h4>Registrácia bolo úspešné !</h4>
                    <span>X</span>
                </div>
                <div id="msg-alert" class="fixed-top col-12 alert alert-danger" role="alert">
                    <h4>Skúste znova !</h4>
                    <span>X</span>
                </div>
            </div>
            <form id="iban-form" class="p-5 col-lg-6 form col-md-8 col-10 d-flex flex-column mb-3 rounded shadow p-3 mb-5 bg-body align-items-center 
                          iban-validation justify-content-end" novalidate>
                <h1 class="p-4">Formulár</h1>
                <div class="regg-user-info col-12 mb-4 text-start p-2 text-break  ">
                    <div class="col-12 col-md-10 col-lg-8 col-xl-7 p-2 shadow-sm rounded">
                        <label class="col-12 text-start">Meno:</label>
                        <span class="col-12 fw-bold fs-6 "><?php echo ucfirst($FormData['first_name']);
                                                            echo ' ';
                                                            echo ucfirst($FormData['last_name']) ?></span>
                        <label class="col-12 text-start">Adresa:</label>
                        <span class="col-12 fw-bold fs-6 "><?php echo ucfirst($FormData['street_address']);
                                                            echo ' ';
                                                            echo $FormData['address_number'] ?></span><br>
                        <span class="col-12 fw-bold fs-6 "><?php echo ucfirst($FormData['city']);
                                                            echo ' ';
                                                            echo $FormData['zip_code'] ?></span>
                        <label class="col-12 text-start  ">IBAN:</label>
                        <span id="iban-new-value" class="col-12 fs-6 fw-bold "><?php echo $_SESSION['iban'] ?></span>
                    </div>
                </div>
                <div class="col-12 col-md-10 col-xl-8 my-2">
                    <label for="validationCustom01" class="form-label">IBAN<span class="text-danger fw-semibold">&nbsp;*</span></label>
                    <div>
                        <input id="iban-number" type="text" value="<?php echo $_SESSION['iban'] == null ? '' : $_SESSION['iban']; ?>" name="iban-number" class="form-control" id="validationCustom01" required>
                        <div class="valid-feedback">
                            Overený IBAN !
                        </div>
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            IBAN je neplatný !
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center  ">
                    <a class="mx-1" href="javascript:history.back()">Späť</a>
                    <button id="valid-regg" class="btn m-2 px-4 btn-primary btn-lg" type="submit">Registrácia</button>
                    <a id="not-valid-regg" class="btn m-2 mx-1 btn-primary btn-lg">Registrovať bez platného IBAN</a>
                </div>
            </form>
        </div>
    </main>
</body>
<script src="<?= asset('/js/jquery-3.6.0.min.js') ?>"></script>
<script src="<?= asset('/js/function.js') ?>"></script>
<script>
    //function
    msgHide()


    //data formular
    var data = <?php echo json_encode($FormData); ?>;

    //variable
    var ibanForm = document.getElementById('iban-form')
    var ibanInput = document.getElementById('iban-number');
    var msgSuccess = document.getElementById('msg-success');
    var msgAlert = document.getElementById('msg-alert');
    var ibanValidateYes = document.getElementById('iban-validate-yes');
    var ibanValidateNop = document.getElementById('iban-validate-not');
    var buttonNotValRegg = document.getElementById('not-valid-regg');

    //opacity
    animatedOpacity('iban-form')

    // Add click event listener if button not value register
    buttonNotValRegg.addEventListener('click', event => {
        if (confirm('Bez platného IBAN nebudete vedieť plne využívať naše služby!')) {
            registration()
        }

    })


    // Registers the user with the database.
    function registration(valid = false) {
        data.iban = {
            iban: ibanInput.value,
            valide: valid
        }



        // Adds a new value to the IBAN form
        $.ajax({
            url: "iban-form.php",
            type: 'GET',
            data: {
                iban: ibanInput.value,
                street_address: data.street_address,
                address_number: data.address_number,
                city: data.city,
                zip_code: data.zip_code,
            },
            success: function() {
                document.getElementById('iban-new-value').innerHTML = ibanInput.value
            }
        });


        // add user database
        $.ajax({
            url: "partial/UsersDatabase.php",
            type: 'POST',
            data: {
                action: JSON.stringify(data)
            },
            success: function(response) {
                if (response == true) {
                    animatedOpacity('msg-success', 500, true)
                    msgSuccess.style.display = 'flex'
                    buttonNotValRegg.style.display = 'none';
                } else {
                    msgAlert.style.display = 'flex'
                    animatedOpacity('msg-alert', 500, true)
                    buttonNotValRegg.style.display = 'none';
                }


            },
            error: function(response) {
                msgAlert.style.display = 'flex'
                animatedOpacity('msg-alert', 500, true)
                buttonNotValRegg.style.display = 'none';
            },

        });
    }


    //     Validate iban.
    //      https://ibanapi.com  su to testovacie volania ak by neslo treba sa regg
    $('#iban-form').on('submit', function(e) {
        e.preventDefault();

        iban = ibanInput.value

        api_key = '1814de94c6b7c282d55fda6bbc6bbfed3efcd3d9'

        $.ajax({
            url: "https://api.ibanapi.com/v1/validate/" + iban + "?api_key=" + api_key,
            dataType: 'jsonp',
            success: function(data) {
                if (data.result == 200) {
                    ibanInput.classList.remove('is-invalid')
                    ibanInput.classList.add('is-valid')
                    animatedOpacity('not-valid-regg', 500)
                    registration(true)
                } else {

                    ibanInput.classList.add('is-invalid')
                    ibanInput.classList.remove('is-valid')
                    msgAlert.style.display = 'flex'
                    animatedOpacity('msg-alert', 500, true)
                    buttonNotValRegg.style.display = 'block';
                }
            },
            error: function(data) {
                registration()
                ibanInput.classList.remove('is-invalid')
                ibanInput.classList.add('is-valid')

            }

        });



    })
</script>

</html>