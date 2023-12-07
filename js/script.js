document.addEventListener('DOMContentLoaded', function () {
    var searchForm = document.getElementById('search-form');

    searchForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const state = document.querySelector('#search-term').value.trim().replace(/_/g, " ");

        const goToUrl = 'state.php?state=' + state + "&page=1";
        console.log(goToUrl);
        window.location.href = goToUrl;
    });
});
