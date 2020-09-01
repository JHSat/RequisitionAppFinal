$(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".container1");
    var add_button = $(".add_form_field");

    var x = 0;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append(
                '<div class="d-flex my-2"><select class="form-control mx-1"><option>Select Item</option><option>...</option><option>...</option></select> <input type="number" name="mytext[]" placeholder="quantity" class="form-control"/><a href="#" class="delete btn btn-danger mx-2"> - </a></div>'
                ); //add input box

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