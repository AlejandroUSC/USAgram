document.addEventListener('DOMContentLoaded', function () {
    var searchForm = document.getElementById('search-form');

    searchForm.addEventListener('submit', function (event) {
        event.preventDefault();
        let state = document.querySelector('#search-term').value.trim().replace(/ /g,"_");
        state = capitalizeWords(state);
        const goToUrl = 'state.php?state=' + state + "&page=1";
        console.log(goToUrl);
        window.location.href = goToUrl;
    });
});

function capitalizeWords(str) {
    return str.split('_')
              .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
              .join('_');
}
