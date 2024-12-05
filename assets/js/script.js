document.getElementById('search').addEventListener('input', function () {
    const searchValue = this.value;
    fetch('search.php?search=' + encodeURIComponent(searchValue))
        .then(response => response.text())
        .then(html => {
            document.getElementById('recipes-container').innerHTML = html;
        })
        .catch(error => console.error('Ошибка:', error));
});