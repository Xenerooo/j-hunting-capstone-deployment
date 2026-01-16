function map() {
    var lat = 11.611829121983058;
    var lng = 125.43332654290204;

    var map = L.map("map").setView([lat, lng], 19);

    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
    }).addTo(map);

    L.marker([lat, lng])
        .addTo(map)
        .bindPopup("Borongan City, Eastern Samar")
        .openPopup();
}

$(function () {
    map();
});
