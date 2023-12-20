async function main() {
    const urlParams = new URLSearchParams(window.location.search);
    const categoryId = parseInt(urlParams.get('categoryId'));
    const tableOrder = parseInt(urlParams.get('tableOrder'));

    const searchText = document.querySelector('#search-input-text');
    const searchBtn = document.querySelector('#search-btn');

    searchBtn.addEventListener("click", (_) => {
        const nameTxt = searchText.value.replace(" ", "+");
        location.href = "/categories?categoryId=" + categoryId + "&tableOrder=" + tableOrder + "&name=" + nameTxt;
    });
}

main();