$(document).ready(function () {
    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });
    var form = $("#form");
    form.validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            mobile: {
                required: true,
                digits: true,
                rangelength: [10, 14]
            },
            message: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please Enter Name"
            },
            email: {
                required: "Please Enter email"
            },
            mobile: {
                required: "Please Enter Mobile",
                rangelength: "Please enter Valid Number"
            },
            message: {
                required: "Please Enter Requirement"
            }
        }
    });

    function mailer() {
        alert(form.form());
        alert(form.validate());
    }
    $('#sbmt').click(function () {
        if (form.valid()) {
            $.ajax({
                type: 'POST',
                url: 'mailer.php',
                dataType: "json",
                data: {
                    name: $("#name").val(),
                    email: $("#email").val(),
                    mobile: $("#mobile").val(),
                    message: $("#message").val()
                },
                success: function (result) {
                   if(result.success){
                       
                        alertify.success('INQUIRY Success. Mail Sent'); 
form.trigger('reset');

                   }

                },
                error: function (xhr, status, error) {
                    alert(xhr + "--" + status + "--" + error);
                    console.log(xhr);
                }
            });
        }
    });
});
