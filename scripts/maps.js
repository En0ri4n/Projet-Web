let mapOptions = {
    center:[51.5073219, -0.1276474],
    zoom:15
}

let map = new L.map('map', mapOptions);

let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
map.addLayer(layer);

let apiKey = "8b0b65847e964e828fb065d72b3a57b4";

const addressSearchControl = L.control.addressSearch(apiKey, {
    position:"topleft",
    placeholder:"Enter an address",
    resultCallBack : (address) => {
        if(!address){
            return;
        }
        L.marker([address.lat, address.lon]).addTo(map);
        map.setView([address.lat, address.lon], 17);
    }
});

map.addControl(addressSearchControl);

//api key geoapify 8b0b65847e964e828fb065d72b3a57b4