<!DOCTYPE html>
<html>
<?php

require "_inc/config.php";

require_once 'partial/Pagination.php';

session_start();


if (empty($_SESSION['updated'])) {
    $_SESSION['updated'] = null;
}

$pagination  = new Pagination('users', $dbname);
$users = $pagination->get_data();
$pages  = $pagination->get_pagination_number();


?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tabulka</title>
    <link rel="stylesheet" href="<?= asset('/css/base.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital@1&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>


<body class="bg-light">

    <main>
        <div class="container-lg  text-center d-flex flex-column align-items-center">
            <div class="col-12 d-flex flex-column align-items-center py-2">
                <div id="msg-success" class="fixed-top col-12 alert alert-success" role="alert">
                    <h4>Zmena bolo úspešné !</h4>
                    <span>X</span>
                </div>
                <div id="msg-alert" class="fixed-top col-12 alert alert-danger" role="alert">
                    <h4>Skúste znova !</h4>
                    <span>X</span>
                </div>
            </div>
            <h6 class="text-end">
                <a href="index.php">Registrovať</a>
            </h6>
            <div id="users-table" class="col-12 d-flex flex-column align-items-center  rounded  p-3 mb-5 bg-body align-items-center ">
                <?php if (count($users) > 0) : ?>
                    <h1 class="p-4">Zoznam registrovaných užívateľov </h1>
                    <table id="table" class="table table-light rounded shadow ">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Meno</th>
                                <th scope="col">Prizvisko</th>
                                <th scope="col">Ulica</th>
                                <th scope="col">Čislo</th>
                                <th scope="col">PSČ</th>
                                <th scope="col">Mesto</th>
                                <th scope="col">IBAN</th>
                                <th scope="col">Platný IBAN</th>
                                <th scope="col">Registrované</th>
                                <th scope="col">Upraviť</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $key => $value) : ?>
                                <tr id="user-<?= $value->id ?>">
                                    <th scope="row"><?= $value->id ?></th>
                                    <td class="text-break"><?= $value->first_name ?></td>
                                    <td class="text-break"><?= $value->last_name ?></td>
                                    <td class="text-break"><?= $value->street_address ?></td>
                                    <td class="text-break"><?= $value->address_number ?></td>
                                    <td class="text-break"><?= $value->zip_code ?></td>
                                    <td class="text-break"><?= $value->city ?></td>
                                    <td class="text-break"><?= $value->iban ?></td>
                                    <td class="text-break fw-semibold <?= $value->valid == 1 ? 'text-success' : 'text-danger' ?> ">
                                        <?= $value->valid == 1 ? 'ANO' : 'NIE'  ?></td>
                                    <td class="text-break"><?= time_form($value->created_at) ?></td>
                                    <td class="b-flex text-break">
                                        <div>
                                            <form id="edit-user" action="edit-user.php" method="GET">
                                                <input type="hidden" name="user-id" value="<?= $value->id ?>">
                                                <button type="submit" class="btn m-0 p-1 btn-success btn-sm">Upraviť</button>
                                            </form>
                                            <form id="del-user" method="post">
                                                <input type="hidden" value="<?= $value->id ?>">
                                                <button style="font-size:0.7rem;" type="submit" class="btn m-1 p-1 text btn-danger btn-sm">Zmazať</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="b-flex">
                        <?php for ($i = 1; $i <= $pages; $i++) : ?>
                            <a class="mx-1" href="?page=<?= $i; ?>"><?= $i; ?></a>
                        <?php endfor ?>
                    </div>
                <?php else : ?>
                    <h1>Prázdny Zoznam</h1>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
<script src="<?= asset('/js/jquery-3.6.0.min.js') ?>"></script>
<script src="<?= asset('/js/function.js') ?>"></script>
<script>
    var updated = <?php echo json_encode($_SESSION['updated']); ?>



    //variable
    var delForm = document.querySelectorAll('#del-user')
    var editForm = document.querySelectorAll('#edit-user');
    var msgSuccess = document.getElementById('msg-success');
    var msgAlert = document.getElementById('msg-alert');

    //function
    msgHide()

    //opacity animated
    animatedOpacity('table', 300)


    // if updated user 
    if (JSON.parse(updated) == true) {
        animatedOpacity('msg-success', 500, true)
        msgSuccess.style.display = 'flex'
    } else if (JSON.parse(updated) == false) {
        animatedOpacity('msg-alert', 500, true)
        msgAlert.style.display = 'flex'
    }



    // Deletes a form for each user and adds it to the users database.
    delForm.forEach(function(el) {
        el.addEventListener('submit', event => {
            event.preventDefault()
            var id = el.firstElementChild.value

            if (confirm('Určite vymazať ?')) {
                $.ajax({
                    url: 'partial/UsersDatabase.php',
                    type: 'Post',
                    data: {
                        deleted: id
                    },
                    success: function(res) {
                        if (res == true) {
                            $('#user-' + id).fadeOut()
                            animatedOpacity('msg-success', 500, true)
                            msgSuccess.style.display = 'flex'
                        } else {
                            animatedOpacity('msg-alert', 500, true)
                            msgAlert.style.display = 'flex'
                        }

                    },
                    error: function(err) {
                        animatedOpacity('msg-alert', 500, true)
                        msgAlert.style.display = 'flex'

                    },

                })

            }

        })


    })
</script>

<?php
  if(isset($_SESSION['updated'])){
       unset($_SESSION['updated']);    
  }   
?>

</html>