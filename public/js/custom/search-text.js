function flashMotto() {
    const mottoList = [
        "J-Hunting, where skills meet success.",
        "Made for dreamers, built for doers.",
        "Find the job that fits you best",
        "Your future starts with one search",
        "You’ve got talent? Let’s find where it shines.",
        "Start fresh. Dream big. Apply now.",
    ];

    const flastText = $("#motto");
    let index = 0;

    setTimeout(() => {
        flastText.fadeOut(300, function () {
            $(this).text(mottoList[index]).fadeIn(1000);
        });
        index = (index + 1) % mottoList.length;
    }, 5000);
}

$(function () {
    flashMotto();
});
