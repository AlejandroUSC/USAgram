// Display state content
document.addEventListener('DOMContentLoaded', function () {
    const params = new URLSearchParams(window.location.search);
    const stateName = params.get('state');

    const endpoint = `https://en.wikipedia.org/w/api.php`;

    if (stateName)
        document.getElementById('state-name-rep').textContent = stateName.replace(/_/g, " ");

    // Grabs the flag
    if (stateName) {
        const stateURL = encodeURIComponent(stateName.replace(/ /g, "_"));

        fetch(`${endpoint}?action=query&titles=File:Flag_of_${stateURL}.svg&prop=imageinfo&iiprop=url&format=json&origin=*`)
            .then(response => response.json())
            .then(data => {
                const pages = data.query.pages;
                const page = pages[Object.keys(pages)[0]];
                if (page.imageinfo) {
                    const imageUrl = page.imageinfo[0].url;
                    document.getElementById('state-flag').src = imageUrl;
                } else {
                    console.log(`Flag couldn't be found - ${stateName}.`);
                }
            })
            .catch(error => console.error('Error fetching:', error));
    } else {
        console.log('State param isnt in URL.');
    }

    // Grabs desc from Wiki
    if (stateName) {
        const stateURL = encodeURIComponent(stateName.replace(/ /g, "_"));
        fetch(`${endpoint}?action=query&format=json&origin=*&prop=extracts&exintro&explaintext&redirects=1&titles=${stateURL}`)
            .then(response => response.json())
            .then(data => {
                const pages = data.query.pages;
                const page = pages[Object.keys(pages)[0]];
                if (page.extract) {
                    const words = page.extract.split(/\s+/);
                    const first200Words = words.slice(0, 200).join(' ');
                    document.getElementById('state-desc').firstElementChild.textContent = first200Words + '...';
                } else {
                    console.log('Description not found');
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    } else {
        console.log('State param isnt URL.');
    }
});