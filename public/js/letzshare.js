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
        console.log(urlLike);
        let like = false;
        $.ajax({
            method: 'POST',
            url: urlLike,
            data: { isLiked: like, photoId: this.id }
        }).done(function() {
            // Change the page
            $(e.target).addClass("not-liked");
            $(e.target).removeClass("liked"); 
        });
    });
    $('.not-liked').on('click', function(e) {
        event.preventDefault();
        console.log(this.id, 'Liked');
        let like = true;
        $.ajax({
            method: 'POST',
            url: urlLike,
            data: { isLiked: like, photoId: this.id }
        }).done(function() {
            // Change the page
            $(e.target).addClass("liked");
            $(e.target).removeClass("not-liked"); 
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
                $('.errorMsg').text('Ple');
                setTimeout(function() {
                    $('.errors-profile').hide(500);
                }, 3500);
            }
        });
    }); /*end ajax call*/
    /*END of edit DESCRIPTION */

}); //LAST JQuery DO NOT DELETE
