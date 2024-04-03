import { addEventTo, scrollToTop } from "./main.js";

export let currentPage = 1;
export let totalPages = 1;

let onChangeFunction = () => {};

export function setTotalPages(total){
    totalPages = total;
    checkButtons();
}


export function initPagination(onChange) {

    onChangeFunction = onChange;

    const firstPageElement = document.getElementById('pageDebut');
    const previousPageElement = document.getElementById('pagePrecedente');
    const nextPageElement = document.getElementById('pageSuivante');
    const lastPageElement = document.getElementById('pageFin');

    addEventTo(firstPageElement, 'click', () =>
    {
        currentPage = 1;
        checkButtons();
        onChange();
    });
    addEventTo(previousPageElement, 'click', () =>
    {
        currentPage = currentPage > 1 ? currentPage - 1 : currentPage
        checkButtons();
        onChange();
    });

    addEventTo(nextPageElement, 'click', () =>
    {
        currentPage = currentPage < totalPages ? currentPage + 1 : currentPage;
        checkButtons();
        onChange();
    });
    addEventTo(lastPageElement, 'click', () =>
    {
        currentPage = totalPages;
        checkButtons();
        onChange();
    });

    checkButtons();
}

function checkButtons()
{
    const firstPageElement = document.getElementById('pageDebut');
    const previousPageElement = document.getElementById('pagePrecedente');
    const currentPageElement = document.getElementById('pageActuelle');
    const nextPageElement = document.getElementById('pageSuivante');
    const lastPageElement = document.getElementById('pageFin');

    firstPageElement.disabled = currentPage === 1;
    previousPageElement.disabled = currentPage === 1;
    nextPageElement.disabled = currentPage === totalPages;
    lastPageElement.disabled = currentPage === totalPages;

    currentPageElement.innerHTML = currentPage + ' / ' + totalPages;

    scrollToTop();
}

export function reloadPagination()
{
    onChangeFunction();
}