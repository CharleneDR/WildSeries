let watchlist = document.getElementsByClassName('watchlist')

for (const program of watchlist) {
    program.addEventListener('click', addToWatchlist);

    function addToWatchlist(event) {
        event.preventDefault()
        let link = program.href

        fetch(link)
            .then(response => response.json())
            .then(function (response) {
                let watchlistIcon = program.firstElementChild;
                if (response.isInWatchlist) {
                    watchlistIcon.classList.remove('bi-heart');
                    watchlistIcon.classList.add('bi-heart-fill');
                } else {
                    watchlistIcon.classList.remove('bi-heart-fill');
                    watchlistIcon.classList.add('bi-heart');
                }
            })
    }
}
