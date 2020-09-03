// const { method } = require("lodash");

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
            $('#unitItem').text(data.unit)
            $('#unitDescription').text(data.description)
        })
    })

    $('body').on('click', '.btnEditItem', function(){
        var user = $(this).data('id')
        console.log(user)
        $('#modalEdit').modal('show');
        $.get('/getItemDetails/' + user, function(data){
            $('#item_id').val(data.item_id)
            $('#itemCode').val(data.itemCode)
            $('#editUnit').val(data.unit)
            $('#editDescription').text(data.description)
        })
    })

    $('body').on('click', '.btnDeleteItem', function(e){
        e.preventDefault();
        var item_id = $(this).data('id')
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
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response){
                $('#modalAdd').modal('hide')
                Toast.fire({
                    icon: 'success',
                    title: response.success
                })
                refreshTable();
            },
            error: function(error){
                console.log(error)
            }
        })
    })

    $('body').on('click', '#btnUpdateItem', function(e){
        e.preventDefault();
        var user = $(this).data('id')
        var formData = {
            item_id: $('#item_id').val(),
            itemCode: $('#itemCode').val(),
            description: $('#editDescription').val(),
            unit: $('#editUnit').val(),
        }
        var url = '/updateItem/' + formData.item_id
        $.ajax({
            url: url,
            data: formData,
            method: 'PUT',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(res){
                $('#modalEdit').modal('hide')
                Toast.fire({
                    icon: 'success',
                    title: res.success
                })
                refreshTable();
            },
            error: function(err){
                console.log('failed')
            }
        })
    })


    $('body').on('click', '#btnInsertRequest', function(e){
        e.preventDefault();

        var formData = $('#addRequest').serialize();
        var url = '/insertRequest'


        // console.log(formData)
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
})