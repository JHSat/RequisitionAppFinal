
$(document).ready(function(){

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-left',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        onOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    wrapper = '.container2'
    initSelect2();
    var max_fields = 10;
    var x =0;

    $('.add_form').click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++
            // console.log(x)
            // $(wrapper).append('<div class="d-flex my-2"><select class="form-control mx-1 items_id"><option>Select Item</option><option>...</option><option id ="itemdesc[]" name="">...</option></select><input type="number" name="mytext[]" placeholder="quantity" class="form-control"/><a href="#" class="delete btn btn-danger mx-2"> - </a></div>')

            $.ajax({
                url: '/select2item',
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    code: 2
                },
                success: function(res){
                    $(wrapper).append(res);
                    // console.log(res)
                    initSelect2();
                    // sample();
                }
            })
        }
        else{
            alert('maximum input reached!');
        }
    })

    $(wrapper).on("click", ".delete", function(e){
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
        // console.log(x)
    })

    // $('body').on('click', '#btnSubmitSample', function(e){
    //     e.preventDefault();

    //     var form = $('#sampleForm').serializeArray();

    //     console.log(form)
    // })

    $('body').on('click', '#btnSubmitSample', function(e){
        e.preventDefault();

        var formData = $('#sampleForm').serializeArray();
        var url = '/insertRequest'


        console.log(formData)
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'POST',
            data: formData,
            success: function(res){
                Toast.fire({
                    icon: 'success',
                    title: res.success
                })
                setTimeout (function(){
                    window.location.href = "/userdashboard";
                }, 2500)
            },
            error: function(err){
                console.log(err)
            }
        })
    })



    function initSelect2(){
        $('.selItem').select2({
            // theme: bootstrap,
            theme: "bootstrap",
            placeholder: 'select an item',
            allowClear: true,
            ajax: {
                url: '/select2item',     
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function(params){
                    return {
                        _token: CSRF_TOKEN,
                        search: params.term
                    }           
                },
    
                processResults: function(response){
                    // var array = response.data
                    // console.log(response)
                    return{
                        results: response
                    }
                },
                cache: true
            }
        })
    }
})
