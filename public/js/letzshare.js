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

    $('.liked').on('click', function (e) {
        event.preventDefault();
        console.log(this.id, "No likey");
        let like=0;
        $.ajax({
            method:'POST',
            url: urlLike,
            data: {isLiked: like, photoId: this.id, _token: token}
        })
        .done(function() {
            // Change the page
        })
    });
    $('.not-liked').on('click', function (e) {
        event.preventDefault();
        console.log(this.id, "Liked");
        let like=1;
        $.ajax({
            method: 'POST',
            url: urlLike,
            data: {isLiked: like, photoId: this.id, _token: token}
        })
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
    $('#editName').on('click', function(event) {
        event.preventDefault();
        $('.old-name').addClass('hide');
        $('#editName').addClass('hide');
        $('input.hide').removeClass('hide');
    });

    /*End of the Edit User Profile Name */

}); //LAST DO NOT DELETE
