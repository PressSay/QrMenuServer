import dishService from '../services/dish.service';

function funQuantity(qHtml, opt) {
    const curQuantity = parseInt(qHtml.innerText);
    if (opt == '+') {
        const newQuantity = (curQuantity + 1 > 99) ? 99 : curQuantity + 1;
        qHtml.innerHTML = (newQuantity < 10) ? `0${newQuantity}` : newQuantity;
    } else if (opt == '-') {
        const newQuantity = (curQuantity - 1 < 0) ? 0 : curQuantity - 1;
        qHtml.innerHTML = (newQuantity < 10) ? `0${newQuantity}` : newQuantity;
    }
}

function chgeStusBgMinus(iconMinusHtml, bgMinusHtml, quantity) {
    if (quantity > 0) {
        // bgMinusHtml.style.background = "#FFDAD6";
        bgMinusHtml.classList.add("bg-error");
        iconMinusHtml.classList.remove("fill-base-content");
        iconMinusHtml.classList.add("fill-error-content");
    } else {
        bgMinusHtml.classList.remove("bg-error");
        iconMinusHtml.classList.remove("fill-error-content");
        iconMinusHtml.classList.add("fill-base-content");
        // bgMinusHtml.style.background = "white";
    }
}

async function main() {
    const dishImg = document.querySelectorAll('.dish-img');
    const plusBtn = document.querySelectorAll('.btn-plus');
    const minusBtn = document.querySelectorAll('.btn-minus');
    const bgMinus = document.querySelectorAll('.bg-minus');
    const iconMinus = document.querySelectorAll('.icon-minus');
    

    const quantity = document.querySelectorAll('.quantity');
    const urlParams = new URLSearchParams(window.location.search);
    const categoryId = parseInt(urlParams.get('categoryId'));
    const tableOrder = parseInt(urlParams.get('tableOrder'));
    const searchName = urlParams.get('name');
    const pageNormal = !(categoryId && tableOrder);
    

    const searchText = document.querySelector('#search-input-text');
    const searchBtn = document.querySelector('#search-btn');

    // bgMinus.classList.remove("bg-error");

    searchBtn.addEventListener("click", (_) => {
        const nameTxt = searchText.value.replace(" ", "+");
        if (pageNormal) {
            location.href = "/?name=" + nameTxt;
        }
        else {
            location.href = "/?categoryId=" + categoryId + "&tableOrder=" + tableOrder + "&name=" + nameTxt;
        }
    });

    try {
        const arrDish = (searchName) ?
            await dishService.getAllByName(searchName) : await dishService.getAllByCategoryId(categoryId);

        for (let k in arrDish) {
            const ele = arrDish[k];
            dishImg[k].src = "/" + ele.imageDish.source;
            if (localStorage.getItem('dish_' + ele.dishId)) {
                console.log(localStorage.getItem('dish_' + ele.dishId));
                const curQD = parseInt(localStorage.getItem('dish_' + ele.dishId));
                quantity[k].innerText = (curQD < 10) ? `0${curQD}` : curQD;
                chgeStusBgMinus(iconMinus[k], bgMinus[k], curQD);
            }

            plusBtn[k].addEventListener("click", (_) => {
                funQuantity(quantity[k], '+');
                localStorage.setItem('dish_' + ele.dishId, quantity[k].innerText);
                const curQDFun = parseInt(quantity[k].innerText);
                chgeStusBgMinus(iconMinus[k], bgMinus[k], curQDFun);
            });
            minusBtn[k].addEventListener("click", (_) => {
                funQuantity(quantity[k], '-');
                localStorage.setItem('dish_' + ele.dishId, quantity[k].innerText);
                const curQDFun = parseInt(quantity[k].innerText);
                chgeStusBgMinus(iconMinus[k], bgMinus[k], curQDFun);
            })
        }
    } catch (err) {
        console.log(err);
    }
}


main();