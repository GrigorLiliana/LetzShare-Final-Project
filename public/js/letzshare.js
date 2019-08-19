console.log('letzshare.js loaded successfull!');
$(function() {
    /* Registration password validation*/

    $('#password').on('focus', function() {
        $('#pswd_info').css('display', 'block');
    });
    $('#password').on('blur', function() {
        $('#pswd_info').css('display', 'none');
    });

    $('#password').on('keyup', checkAllCases);
    function checkAllCases() {
        // Gathering : checked the password value
        const thePass = $('#password').val();
        const lengthValid = thePass.length >= 8;
        // at least one letter str.match(/[A-z]/)
        const letterValid = !!thePass.match(/[A-z]/);
        // at least one Capital letter str.match(/[A-Z]/)
        const upperValid = thePass.match(/[A-Z]/); //null or smth
        // at least one number str.match(/\d/)
        const numberValid = thePass.match(/\d/);
        //display *4
        displayValid('#letter', letterValid);
        displayValid('#length', lengthValid);
        displayValid('#capital', upperValid);
        displayValid('#number', numberValid);
    }

    function displayValid(selector, condition) {
        if (condition) {
            $(selector)
                .addClass('valid')
                .removeClass('invalid');
        } else {
            $(selector)
                .addClass('invalid')
                .removeClass('valid');
        }
    }
    /* End of the Registration password validation*/
    //*Ajax call to upload photo

    $('#uploadform').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '/uploadphoto',
            type: 'post',
            data: $('#uploadform').serialize(),
            success: function(result) {
                if (result.success) {
                    $('#my-div').html(
                        '<p style="color:green">' + result.success + '<p>'
                    );
                } else {
                    $('#resultForm').html('');
                    $.each(result.errors, function(key, value) {
                        $('#my-div').append(
                            '<p style="color:red">' + value + '<p>'
                        );
                    });
                }
            },
            error: function(err) {
                // IF an Ajax error happens
            }
        });
    });
    //*end ajax call upload photo
}); //LAST DO NOT DELETE
