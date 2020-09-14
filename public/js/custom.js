

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
        $.get('/userDetails/' + user, function(res){
            $('#id').text(res.user.id);
            $('#name').text(res.user.name);
            $('#email').text(res.user.email);
            $('#department').text(res.dept.department_name);
            // console.log(res.user.id);
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
                $('#formAddItem').trigger('reset')
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


    // $('body').on('click', '#btnInsertRequest', function(e){
    //     e.preventDefault();

    //     var formData = $('#addRequest').serializeArray();
    //     var url = '/insertRequest'


    //     console.log(formData)
    //     $.ajax({
    //         url: url,
    //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //         method: 'POST',
    //         data: formData,
    //         success: function(res){
    //             Toast.fire({
    //                 icon: 'success',
    //                 title: res.success
    //             })
    //             setTimeout (function(){
    //                 window.location.href = "/userdashboard";
    //             }, 2500)
    //         },
    //         error: function(err){
    //             console.log(err)
    //         }
    //     })
    // })




    $('#btnAddUser').click(function(e){
        e.preventDefault();
        var formData = $('#addUserForm').serializeArray();
        if(emPosition.value == "" || department.value == "" || name.value == ""){
            alert('Please populate form fields')
        }
    
        else{
            console.log(email.value)
            $.ajax({
                type: 'POST',
                url: '/addUser',
                data: formData,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(res){
                    $('#addUserModal').modal('hide')
                    Toast.fire({
                        icon: 'success',
                        title: res.success
                    })
                    refreshTable();
                },
                error: function(res){
                    Toast.fire({
                        icon: 'error',
                        title: res.error
                    })
                }
            })
        }
    })

    $('body').on('click', '#btnUpdateDept', function(e){
        e.preventDefault();

        var formData = {
            dept: $('#dept').val(),
            id: $('#user_id').val()
        }

        if (formData.dept == "") {
            alert('Please select a department!')
        } else {
            $.ajax({
                url: '/updateDeptUser/' + formData.id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'PUT',
                data: formData,
                success: function(res){
                    Toast.fire({
                        icon: 'success',
                        title: res.success
                    })
                    setTimeout (function(){
                        location.reload();
                    }, 2000)
                },
                error: function(){
                    Toast.fire({
                        icon: 'error',
                        title: res.error
                    })  
                }
            }) 
        }
        
    })

    $('#btnDeleteRequest').click(function(e){
        e.preventDefault();

        var request = $(this).data('id')
        // confirmDelete();
        // console.log(request)
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: '/deleteRequest/' + request,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'DELETE',
                    data: { request_id: request},
                    success: function(res){
                        Toast.fire({
                            icon: 'success',
                            title: res.success
                        })
                        setTimeout(function(){
                            window.location = '/userdashboard'
                        }, 2000) 
                    },
                    error: function(err){
                        console.log(err)
                    }
                })
            }
        })

    })


    $('body').on('click', '.btnRemoveItem', function(e){
        e.preventDefault();
        var item_id = $(this).data('id')
        var transac_code = $('#transac_code').val()
        // var formData = $('#formRemoveItem').serializeArray();
        // console.log(item_id, transac_code)
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/removeItem',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: 'DELETE',
                    data: {
                        transac_code: transac_code,
                        item_id: item_id
                    }, 
                    success: function(res){
                        Toast.fire({
                            icon: 'success',
                            title: res.success
                        })
                        refreshTable()
                        // console.log(res)
                    },
                    error: function(err){   
                        console.log(err)
                    }
                })
            }
        })
    })

    $('body').on('click', '#btnAddEditItem', function(e){
        e.preventDefault()

        var formData = $('#editItemForm').serializeArray()
        console.log('clicked!', formData)

        $.ajax({
            url: '/updateRequestItem',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'POST',
            data: formData,
            success: function(res){
                $('#editItemForm').trigger('reset')
                Toast.fire({
                    icon: 'success',
                    title: res.success
                })
                refreshTable()
            },
            error: function(err){
                console.log(err)
            }
        })
    })


    $('body').on('click', '.btnAuthorize', function(e){
        var req_id = $(this).data('id');

        // console.log(req_id)

        Swal.fire({
            title: 'Authorize this request?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, authorize it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/authorizeRequest/' + req_id,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: 'PUT', 
                    success: function(res){
                        Toast.fire({
                            icon: 'success',
                            title: res.success
                        })
                        $('#authorizedBy').text(res.authorizedBy)
                        $('#authDate').text(res.authDate)
                        setTimeout(function(){
                            location.reload()
                        }, 2000)
                    },
                    error: function(err){   
                        console.log(err)
                    }
                })
            }
        })
    })

    $('body').on('click', '#confirmRequest', function(e){
        e.preventDefault();

        var req_id = $(this).data('id')

        console.log(req_id)
        
        Swal.fire({
            title: 'Confirm this request?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, authorize it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/confirmRequest/' + req_id,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: 'PUT',
                    success: function(res){
                        Toast.fire({
                            icon: 'success',
                            title: res.success
                        })
                        $('#confirmedBy').text(res.confirmedBy)
                        $('#confirmedDate').text(res.confirmedDate)
                        $('#processedDate').text(res.processedDate)
                        setTimeout(function(){
                            location.reload()
                        }, 2000)
                    },
                    error: function(err){

                    }
                })
            }
        })
    })
})