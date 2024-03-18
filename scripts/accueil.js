import { addEventTo } from "./main.js";

let current_page = 1;
let total_pages = 2;
let per_page = 3;
let page_count = 0;

addEventTo(document, "DOMContentLoaded", onReady);

function onReady()
{
	per_page = 10; // document.getElementById("per_page").value;
	
	const xhr = new XMLHttpRequest();
	// Ajoute un paramètre à la requête
	xhr.open("GET", `https://reqres.in/api/users?page=${current_page}&per_page=${per_page}`, true);
	xhr.onload = function ()
	{
		let html = "";
		if (xhr.status === 200)
		{
			const data = JSON.parse(xhr.responseText);
			for (let i = 0; i < data["data"].length; i++)
			{
				html += `<div class="offre">`
				html += 	`<img src="${data["data"][i]["avatar"]}" alt="Entreprise">`
				html += 	`<article>`
				html += 		`<div class="c1">`
				html += 			`<span class="poste">${data["data"][i]["first_name"]}</span>`
				html += 			`<span class="entreprise">${data["data"][i]["last_name"]}</span>`
				html += 			`<span class="niveau">${data["data"][i]["id"]}</span>`
				html += 		`</div>`
				html += 		`<div class="c2">`
				html += 			`<span class="domaine">${data.data[i]["email"]}</span>`
				html += 			`<span class="dates">Dates</span>`
				html += 		`</div>`
				html += 		`<div class="c3">`
				html += 		`</div>`
				html += 		`<div class="list-competences">`
				html += 			`<ul class="competences">Compétences :`
				html += 				`<li>competence 1</li>`
				html += 				`<li>competence 2</li>`
				html += 			`</ul>`
				html += 		`</div>`
				html += 	`</article>`
				html += `</div>`
			}
			
			total_pages = data["total_pages"];
			page_count = data["total"];
			
			// document.getElementById("pages").innerHTML = `${data["page"]} / ${total_pages}`;
		}
		
		document.getElementsByClassName("liste-offres")[0].innerHTML = html;
		// document.getElementById("get_result").innerHTML = html;
	};
	xhr.send(); //Envoi de la requête au serveur (asynchrone par défaut)
}