$(document).on('click', '.no-pulse', function () {
    // Entferne die Klasse "pulse" von allen Elementen
    $(".pulse").removeClass("pulse").addClass("no-pulse");

    // Füge die Klasse "pulse" wieder dem geklickten Element hinzu
    $(this).removeClass("no-pulse").addClass("pulse");
});

$('.listItems.deletable').on('click', function () {
    $('body').addClass("modal-open");
});

$(document).on('click', '#deleteTask', function () {
    $('body').addClass("modal-open");
});

$(document).on('click', '.message', function () {
    setTimeout(function () {
        $("#successMessage").delay(1500).fadeOut(800);
    }, 500);

});

$(document).on('click', '.modalClose', function () {
    $('body').removeClass("modal-open");
});

