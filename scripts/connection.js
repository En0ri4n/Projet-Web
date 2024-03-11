import { addEventTo, sha256 } from "./main.js";

addEventTo(document.getElementById('submit'), 'click', async(evt) =>
{
    evt.preventDefault();

    const username = document.getElementById('identifiant').value;
    const password = document.getElementById('password').value;

    const hash = await sha256(password);

    const json = JSON.stringify({'username': username, 'password': hash});

    fetch('http://localhost/api/connection.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: json
    }).then(res => processResponse(res))
});

async function processResponse(response)
{
    const responseJson = await response.json();

    if(responseJson['authorized'])
    {
        window.location.href = responseJson['redirect'];
    }
    else
    {
        alert(responseJson['message']);
    }
}