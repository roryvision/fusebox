// client-side validation, more user friendly

const validation = new JustValidate("#signup");
//adds validation notes (in red saying "the feild is required"
//or warning when something being typed in is invalid
validation
    .addField("#fname", [
        {
            rule: "required"
        }
    ])

    .addField("#lname", [
        {
            rule: "required"
        }
    ])
    //make sure email is available and not already associated with an account
    .addField("#email", [
        {
            rule: "required"
        },
        {
            rule: "email"
        },
        { //custom validator, promise object
            validator: (value) => () => {
                //we just need value of field from url
                return fetch("validate-email.php?email=" + encodeURIComponent(value))
                    .then(function(response) {
                        return response.json();
                    })
                    //returns value of available object
                    .then(function(json) {
                        return json.available;
                    });
            },
            errorMessage: "email already taken"
        }
    ])
    //must contain characters, numbers etc
    .addField("#password", [
        {
            rule: "required"
        },
        {
            rule: "password"
        }
    ])
    //custom validation rule to make sure passwords match each other
    .addField("#password_confirmation", [
        {
            validator: (value, fields) => {
                return value === fields["#password"].elem.value;
            },
            errorMessage: "Passwords should match"
        }
    ])
    .onSuccess((event) => {
        document.getElementById("signup").submit();
    });












