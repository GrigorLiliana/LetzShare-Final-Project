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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.liked').on('click', function(e) {
        event.preventDefault();
        console.log(this.id, 'No likey');
        let like = false;
        $.ajax({
            method: 'POST',
            url: '/like',
            data: { isLiked: like, photoId: this.id }
        }).done(function() {
            // Change the page

            $(this.id).addClass('not-liked');
            $(this.id).removeClass('liked');
        });
    });
    $('.not-liked').on('click', function(e) {
        event.preventDefault();
        console.log(this.id, 'Liked');
        let like = true;
        $.ajax({
            method: 'POST',
            url: '/like',
            data: { isLiked: like, photoId: this.id }
        }).done(function() {
            // Change the page
            $(this.id).addClass('liked');
            $(this.id).removeClass('not-liked');
        });
    });

    /* End of the Like-click listener */

    /* Upload file field --> show selected name */
    $('#foto').on('change', function() {
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
        $('.div-edit-name').removeClass('hide');
    });

    $('.cancel-edit').on('click', function() {
        $('.old-name').removeClass('hide');
        $('#editName').removeClass('hide');
        $('.div-edit-name').addClass('hide');
    });
    /*Ajax call to edit NAME profil*/
    $('.edit-name').on('submit', function(event) {
        event.preventDefault();
        let id = $('.user_id').val();
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
                    $('.div-edit-name').addClass('hide');
                    $('.older-name').text(result.name);
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
                $('.errors-profile').removeClass('hide');
                $('.errorMsg').text(
                    'An unexpected error has occurred! Please try again.'
                );
                setTimeout(function() {
                    $('.errors-profile').hide(500);
                }, 3500);
                // IF an Ajax error happens
            }
        }); /*end ajax call*/
    }); /*End of the Edit User Profile Name */

    /*Edit User Profile -> DESCRIPTION */

    $('.linkEditDescription').on('click', function() {
        $('.old-description').addClass('hide');
        $('.linkEditDescription').addClass('hide');
        $('.div-edit-description').removeClass('hide');
    });

    $('.cancel-edit').on('click', function() {
        $('.old-description').removeClass('hide');
        $('.linkEditDescription').removeClass('hide');
        $('.div-edit-description').addClass('hide');
    });

    /*Ajax call to edit description profil*/
    $('.edit-description').on('submit', function(event) {
        event.preventDefault();
        let id = $('.user_id').val();
        $.ajax({
            url: '/userprofile/description/' + id,
            type: 'post',
            data: $('form').serialize(),
            success: function(result) {
                console.log('ok');
                if (result.success) {
                    $('.success-profile').removeClass('hide');
                    $('.successMsg').text(result.success);
                    $('.old-description').removeClass('hide');
                    $('.linkEditDescription').removeClass('hide');
                    $('.div-edit-description').addClass('hide');
                    $('.older-description').text(result.description);
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
                console.log(err);
                $('.errors-profile').removeClass('hide');
                $('.errorMsg').text(
                    'An unexpected error has occurred! Please try again.'
                );
                setTimeout(function() {
                    $('.errors-profile').hide(500);
                }, 3500);
            }
        });
    }); /*end ajax call*/
    /*END of edit DESCRIPTION */

    /*Send msg to a user*/
    $('.send-msg-link').on('click', function() {
        $('.send-msg-card').removeClass('hide');
        $('.shadow-div').removeClass('hide');
    });

    $('.close-card').on('click', function() {
        $('.send-msg-card').addClass('hide');
        $('.shadow-div').addClass('hide');
    });

    /*Ajax call to send message*/
    $('.send-message-to').on('submit', function(event) {
        event.preventDefault();
        let id = $('#idToSend').val();
        $.ajax({
            url: '/sendmessage/' + id,
            type: 'post',
            data: $('form').serialize(),
            success: function(result) {
                if (result.success) {
                    $('.success-profile').removeClass('hide');
                    $('.success-profile').css({
                        position: 'absolute',
                        'z-index': '1'
                    });
                    $('.successMsg').text(result.success);
                    $('.send-msg-card').addClass('hide');
                    $('.shadow-div').addClass('hide');
                    setTimeout(function() {
                        $('.success-profile').hide(500);
                    }, 2000);
                    console.log(result.success);
                } else {
                    $('.errors-profile').removeClass('hide');
                    $('.errors-profile').css({
                        position: 'absolute',
                        'z-index': '1'
                    });
                    $.each(result.errors, function(key, value) {
                        $('.errorMsg').text(value);
                    });
                    setTimeout(function() {
                        $('.errors-profile').hide(500);
                    }, 3500);
                }
            },
            error: function(err) {
                console.log(err);
                $('.errors-profile').removeClass('hide');
                $('.errorMsg').text(
                    'An unexpected error has occurred! Please try again.'
                );
                setTimeout(function() {
                    $('.errors-profile').hide(500);
                }, 3500);
            }
        });
    }); /*end ajax call to send message*/
    /*end of send message to a user*/

    /*Ajax call to upload photo*/
    $('#uploadform').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            type: 'post',
            url: '/uploadphoto',
            data: new FormData($('#uploadform')[0]),
            processData: false,
            contentType: false,
            success: function(result) {
                if (result.success) {
                    $('.success-profile').removeClass('hide');
                    $('.success-profile').css({
                        position: 'absolute',
                        'z-index': '1'
                    });
                    $('.successMsg').text(result.success);

                    setTimeout(function() {
                        $('.success-profile').hide(500);
                    }, 2000);
                    console.log(result.success);
                } else {
                    console.log(result);
                    console.log(result.errors);
                    $('.errors-profile').removeClass('hide');
                    $('.errors-profile').css({
                        position: 'absolute',
                        'z-index': '1'
                    });
                    $.each(result.errors, function(key, value) {
                        $('.errorMsg').text(value);
                    });
                    setTimeout(function() {
                        $('.errors-profile').hide(500);
                    }, 3500);
                }
            },
            error: function(err) {
                $('.errors-profile').removeClass('hide');
                $('.errorMsg').text(
                    'An unexpected error has occurred! Please try again.'
                );
                setTimeout(function() {
                    $('.errors-profile').hide(500);
                }, 3500);
            }
        });
    }); /*end ajax call to upload photo*/
}); //LAST JQuery DO NOT DELETE
