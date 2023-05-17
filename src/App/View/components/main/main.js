document.addEventListener('DOMContentLoaded', function (){
    try{

        // remove notification after 10 seconds
        setTimeout(function () {

            Array.from(
                document.querySelectorAll('.notification')
            ).map(n => n.remove());

        }, 10000);

    } catch (error){
        console.error(error);
    }
}, false);