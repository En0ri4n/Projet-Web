/*set map*/
var map = L.map('map');
    map.setView([51.505, -0.09], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

/*geoapify api key*/
let apiKey = "8b0b65847e964e828fb065d72b3a57b4";

/*get id from url*/
url = new URL(window.location.href);
let id = url.searchParams.get("entrepriseId");

/**/
fetch('/api/entreprises?IdEntreprise=' +id, { // TODO: mettre à jour tout ça bien
    method: 'GET', headers: {
        'Content-Type': 'application/json'
    }
}).then(response => response.json()).then( (data) =>
{
    console.log(data)
    data['entreprises'].forEach(entreprises =>{
        let num = entreprises['adresses']['Numero'];
        let rue = entreprises['adresses']['Rue'];
        let ville = entreprises['adresses']['Ville'];
        let cp = entreprises['adresses']['CodePostal'];
        let pays = entreprises['adresses']['Pays'];
        alert(num);

    })});




/*const address = 'Baldersgade 3B, 2200 Copenhagen, Denmark';




fetch(`https://api.geoapify.com/v1/geocode/search?text=${encodeURIComponent(address)}&apiKey=8b0b65847e964e828fb065d72b3a57b4`)
.then(resp => resp.json())
.then((geocodingResult) => {
	console.log(geocodingResult);
});

/*addressurl = "https://api.geoapify.com/v1/geocode/search?housenumber=11&street=Rue%20Grenette&postcode=69002&city=Lyon&country=France&apiKey=8b0b65847e964e828fb065d72b3a57b4";

navigator.geolocation.watchPosition(success, error);*/

/*let marker;

marker = L.marker([lat, lon]).addTo(map);
map.setView([address.lat, address.lon], 17);*/