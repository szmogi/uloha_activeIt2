<?php

require "../_inc/config.php";



session_start();


// Insert a new user into the database.
if (isset($_POST['action']) && !empty($_POST['action'])) {

    $formData = json_decode($_POST['action']);    

     foreach ($formData as $value) {        
        if(is_object($value)){
            foreach ($value as $iban) { $iban = test_input($iban); }
        }else{ $value = test_input($value); }
     }     

        $newUser = $db->prepare("
            INSERT INTO users
                ( first_name , last_name, street_address, address_number, zip_code, city , iban)
                 VALUES
                ( :first_name, :last_name, :street_address, :address_number, :zip_code, :city , :iban)
        ");

        $insert = $newUser->execute([
            'first_name'  => $formData->first_name,
            'last_name'  => $formData->last_name,
            'street_address'  => $formData->street_address,
            'address_number'  => $formData->address_number,
            'zip_code'  => $formData->zip_code,
            'city'  => $formData->city,
            'iban'  => $formData->iban->iban,

          ]);

        if($db->lastInsertId() > 0){

         $userId = $db->lastInsertId();

          $newValid = $db->prepare("
              INSERT INTO ibanvalidate
                ( user_id , valid)
                 VALUES
                ( :user_id, :valid)
            ");
           $insert = $newValid->execute([
                'user_id'  => $userId,
                'valid'  => $formData->iban->valide,
           ]);
       }

    if ($newUser->rowCount() > 0) {
        echo true;
    } else {
        echo false;
    }

}

//deleted user
if (isset($_POST['deleted'])) {

    $id = test_input($_POST['deleted']);

    $delete = $db->prepare("					
                        DELETE users, ibanvalidate FROM users  
                        INNER JOIN ibanvalidate ON users.id= ibanvalidate.user_id   
                        WHERE users.id = :id;  				
						");
    $delete->execute(['id' =>$id]);


    if($delete->rowCount() > 0){

        echo true;

    }else{

        echo false;
    }

}




// Set the user,iban
if(isset($_POST['PUT-id']) && strlen(($_POST['PUT-id']) > 0)){
      
      
       $editArray =  $_POST ;

       foreach ($editArray as $key => $value) {
             $value =  test_input($value);
       }    
       

    $updata_user = $db->prepare("
	    Update users SET
		    first_name  = :first_name, 
			last_name  =  :last_name ,            
            street_address = :street_address,
            address_number = :address_number,
            city = :city,
            zip_code = :zip_code,
            iban = :iban  
			WHERE 
			 id = :id	 
	 ");

    $updata_user->execute([
        'first_name' => $editArray['first_name'],
        'last_name' => $editArray['last_name'],
        'street_address' => $editArray['street_address'],
        'address_number' => $editArray['address_number'],
        'city' => $editArray['city'],
        'zip_code' => $editArray['zip_code'],
        'iban' => $editArray['iban'],
         'id' => $editArray['PUT-id']

      ]);         

    if ($updata_user->rowCount() || $updata_user->rowCount() === 0) {
        
           
         if(validateIban($editArray['iban'])->result == 200){
            
            $valid_iban = 1;

          }else{

            $valid_iban = 0;
            
          }

         $updata_iban = $db->prepare("
               Update ibanvalidate SET
               valid = :valid		
                   WHERE 
                user_id = :user_id ");

            $updata_iban->execute([
                'valid' => $valid_iban,
                'user_id' => $editArray['PUT-id']

            ]);   


        $_SESSION['updated'] = 'true';

       redirect('table-user.php');

    } else{
    
        $_SESSION['updated'] = 'false'; 
    }


}



