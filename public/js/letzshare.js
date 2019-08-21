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

    /* Start of the Like-click listener */

    $('.liked').on('click', function(e) {
        event.preventDefault();
        console.log(this.id, 'No likey');
        let like = false;
        $.ajax({
            method: 'POST',
            url: urlLike,
            data: { isLiked: like, photoId: this.id, _token: token }
        }).done(function() {
            // Change the page
        });
    });
    $('.not-liked').on('click', function(e) {
        event.preventDefault();
        console.log(this.id, 'Liked');
        let like = true;
        $.ajax({
            method: 'POST',
            url: urlLike,
            data: { isLiked: like, photoId: this.id, _token: token }
        }).done(function() {
            // Change the page
        });
    });

    /* End of the Like-click listener */

    /* Upload file field --> show selected name */
    $('#customFile').on('change', function() {
        //replace the "Choose a file" label
        var newFileName = $(this)[0].files[0].name;
        $(this)
            .next('.custom-file-label')
            .html(newFileName);
    });
    /* END of Upload file field --> show selected name */

    /*Edit User Profile Name */
    $('#editName').on('click', function() {
        $('.old-name').addClass('hide');
        $('#editName').addClass('hide');
        $('div.div-form-profile').removeClass('hide');
    });

    $('.cancel-edit').on('click', function() {
        $('.old-name').removeClass('hide');
        $('#editName').removeClass('hide');
        $('div.div-form-profile').addClass('hide');
    });
    /*Ajax call to edit profil*/
    $('.form-profile').on('submit', function(event) {
        event.preventDefault();
        let id = $('#user_id').val();
        $.ajax({
            url: '/userprofile/' + id,
            type: 'post',
            data: $('form').serialize(),
            success: function(result) {
                if (result.success) {
                    $('.success-profile').removeClass('hide');
                    $('.successMsg').text(result.success);
                    $('.old-name').removeClass('hide');
                    $('#editName').removeClass('hide');
                    $('div.div-form-profile').addClass('hide');
                    $('.old').text(result.name);
                    $('.nav-name').text(result.name);
                    setTimeout(function() {
                        $('.success-profile').hide(500);
                    }, 2000);
                } else {
                    $('.errors-profile').removeClass('hide');
                    $.each(result.errors, function(key, value) {
                        $('.errorMsg').text(value);
                    });
                    setTimeout(function() {
                        $('.errors-profile').hide(500);
                    }, 3500);
                }
            },
            error: function(err) {
                // IF an Ajax error happens
            }
        }); /*end ajax call*/
    }); /*End of the Edit User Profile Name */
}); //LAST JQuery DO NOT DELETE
