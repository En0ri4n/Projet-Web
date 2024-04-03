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
        console.log(entreprises)
        let num = entreprises['adresses'][0]['Numero'];
        let rue = entreprises['adresses'][0]['Rue'];
        let ville = entreprises['adresses'][0]['Ville'];
        let cp = entreprises['adresses'][0]['CodePostal'];
        let pays = entreprises['adresses'][0]['Pays'];
        fetch('https://api.geoapify.com/v1/geocode/search?housenumber='+num+'&street='+rue+'&postcode='+cp+'&city='+ville+'&country='+pays+'&apiKey=8b0b65847e964e828fb065d72b3a57b4', {
            method: 'GET', headers: {
                'Content-Type': 'application/json'
            }
        }).then(resp => resp.json()).then( (data2)=>
{
    console.log(data2)
    data2['features'].forEach(features =>{
        console.log(features)
        let latitude = features['properties']['lat'];
        let longitude = features['properties']['lon'];
        
    })
})
})});


/*https://api.geoapify.com/v1/geocode/search?housenumber='+num+'&street=Rue%20'+rue+'&postcode='+cp+'city='+ville+'&country='+pays+'&apiKey=8b0b65847e964e828fb065d72b3a57b4*/
/*https://api.geoapify.com/v1/geocode/search?text=38%20Upper%20Montagu%20Street%2C%20Westminster%20W1H%201LJ%2C%20United%20Kingdom&apiKey=8b0b65847e964e828fb065d72b3a57b4*/

/*features['properties']['lon']
features['properties']['lat']

/*https://api.geoapify.com/v1/geocode/search?housenumber=11&street=Rue%20Grenette&postcode=69002&city=Lyon&country=France&apiKey=YOUR_API_KEY*/



/*fetch(`https://api.geoapify.com/v1/geocode/search?text=${encodeURIComponent(address)}&apiKey=8b0b65847e964e828fb065d72b3a57b4`)
.then(resp => resp.json())
.then((geocodingResult) => {
	console.log(geocodingResult);
});

/*addressurl = "https://api.geoapify.com/v1/geocode/search?housenumber=11&street=Rue%20Grenette&postcode=69002&city=Lyon&country=France&apiKey=8b0b65847e964e828fb065d72b3a57b4";

navigator.geolocation.watchPosition(success, error);*/

/*let marker;

marker = L.marker([lat, lon]).addTo(map);
map.setView([address.lat, address.lon], 17);*/