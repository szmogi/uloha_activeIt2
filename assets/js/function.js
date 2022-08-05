


   function animatedOpacity(id,duration = 500,timeQut = false){
      var element =  document.getElementById(id)
          
        element.animate([{
                opacity: 0
            }, {
                opacity: 1
            }], {
                duration: duration
            }) 

        if(timeQut){
             setTimeout(() => {                       
                element.style.display = 'none'

            }, 2000);
        }
   }



    function msgHide() {
        // add event listener for msg - alert
        document.querySelector('#msg-alert > span').addEventListener('click', event => {
            msgAlert.style.display = 'none';
        })

        // Adds click event listener for msg success span
        document.querySelector('#msg-success > span').addEventListener('click', event => {
            msgSuccess.style.display = 'none';
        })
    }



