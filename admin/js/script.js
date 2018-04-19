$(document).ready(function(){
    // Editor
    ClassicEditor
        .create(document.querySelector('#body'))
        .catch(error => {
            console.log(error);
        });

    $('#selectAllBoxes').click(function(e){
        if(this.checked){
            $('.checkBoxes').each(function(){
                this.checked = true;
            })
        }
        else{
            $('.checkBoxes').each(function () {
                this.checked = false;
            })
        }
    });  
    // let div_box = "<div id= 'load-screen'><div id='loading'></div></div>";
        
    //     $("body").prepend(div_box);
    //     $('#load-screen').fadeOut(2000, () => {
    //         $(this).remove();
    //     })
    


});


