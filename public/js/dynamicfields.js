$(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".container1");
    var add_button = $(".add_form_field");
    var url = '/getAllItems'
    var html ='';

    var x = 0;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++
            // $(wrapper).append('<div class="d-flex my-2"><select class="form-control mx-1 items_id"><option>Select Item</option><option>...</option><option id ="itemdesc[]" name="">...</option></select><input type="number" name="mytext[]" placeholder="quantity" class="form-control"/><a href="#" class="delete btn btn-danger mx-2"> - </a></div>')
            $.ajax({
                method: 'GET',
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(res){
                    var i
                    html = '<div class="d-flex my-1"><select class="form-control mx-1" id="item" name="item[]">'
                        for(i=0; i < res.data.length; i++){   
                            // console.log(res.data[i].unit);
                            html = html+ '<option id='+res.data[i].item_id+' value='+res.data[i].item_id+'>'+res.data[i].unit+'</option>';
                        }
                    html = html +  '</select><input id="quantity" type="number" name="quantity[]" placeholder="quantity" class="mx-1 form-control"/></div>';
                    // console.log(html);
                    $(wrapper).append(html);
                    
                }
            })
            console.log(x)
            
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});
    // function getItems(){
    //     $.ajax({
    //         method: 'GET',
    //         url: url,
    //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //         success: function(res){
    //             // console.log(res.data)
    //             var i
    //             for(i; i < res.data.length; i++){
                    
    //                 x++;
    //                 // html =+ '<div class="container1">'+
    //                 //             '<select>'+
    //                 //                 '<option>'+res.data[i]+'</option>'
    //                 //             '</select>'+
    //                 //         '<div>';
    //                 $(wrapper).html(html);
    //             }
    //         }
    //     })
    // }
