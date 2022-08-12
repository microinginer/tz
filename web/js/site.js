var body = $('body');

body.on('click', '.favoriteButton', function () {
    var el = $(this);

    $.post('/books/is-favorite?id=' + el.data('id'), {}, function (response) {
        if (response.success) {
            el.removeClass('far')
            el.removeClass('fas')

            if (response.isFavorite) {
                el.addClass('fas')
            } else {
                el.addClass('far')
            }
        }
        console.log(response);
    });

    console.log(el.data('id'))
});