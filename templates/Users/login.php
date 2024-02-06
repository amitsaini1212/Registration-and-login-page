<h1>Login</h1>
<?php
   echo $this->Form->create(NULL, ['id' => 'form']);  
   echo $this->Form->control('Email');
   echo $this->Form->control('password');
   echo $this->Form->button('Login');
   echo $this->Form->end();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
</head>
<body>
</body>
</html>
<script>
$(document).ready(function() {
        $.validator.addMethod("alphabetsOnly", function (value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
        });
        $.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
        });
 
        $('#form').validate({
            rules: {
                Email: { 
               required: true,
               email: true
            },
                password: {
                    required: true,
                    minlength: 8
                },
            },
            messages: {
                Email: { 
               required: 'Please enter Email.',
               email: 'Please enter a valid Email address'
            },
                password: {
                    required: 'Please enter Password.',
                    minlength: 'Password must be at least 8 characters long.',
                },
            },

        submitHandler: function(form) {
            $.ajax({
                url: '<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>',
                type: 'post',
                data: $(form).serialize(),
                success: function(response) {
                    if (response == 'Login Success')
                    {
                        alert(response);
                        window.location.href='<?=$this->Url->build(['controller'=>'Users','action'=>'dashboard']);?>';
                    }
                    else{
                        alert(response);

                    }
                },
                error: function(error) {
                    alert("first Login!");
                }
            });
        }
    });
});
 
</script>