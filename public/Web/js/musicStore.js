$(document).ready(function () {

    function loadSlider() {

        /*========== 1) Events ===========*/

        $('#pause').on('click', pausePics);
        $('#play').on('click', playPics);
        $('#before').on('click', beforePics);
        $('#next').on('click', nextPics);

        /*========== 2) Variables =========*/

        var tabImg = [
            'music',
            'music1',
            'music2'
        ];
        var i = 0;
        var slider,
            action,
            click,
            timer,
            second,
            count;

        /*========== 3) Functions ===========*/

        function startSlider() {
            slider = '';
            slider = setInterval(setSlider, 5000);
            return action = 0;
        }

        function setSlider() {
            i++;
            if (action === 1) {
                return clearInterval(slider);
            }

            if (i == 3) {
                i = 0;
            }
            changePics();
        }

        function pauseClick(button) {
            var enableButton = function () {
                $('#before-disabled').prop(
                    "disabled", false
                ).attr(
                    'id', 'before'
                );
                $('#next-disabled').prop(
                    "disabled", false
                ).attr(
                    'id', 'next'
                );
            }

            $(button).click(function () {
                $('#before').prop(
                    'disabled', true
                ).attr(
                    'id', 'before-disabled'
                );
                $('#next').prop(
                    "disabled", true
                ).attr(
                    'id', 'next-disabled'
                );
                setTimeout(function () { enableButton() }, 3000);
            });
        }

        function beforePics() {

            changePics();
            pauseClick(this);
            clearInterval(slider);

            i--;
            if (i < 0) {
                i = 2;
            }

            $('#pause').hide();
            $('#play').show();
            return action = 1;

        }

        function nextPics() {

            changePics();
            pauseClick(this);
            clearInterval(slider);

            i++;
            if (i > 2) {
                i = 0;
            }
            $('#pause').hide();
            $('#play').show();
            return action = 1;

        }

        function pausePics() {

            clearInterval(slider);
            $(this).hide();
            $('#play').show();
            return action = 1;

        }

        function playPics() {

            startSlider();
            $(this).hide();
            $('#pause').show();
            return action = 0;

        }

        function changePics() {

            $('#component-slider').css({
                'background-image': 'url(\'Web/img/slider/' + tabImg[i] + '.png\')',
                'transition': 'background-image 2s'
            });

        }

        /*========== 3) Start the program ===========*/

        startSlider();
    }

    /*============ Start the slider ===========*/

    loadSlider();

    $('#ajax-album-show').on('click', sendDataForAlbum);

    function sendDataForAlbum() {

        showInfo();
        eraseData();

        $.ajax({
            url: './albumsJSON',
            type: 'post',
            success: function (data) {

                for (i in data) {

                    var image = data[i].imageName;
                    var name = data[i].name;

                    $('#show-info').append(
                        '<div class="col-md-3 intro ajax">'
                        + '<img src="Web/img/albums/' + image + '" alt="' + name + '">'
                        + '</div>'
                    );
                }
                $('#ajax-album-show').hide();
                $('#ajax-album-hide').show();
            }
        });
    }

    $('#ajax-album-hide').on('click', hideDataForAlbum);

    function hideDataForAlbum() {

        $('#show-info').slideUp(1000)
            .find('.ajax')
            .remove('');

        $('#ajax-album-hide').hide();
        $('#ajax-album-show').show();
    }

    $('#ajax-artist-show').on('click', sendDataArtist);

    function sendDataArtist() {

        showInfo();
        eraseData();

        $.ajax({
            url: './artistsJSON',
            type: 'post',
            success: function (data) {

                for (i in data) {

                    var artist = data[i].name;

                    $('#show-info').append(
                        '<div class="col-md-3 intro ajax">'
                        + '<p class="text-primary"><b>' + artist + '</b></p>'
                        + '</div>'
                    );
                }
                $('#ajax-artist-show').hide();
                $('#ajax-artist-hide').show();
            }
        });
    }

    $('#ajax-artist-hide').on('click', hideDataForArtist);

    function hideDataForArtist() {

        $('#show-info').slideUp(1000)
            .find('.ajax')
            .remove();

        hideInfo()

        $('#ajax-style-hide').hide();
        $('#ajax-style-show').show();
    }

    $('#ajax-style-show').on('click', sendDataStyle);

    function sendDataStyle() {

        showInfo();
        eraseData();

        $.ajax({
            url: './stylesJSON',
            type: 'post',
            success: function (data) {
                
                for (i in data) {

                    var style = data[i].name;

                    $('#show-info').append(
                        '<div class="col-md-3 intro ajax">'
                        + '<p class="text-primary"><b>' + style + '</b></p>'
                        + '</div>'
                    );
                }
                $('#ajax-style-show').hide();
                $('#ajax-style-hide').show();
            }
        });
    }

    $('#ajax-style-hide').on('click', hideDataForStyle);

    function hideDataForStyle() {

        $('#show-info').slideUp(1000)
            .find('.ajax')
            .remove();

        hideInfo()

        $('#ajax-style-hide').hide();
        $('#ajax-style-show').show();
    }

    $('#press-connect').on('click', showForm);
    $('#canceld-connect').on('click', hideForm);

    function hideForm() {

        $('#canceld-connect').hide();
        $('#press-connect').show();
        $('#form-connect').css({
            'display': 'none'
        });

        $('#slider-accessories').show();
    }

    function showForm() {

        $('#press-connect').hide();
        $('#canceld-connect').show();
        $('#form-connect').css({
            'display': 'block'
        });
        $('#slider-accessories').hide();

        $('#send-log-pass').on('click', checkInputs);

        function checkInputs() {

            var login = $('#login').val();
            var pass = $('#password').val();

            if (login == '') {
                $('label[for="login"]').html('You may type your login');
            }
            else if (pass == '') {
                $('label[for="password"]').html('You may type your password');
            }
            else {
                return $('#send-data').trigger('click', true);
            }
        }
    }

    function showInfo() {
        $('#show-info').slideDown(1000);
    }

    function hideInfo() {
        $('#show-info').slideUp(1000);
    }

    function eraseData() {

        $('#show-info')
            .css({ 'heigth': '100%' })
            .find('.ajax')
            .remove();

        $('#ajax-album-hide').hide();
        $('#ajax-style-hide').hide();
        $('#ajax-artist-hide').hide();
        $('#ajax-album-show').show();
        $('#ajax-style-show').show();
        $('#ajax-artist-show').show();
    }

    $('#send-comment').on('click', sendComment);

    function sendComment() {
        var comment = $('#comment').val();
        var idAlbum = $('#id-album').val();
        var idUser = $('#id-user').val();
        var date = $('#date-comment').val();
        var i;

        $.ajax({
            url : '/sendComment',
            type : 'post',
            data : {
                data : JSON.stringify({
                    comment : comment,
                    album : idAlbum,
                    user : idUser,
                    date : date
                })
            },
            success : function(data) {
                
                if (data == false) {
                    return alert('There were a mistake');
                } 

                $('.show-comment').html('');

                for(i in data) {
                    var name = data[i].name,
                        firstname = data[i].first_name,
                        date  = data[i].date,
                        content = data[i].content;
                    
                    $('.show-comment').append(
                          '<div class="container comment">'
                            + '<div class="col-md-12">'
                                + '<p class="text-primary">commment posted by ' + firstname + ' ' + name + ' at the date of : ' + date + ' </p>'
                                + '<textarea name="comment" id="comment" class="form-control" readonly="true">' + content + '</textarea>'
                            + '</div>'
                        + '</div>'
                    );
                }
                return;
            }
        });
    }

    /*function showComment() {
        $.ajax({
            url : '/commentJSON',
            type : 'post',
            success : function($data){
                var i;

                for(i in data) {
                    $('.show-comment').append(
                        
                    )
                }
            }
        })
    }*/
});

