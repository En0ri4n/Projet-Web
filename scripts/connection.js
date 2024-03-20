import {addEventTo, sha256} from "./main.js";

addEventTo(document.getElementById('form'), 'submit', onSubmit);

async function onSubmit(e)
{
    e.preventDefault();
    const passwordField = document.getElementById('password');
    Promise.all(await sha256(passwordField.value)
        .then((hash) => document.getElementById('token').value = hash))
        .then(() => passwordField.disabled = true)
        .then(() => this.submit());
}