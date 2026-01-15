const AUTOCOMPLETE_URL = 'http://cat-facts-api.std-900.ist.mospolytech.ru/autocomplete';
let autocompleteTimeout;

function createPageBtn(page, classes=[]) { 
    let btn = document.createElement('button');
    classes.push('btn');
    for (let cls of classes) {
        btn.classList.add(cls);
    }
    btn.dataset.page = page;
    btn.innerHTML = page;
    return btn;
}

function renderPaginationElement(info) {
    let btn;
    let paginationContainer = document.querySelector('.pagination');
    paginationContainer.innerHTML = '';

    btn = createPageBtn(1, ['first-page-btn']);
    btn.innerHTML = 'Первая страница';
    if (info.current_page == 1) {
        btn.style.visibility = 'hidden';
    }
    paginationContainer.append(btn);

    let buttonsContainer = document.createElement('div');
    buttonsContainer.classList.add('pages-btns');
    paginationContainer.append(buttonsContainer);

    let start = Math.max(info.current_page - 2, 1);
    let end = Math.min(info.current_page + 2, info.total_pages);
    for (let i = start; i <= end; i++) {
        buttonsContainer.append(createPageBtn(i, i == info.current_page ? ['active'] : []));
    }

    btn = createPageBtn(info.total_pages, ['last-page-btn']);
    btn.innerHTML = 'Последняя страница';
    if (info.current_page == info.total_pages) {
        btn.style.visibility = 'hidden';
    }
    paginationContainer.append(btn);
}

function perPageBtnHandler(event) {
    downloadData(1);
}

function setPaginationInfo(info) {
    document.querySelector('.total-count').innerHTML = info.total_count;
    let start = info.total_count > 0 ? (info.current_page - 1)*info.per_page + 1 : 0;
    document.querySelector('.current-interval-start').innerHTML = start;
    let end = Math.min(info.total_count, start + info.per_page - 1)
    document.querySelector('.current-interval-end').innerHTML = end;
}

function pageBtnHandler(event) {
    if (event.target.dataset.page) {
        downloadData(event.target.dataset.page);
        window.scrollTo(0, 0);
    }
}

function createAuthorElement(record) {
    let user = record.user || {'name': {'first': '', 'last': ''}};
    let authorElement = document.createElement('div');
    authorElement.classList.add('author-name');
    authorElement.innerHTML = user.name.first + ' ' + user.name.last;
    return authorElement;
}

function createUpvotesElement(record) {
    let upvotesElement = document.createElement('div');
    upvotesElement.classList.add('upvotes');
    upvotesElement.innerHTML = record.upvotes;
    return upvotesElement;
}

function createFooterElement(record) {
    let footerElement = document.createElement('div');
    footerElement.classList.add('item-footer');
    footerElement.append(createAuthorElement(record));
    footerElement.append(createUpvotesElement(record));
    return footerElement;
}

function createContentElement(record) {
    let contentElement = document.createElement('div');
    contentElement.classList.add('item-content');
    contentElement.innerHTML = record.text;
    return contentElement;
}

function createListItemElement(record) {
    let itemElement = document.createElement('div');
    itemElement.classList.add('facts-list-item');
    itemElement.append(createContentElement(record));
    itemElement.append(createFooterElement(record));
    return itemElement;
}

function renderRecords(records) {
    let factsList = document.querySelector('.facts-list');
    factsList.innerHTML = '';
    for (let i = 0; i < records.length; i++) {
        factsList.append(createListItemElement(records[i]));
    }
}

function downloadData(page=1) {
    let factsList = document.querySelector('.facts-list');
    let url = new URL(factsList.dataset.url);
    let perPage = document.querySelector('.per-page-btn').value;
    url.searchParams.append('page', page);
    url.searchParams.append('per-page', perPage);
    let searchValue = document.querySelector('.search-field').value.trim();
    if (searchValue) {
        url.searchParams.append('q', searchValue);
    }
    let xhr = new XMLHttpRequest();
    xhr.open('GET', url);
    xhr.responseType = 'json';
    xhr.onload = function () {
        renderRecords(this.response.records);
        setPaginationInfo(this.response['_pagination']);
        renderPaginationElement(this.response['_pagination']);
    }
    xhr.send();
}

function hideAutocomplete() {
    let list = document.querySelector('.autocomplete-list');
    list.classList.remove('visible');
    list.innerHTML = '';
}

function renderAutocomplete(suggestions) {
    let list = document.querySelector('.autocomplete-list');
    list.innerHTML = '';
    if (!suggestions || suggestions.length === 0) {
        hideAutocomplete();
        return;
    }
    suggestions.forEach((item) => {
        let option = document.createElement('div');
        option.classList.add('autocomplete-item');
        option.innerText = item;
        option.onclick = function () {
            document.querySelector('.search-field').value = item;
            hideAutocomplete();
            downloadData(1);
        }
        list.append(option);
    });
    list.classList.add('visible');
}

function downloadAutocomplete(query) {
    let url = new URL(AUTOCOMPLETE_URL);
    url.searchParams.append('q', query);
    let xhr = new XMLHttpRequest();
    xhr.open('GET', url);
    xhr.responseType = 'json';
    xhr.onload = function () {
        renderAutocomplete(this.response);
    }
    xhr.send();
}

function searchInputHandler(event) {
    let query = event.target.value.trim();
    if (!query) {
        hideAutocomplete();
        return;
    }
    clearTimeout(autocompleteTimeout);
    autocompleteTimeout = setTimeout(function () {
        downloadAutocomplete(query);
    }, 300);
}

function searchBtnHandler() {
    hideAutocomplete();
    downloadData(1);
}

function searchFieldKeyHandler(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        searchBtnHandler();
        hideAutocomplete();
    }
}

function documentClickHandler(event) {
    let wrapper = document.querySelector('.search-field-wrapper');
    if (wrapper && !wrapper.contains(event.target)) {
        hideAutocomplete();
    }
}

window.onload = function () {
    downloadData();
    document.querySelector('.pagination').onclick = pageBtnHandler;
    document.querySelector('.per-page-btn').onchange = perPageBtnHandler;
    document.querySelector('.search-btn').onclick = searchBtnHandler;
    document.querySelector('.search-field').onkeydown = searchFieldKeyHandler;
    document.querySelector('.search-field').oninput = searchInputHandler;
    document.addEventListener('click', documentClickHandler);
}