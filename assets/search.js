console.log(lunrJs);
var opts = {
    method: 'GET',
    headers: {}
};
fetch(basildon.lunrIndex, opts)
    .then((response) => {
        return response.json();
    }).then((lunrIndexData) => {
    console.log(lunrIndexData);
    const lunrIndex = lunr.Index.load(lunrIndexData);
    console.log(lunrIndex);

    // Create search field.
    const searchField = document.createElement('input');
    searchField.type = 'search';
    searchField.addEventListener('keyup', (keyupEvent) => {
        // Get results from Lunr.
        console.log(keyupEvent.target.value);
        const results = lunrIndex.search(keyupEvent.target.value);
        console.log(results);
    });
    // Create label.
    const searchLabel = document.createElement('label');
    searchLabel.classList.add('search');
    searchLabel.textContent = 'Search:';
    searchLabel.append(searchField);
    // Add search to document.
    document.querySelector('header.site-header').append(searchLabel);
});
