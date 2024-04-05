import { addEventTo } from "./main.js";

export let currentPage = [];
export let totalPages = [];

let onChangeFunctions = [];
let onWaitFunctions = [];

export function setTotalPages(index, total){
    totalPages[index] = total;
    checkButtons(index);
}


export function initPagination(index, onWait, onChange) {

    currentPage.push(1);
    totalPages.push(1);
    onChangeFunctions.push(onChange);
    onWaitFunctions.push(onWait);

    const firstPageElement = document.getElementById('pageDebut-' + index);
    const previousPageElement = document.getElementById('pagePrecedente-' + index);
    const nextPageElement = document.getElementById('pageSuivante-' + index);
    const lastPageElement = document.getElementById('pageFin-' + index);

    addEventTo(firstPageElement, 'click', () =>
    {
        onWaitFunctions[index]();
        currentPage[index] = 1;
        checkButtons(index);
        onChangeFunctions[index]();
    });
    addEventTo(previousPageElement, 'click', () =>
    {
        onWaitFunctions[index]();
        currentPage[index] = currentPage[index] > 1 ? currentPage[index] - 1 : currentPage[index]
        checkButtons(index);
        onChangeFunctions[index]();
    });

    addEventTo(nextPageElement, 'click', () =>
    {
        onWaitFunctions[index]();
        currentPage[index] = currentPage[index] < totalPages[index] ? currentPage[index] + 1 : currentPage[index];
        checkButtons(index);
        onChangeFunctions[index]();
    });
    addEventTo(lastPageElement, 'click', () =>
    {
        onWaitFunctions[index]();
        currentPage[index] = totalPages[index];
        checkButtons(index);
        onChangeFunctions[index]();
    });

    checkButtons(index);
}

function checkButtons(index)
{
    const firstPageElement = document.getElementById('pageDebut-' + index);
    const previousPageElement = document.getElementById('pagePrecedente-' + index);
    const currentPageElement = document.getElementById('pageActuelle-' + index);
    const nextPageElement = document.getElementById('pageSuivante-' + index);
    const lastPageElement = document.getElementById('pageFin-' + index);

    firstPageElement.disabled = currentPage[index] === 1;
    previousPageElement.disabled = currentPage[index] === 1;
    nextPageElement.disabled = currentPage[index] === totalPages[index];
    lastPageElement.disabled = currentPage[index] === totalPages[index];

    currentPageElement.innerHTML = (currentPage[index] <= 0 ? 0 : currentPage[index]) + ' / ' + totalPages[index];
}

export function reloadPagination()
{
    onChangeFunctions.forEach(f => f())
}