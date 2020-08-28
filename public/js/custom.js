$(document).ready(function(){

    function refreshTable() {
        $('.dataTable').each(function() {
            dt = $(this).dataTable();
            dt.fnDraw();
        })
    }

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

    $('body').on('click', '.btnDeleteItem', function(e){
        e.preventDefault();

        var item_id = $(this).data('id')

        // console.log(item_id)

        var url = '/deleteItem/' + item_id

        $.ajax({
            url: url,
            method: 'DELETE',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response){
                Toast.fire({
                    icon: 'success',
                    title: response.success
                })
                refreshTable();
            },
            error: function(error){
                console.log('error')
            }
        })
    })


    $('#btnAddItem').click(function(e){
        e.preventDefault();

        var url = '/admindashboard/addItem'

        var formData = {
            unit: $('#unit').val(),
            description: $('#description').val(),
        }

        // console.log(formData, '#btnAddItem')

        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response){
                console.log(response.success)
            },
            error: function(error){
                console.log(error)
            }
        })

    })
})