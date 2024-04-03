/*set map*/
getCoordinates();
function getCoordinates(){
    url = new URL(window.location.href);
    let id = url.searchParams.get("entrepriseId");

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
                JSON.stringify(latitude);
                JSON.stringify(longitude); 
                viewMap(latitude, longitude);

                }) 
            })
    })});
}

function viewMap(latt, longg){
    var map = L.map('map');
    map.setView([latt, longg], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    let marker;
    marker = L.marker([latt, longg]).addTo(map);
}