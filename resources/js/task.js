$(document).ready(function () {
    const slider = $("#slider");
    const percentageDisplay = $("#percentageDisplay");

    slider.on("input", function () {
        const sliderValue = slider.val();
        percentageDisplay.text(sliderValue + "%");
    });
});
