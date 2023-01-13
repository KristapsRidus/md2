
"use strict";

// define variable that will hold content DOM element
let root = null;



// functions that load data, set up page content, handle user actions

// setup index page
function setupIndex() {

    placeLoader();

    // load JSON data
    fetch('http://localhost/data/get-top-albums')
        .then(
            response => response.json()
        )
        .then(books => {
            // on success remove spinner and render index page
            removeLoader();
            renderIndex(album);
        })
        .then(function(){
            // setup link handling
            setupLinks();
        })
    ;
}

// setup single book page
function setupSingle(id) {

    placeLoader();

    // load JSON data
    fetch('http://localhost/data/get-album/' + id)
        .then(
            response => response.json()
        )
        .then(book => {
            // on success remove spinner and render book page
            removeLoader();
            renderSingle(album);
        })
        .then(function(){
            // load related books
            fetch('http://localhost/data/get-related-albums/' + id)
                .then(
                    response => response.json()
                )
                .then(books => {
                    // render related books links
                    renderRelated(albums);
                })
                .then(function(){
                    // setup link handling
                    setupLinks();
                })
            ;
        })
    ;
}

// render index page content
function renderIndex(albums) {

    let i = 0;
    for (const album of albums) {
        i++;

        // create row
        let row = document.createElement('div');
        row.classList = 'row mb-5 pt-5 pb-5 bg-light';

        // create info div
        let info = document.createElement('div');
        info.classList = 'col-md-6 mt-2 px-5 ' + (i % 2 == 0 ? 'text-end order-1' : 'text-start order-2');

        // create info items
            // title
            let title = document.createElement('p');
            title.classList = 'display-4';
            title.textContent = album.name;
            info.appendChild(title);

            // description
            if (album.description.length > 0) {
                let lead = document.createElement('p');
                lead.classList = 'lead';
                lead.textContent = (book.description.split(' ').slice(0, 32).join(' ')) + '...';
                info.appendChild(lead);
            }

            // "See more" button
            let btn = document.createElement('a');
            btn.classList = 'btn btn-success see-more ' + (i % 2 == 0 ? 'float-right' : 'float-left');
            btn.textContent = 'Apskatؤ«t';
            btn.href = '#';
            btn.dataset.albumId = album.id;
            info.appendChild(btn);

        // add info div to row
        row.appendChild(info);

        // create image div
        let image = document.createElement('div');
        image.classList = 'col-md-6 text-center ' + (i % 2 == 0 ? 'order-2' : 'order-1');

            // create image
            let img = document.createElement('img');
            img.classList = 'img-fluid img-thumbnail rounded-lg w-50';
            img.alt = album.name;
            img.src = album.image;
            image.appendChild(img);

            // add image div to row
            row.appendChild(image);

        // add row to document
        root.appendChild(row);
    }
}

// render main panel of single book page
function renderSingle(book) {

    // create row
    let row = document.createElement('div');
    row.classList = 'row mb-5';

    // create info div
    let info = document.createElement('div');
    info.classList = 'col-md-6 pt-5';

    // create info items
        // title
        let title = document.createElement('h1');
        title.classList = 'display-3';
        title.textContent = album.name;
        info.appendChild(title);

        // full description
        if (book.description.length > 0) {
            let lead = document.createElement('p');
            lead.classList = 'lead';
            lead.textContent = album.description;
            info.appendChild(lead);
        }

        // data
        let dl = document.createElement('dl');
        dl.classList = 'row';

            // year
            let yearLabel = document.createElement('dt');
            yearLabel.classList = 'col-sm-3';
            yearLabel.textContent = 'Gads';
            dl.appendChild(yearLabel);

            let yearValue = document.createElement('dd');
            yearValue.classList = 'col-sm-9';
            yearValue.textContent = album.year;
            dl.appendChild(yearValue);

            // price
            let priceLabel = document.createElement('dt');
            priceLabel.classList = 'col-sm-3';
            priceLabel.textContent = 'Cena';
            dl.appendChild(priceLabel);

            let priceValue = document.createElement('dd');
            priceValue.classList = 'col-sm-9';
            priceValue.innerHTML = "&euro; " + album.price;
            dl.appendChild(priceValue);

            // genre
            if (album.zanrs.length > 0) {
                let genreLabel = document.createElement('dt');
                genreLabel.classList = 'col-sm-3';
                genreLabel.textContent = 'إ½anrs';
                dl.appendChild(genreLabel);

                let genreValue = document.createElement('dd');
                genreValue.classList = 'col-sm-9';
                genreValue.textContent = albums.zanrs;
                dl.appendChild(genreValue);
            }

        info.appendChild(dl);

        // "Go back" button
        let btn = document.createElement('a');
        btn.classList = 'btn btn-dark go-back float-left';
        btn.textContent = 'Uz sؤپkumu';
        btn.href = '#';
        info.appendChild(btn);

    // add info div to row
    row.appendChild(info);

    // create image div
    let image = document.createElement('div');
    image.classList = 'col-md-6 text-center p-5';

        // create image
        let img = document.createElement('img');
        img.classList = 'img-fluid img-thumbnail rounded-lg';
        img.alt = album.name;
        img.src = album.image;
        image.appendChild(img);

        // add image div to row
        row.appendChild(image);

    // add row to document
    root.appendChild(row);
}

