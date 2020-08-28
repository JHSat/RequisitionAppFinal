$(document).ready(function(){
    $('body').on('click', '.btnViewUserDetails', function(){
        $('#userModal').modal('show');
        var user = $(this).data('id');
        // console.log(user)

        $.get('/userDetails/' + user, function(data){
            $('#id').text(data.id);
            $('#name').text(data.name);
            $('#email').text(data.email);

            console.log(data);
        })
    })

    $('body').on('click', '.btnViewItemDetails', function(){

        var user = $(this).data('id')

        $('#modalItemDetails').modal('show');
        $.get('/getItemDetails/' + user, function(data){
            $('#item_id').text(data.item_id)
            $('#itemCode').text(data.itemCode)
            $('#unit').text(data.unit)
            $('#description').text(data.description)
        })
    })


    $('body').on('click', '.btnEditItem', function(){

        var user = $(this).data('id')
        console.log(user)
        $('#modalEdit').modal('show');
        $.get('/getItemDetails/' + user, function(data){
            $('#editUnit').val(data.unit)
            $('#editDescription').text(data.description)
        })
    })
})