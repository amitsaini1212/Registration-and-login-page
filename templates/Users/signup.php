<h1>Signup Form</h1>
<?php
   echo $this->Form->create(NULL, ['id' => 'form']); 
   echo $this->Form->control('name');
   echo $this->Form->control('Email');
   echo $this->Form->control('address');
   echo $this->Form->control('phoneNumber');
   echo $this->Form->control('password', ['id' => 'password']); 
   echo $this->Form->control('confirmpassword' , ['type' => 'password']);

   echo $this->Form->button('Signup');
   echo $this->Form->end();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

<script>
   // Validations
   $(document).ready(function () {
      $.validator.addMethod("alphabetsOnly", function (value, element) {
         return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
      });

      $.validator.addMethod("nowhitespace", function(value, element) {
         return this.optional(element) || /^[^\s]+$/i.test(value);
      });

      $('#form').validate({
         rules: {
            name: {
               required: true,
               alphabetsOnly: true
            },
            Email: { 
               required: true,
               email: true
            },
            password: {
               required: true,
               minlength: 8,
               nowhitespace: true
            },
            phoneNumber: { 
               required: true,
               digits: true 
            },
            address: {
               required: true,
            },
            confirmpassword: {
               required: true,
               equalTo: "#password"
            }
         },
         messages: {
            name: {
               required: 'Please enter Name.',
               alphabetsOnly: 'Only alphabets are allowed',
            },
            Email: { 
               required: 'Please enter Email.',
               email: 'Please enter a valid Email address'
            },
            password: {
               required: 'Please enter Password.',
               minlength: 'Password must be at least 8 characters long.',
               nowhitespace: 'Space is not allowed in the password.'
            },
            phoneNumber: { 
               required: 'Please enter Phone Number.',
               digits: 'Please enter only digits'
            },
            address: {
               required: 'Please enter Address.',
            },
            confirmpassword: {
               required: 'Please enter Confirm Password.',
               equalTo: 'Passwords do not match.',
               nowhitespace: 'Space is not allowed in the password.'
            }
         },
         submitHandler: function (form, event) {
            event.preventDefault();
            $.ajax({
               url: '<?= $this->Url->build(['controller' => 'Users', 'action' => 'signup']) ?>',
               type: 'post',
               data: $(form).serialize(),
               success: function(response) {
                  if(response === 'Signup successful') {
                     alert(response);
                     window.location.href = '<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>';
                  } else {
                     alert(response);
                  }
               },
               error: function(error) {
                  alert("User already exists! Please try again.");
               }
            });
         }
      });
   });
</script>