// render related books panel of single book page
function renderRelated(albums) {

    // create row
    let titleRow = document.createElement('div');
    titleRow.classList = 'row mt-5';

    // create col
    let titleDiv = document.createElement('div');
    titleDiv.classList = 'col-md-12';

    // create title
    let title = document.createElement('h2');
    title.classList = 'display-4';
    title.textContent = "Lؤ«dzؤ«gas grؤپmatas";

    // add elements to document
    titleDiv.appendChild(title);
    titleRow.appendChild(titleDiv);
    root.appendChild(titleRow);

    // create row element that will hold three related books
    let row = document.createElement('div');
    row.classList = 'row mb-5';

    for (const book of books) {

        // create book div
        let bookDiv = document.createElement('div');
        bookDiv.classList = 'col-md-4';

        // create card div
        let card = document.createElement('div');
        card.classList = 'card';

        // create card image
        let img = document.createElement('img');
        img.classList = 'card-img-top';
        img.alt = album.name;
        img.src = album.image;
        card.appendChild(img);

        // create card body
        let cardBody = document.createElement('div');
        cardBody.classList = 'card-body';

        // create card title
        let cardTitle = document.createElement('h5');
        cardTitle.classList = 'card-title';
        cardTitle.textContent = album.name;
        cardBody.appendChild(cardTitle);

        // create card link
        let btn = document.createElement('a');
        btn.classList = 'btn btn-success see-more';
        btn.textContent = 'Apskatؤ«t';
        btn.href = '#';
        btn.dataset.albumId = album.id;
        cardBody.appendChild(btn);

        // add elements to row
        card.appendChild(cardBody);
        bookDiv.appendChild(card);
        row.appendChild(albumDiv);
    }

    // add row to document
    root.appendChild(row);
}

// set up link functionality
function setupLinks() {

    // "see more" links
    let seeMores = document.querySelectorAll('a.see-more');
    for (let a of seeMores) {
        a.addEventListener("click", function(event){
            event.preventDefault();
            let id = a.dataset.albumId;
            setupSingle(id);
        });
    }

    // "go back" links
    let goBacks = document.querySelectorAll('a.go-back');
    for (let a of goBacks) {
        a.addEventListener("click", function(event){
            event.preventDefault();
            setupIndex();
        });
    }
}

// replace content with spinner
function placeLoader() {
    // clear the root element
    root.innerHTML = "";

    // create loading div
    let loading = document.createElement('div');
    loading.id = 'loading';
    loading.classList = 'text-center p-5';

    // create spinner image
    let img = document.createElement('img');
    img.alt = '...';
    img.src = '/loading.gif';
    loading.appendChild(img);

    // add div to document
    root.appendChild(loading);
}

// remove spinner
function removeLoader() {
    document.getElementById('loading').remove();
}



// start when page is loaded
document.addEventListener("DOMContentLoaded", function(){

    // get root element
    root = document.getElementById('root');

    // create index page
    setupIndex();

});