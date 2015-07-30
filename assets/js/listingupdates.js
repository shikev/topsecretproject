$(document).ready(function() { 
            alert('fuck');
        /*place jQuery actions here*/ 
        var link = "http://localhost/project/"; // Url to your application (including index.php/)
        $("#category-filter").submit(function(event) {
            event.preventDefault();

            var isChem = '';
            var isBio = '';
            var isPhys ='';
            var isEcon = '';

            // Get the product ID and the quantity 
            if ($('input[name=categoryChem]').is(":checked"))
            {
              isChem = 'true';
            }
            if ($('input[name=categoryBio]').is(":checked"))
            {
              isBio = 'true';
            }
            if ($('input[name=categoryPhysics]').is(":checked"))
            {
               isPhys = 'true';
            }
            if ($('input[name=categoryEcon]').is(":checked"))
            {
               isEcon = 'true';
            }

            // var isChem = $(this).find('input[name=categoryBio]').val();
            // var isBio = $(this).find('input[name=categoryChem]').val();
            // var isPhys = $(this).find('input[name=categoryPhys]').val();
            // var isEcon = $(this).find('input[name=categoryEcon]').val();
            

            $.post(link + "pages/listing_update", { categoryChem: isChem, categoryBio: isBio, categoryPhysics: isPhys, 
                categoryEcon: isEcon},
                function(data){ 
                    alert( "Handler for .submit() called." );
                    // Interact with returned data
                    $("#results").html(data); // Replace the information in the div #cart_content with the retrieved data

             });
             
            return false; // Stop the browser of loading the page defined in the form "action" parameter.
        });
     });