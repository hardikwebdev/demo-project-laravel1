
$("#login-form").validate({
     rules: {
         email: {
            required: true,
            email: true
         },
         password: {
            required: true,
         }
     },
     messages:{
        total_capital: {
            required: 'Please Enter Email / Password.',
            email: 'Please enter valid email address'
        },
        description: {
            required: 'Please enter description',
            
        }
    }
});