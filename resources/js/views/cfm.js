import dishService from "../services/dish.service";
import customerService from "../services/customer.service";
import authService from "../services/auth.service";



function xOrderCfmFun(title, price, quantity, srcImgDsh) {
    const strHtml = "<div class=\"flex flex-col relative sm:w-96 mx-2 shadow-xl my-3 sm:mx-0\">" +
        "<img class=\"absolute w-24 rounded-tr-xlarge rounded-bl-xlarge border-2\"" +
        "src=\"" + srcImgDsh + "\" />" +
        "<div class=\"flex rounded-tr-xlarge border-2\" style=\"border-color: #3C691B;\">" +
        "<div class=\"w-24\"></div>" +
        "<div class=\"w-full flex justify-center\">" +
        "<p class=\"text-sm my-1 font-bold\" style=\"color: #3C691B;\">" + title + "</p>" +
        "</div>" +
        "</div>" +
        "<div class=\"flex h-11 border-r-2 border-b-2 border-l-2 justify-between\" style=\"border-color: #3C691B;\">" +
        "<div class=\"flex justify-content items-center\">" +
        "<div class=\"w-24\"></div>" +
        "<p class=\"w-24 mx-1.5 h-fit text-center rounded-tr-md rounded-bl-md text-white font-bold text-sm\"" +
        "style=\"background: #3C691B;\">" +
        price +
        "</p >" +
        "<p class=\"w-16 h-fit text-center rounded-tr-md rounded-bl-md text-white font-bold text-sm\"" +
        "style=\"background: #3C691B;\">" +
        quantity +
        "</p>" +
        "</div>" +
        "<div class=\"flex justify-end items-center mr-2 cursor-pointer btn-trash\">" +
        "<svg width=\"22\" height=\"24\" viewBox=\"0 0 18 20\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">" +
        "<path" +
        " d=\"M2.84062 20C2.37656 20 1.9793 19.8368 1.64883 19.5104C1.31836 19.184 1.15312 18.7917 1.15312 18.3333V2.5H0V0.833333H5.2875V0H12.7125V0.833333H18V2.5H16.8469V18.3333C16.8469 18.7778 16.6781 19.1667 16.3406 19.5C16.0031 19.8333 15.6094 20 15.1594 20H2.84062ZM15.1594 2.5H2.84062V18.3333H15.1594V2.5ZM5.82187 15.9444H7.50937V4.86111H5.82187V15.9444ZM10.4906 15.9444H12.1781V4.86111H10.4906V15.9444Z\"" +
        "fill=\"#BA1A1A\" />" +
        "</svg>" +
        "</div>" +
        "</div>" +
        "</div>";
    const node = document.createElement('div');
    node.innerHTML = strHtml;
    return node.firstChild;
}

function xRowCfmHtmlFun() {
    const rowHtml = document.createElement('div');
    rowHtml.classList.add('flex', 'flex-col', 'md:flex-row', 'xl:flex-col', 'md:justify-evenly', 'sm:items-center');
    return rowHtml;
}

function xColCfmHtmlFun() {
    const colHtml = document.createElement('div');
    colHtml.classList.add('flex', 'flex-col', 'xl:flex-row', 'xl:justify-evenly', 'xl:w-full');
    return colHtml;
}


async function renderCfmBtn() {
    const ctainHtml = document.querySelector('#cfm-container');
    const summary = document.querySelectorAll('.summary');
    const urlParams = new URLSearchParams(window.location.search);
    const nameSearch = urlParams.get('name');
    const categoryId = urlParams.get('categoryId');
    const tableOrder = urlParams.get('tableOrder')

    const searchText = document.querySelector('#search-input-text');
    const searchBtn = document.querySelector('#search-btn');

    searchBtn.addEventListener("click", (_) => {
        const nameTxt = searchText.value;
        location.href = "/confirm?categoryId=" + categoryId + "&tableOrder=" + tableOrder + "&name=" + nameTxt;
    });

    let total = 0;
    let discount = 0;
    let tax = 0;
    let j = 0;
    let offsetRow = 0 // limit 2, must + 1 because % 2 must get 2 too
    let offsetCol = 0 // limit 3, must + 1 because % 3 must get 3 too
    let xRowCfmHtml = xRowCfmHtmlFun();
    let xColCfmHtml = xColCfmHtmlFun();
    xRowCfmHtml.append(xColCfmHtml);
    ctainHtml.append(xRowCfmHtml);

    try {
        for (let i = 0; i < localStorage.length; i++) {
            const key = localStorage.key(i);
            const value = localStorage.getItem(key);

            if (key.includes("dish") && parseInt(value) > 0) {
                const curDish = await dishService.get(parseInt(key.slice(5)));


                const quantity = value;
                const cost = parseInt(curDish.cost);
                const formattedAmount = cost.toLocaleString('vn-VN', { style: 'currency', currency: 'VND' });
                const price = formattedAmount;
                const srcImgDsh = "/" + curDish.imageDish.source;

                const xOrderCfm = xOrderCfmFun(curDish.name, price, quantity, srcImgDsh);

                total += (cost * quantity);
                if (offsetCol == 3) {
                    xColCfmHtml = xColCfmHtmlFun();
                    xRowCfmHtml.append(xColCfmHtml);
                    offsetCol %= 3;
                    offsetRow++;
                }
                if (offsetRow == 2) {
                    xRowCfmHtml = xRowCfmHtmlFun();
                    ctainHtml.append(xRowCfmHtml);
                    offsetRow %= 2;
                }

                if (nameSearch) {
                    if (curDish.name.includes(nameSearch)) {
                        xColCfmHtml.append(xOrderCfm);
                        offsetCol++;

                        document.querySelectorAll('.btn-trash')[j++].addEventListener("click", (_) => {
                            localStorage.setItem(key, "00");
                            ctainHtml.innerHTML = "";
                            renderCfmBtn();
                        });
                    }
                } else if (!nameSearch) {
                    xColCfmHtml.append(xOrderCfm);
                    offsetCol++;

                    document.querySelectorAll('.btn-trash')[j++].addEventListener("click", (_) => {
                        localStorage.setItem(key, "00");
                        ctainHtml.innerHTML = "";
                        renderCfmBtn();
                    });
                }
            }
        }

        tax = total * 0.05;
        for (let i = 0; i < 3 - offsetCol; i++) {
            const padDiv = document.createElement('div');
            padDiv.classList.add('sm:w-96', 'hidden', 'sm:flex', 'mx-2', 'sm:mx-0');
            padDiv.style.height = '77px';
            xColCfmHtml.append(padDiv);
        }

        summary[0].innerText = discount.toLocaleString('vn-VN', { style: 'currency', currency: 'VND' });
        summary[1].innerText = tax.toLocaleString('vn-VN', { style: 'currency', currency: 'VND' });
        summary[2].innerText = total.toLocaleString('vn-VN', { style: 'currency', currency: 'VND' });

    } catch (err) {
        console.log(err);
    }

}

async function main() {
    const payBtn = document.querySelector('.pay-cfm');
    const urlParams = new URLSearchParams(window.location.search);
    const tableOrder = parseInt(urlParams.get('tableOrder')); // this will be data attach
    const codeStaff = document.querySelector('#code-staff');
    const categoryId = parseInt(urlParams.get('categoryId'));

    payBtn.addEventListener("click", async (_) => {
        try {
            const dishes = [];

            for (let i = 0; i < localStorage.length; i++) {
                const key = localStorage.key(i);
                const value = localStorage.getItem(key);
                if (key.includes("dish") && parseInt(value) > 0) {
                    dishes.push({
                        dishId: key.slice(5),
                        amount: value,
                        promotion: 0
                    });
                }
            }


            for (let i = 0; i < dishes.length; i++) {
                const key = "dish_" + dishes[i].dishId;
                localStorage.removeItem(key);
            }


            if (dishes.length == 0) {
                alert("You don't have any food!");
                throw "dishes is empty";
            }

            const data = {
                userId: 1,
                name: 'tableId: ' + tableOrder,
                code: 0,
                phoneNumber: "0343861387",
                address: "here",
                dishes: dishes,
                promotion: 0,
                statusOrder: "normal",
                payments: "crash",
                tableId: tableOrder,
                codeStaff: codeStaff.value
            }

            try {
                const auth = await authService.user();
                data.userId = auth.id;
            } catch (err) {
                data.userId = 1;
            }

            
            
            try {
                const isSuccess = await customerService.create(data);
                alert(isSuccess);
            } catch (err) { 
                console.log(err);
                alert("false");
            }

            location.reload();
            
            
            // localStorage.clear();
            // const success = await customerService.create(data);
            // alert(success);
            // location.href = "/?tableOrder=" + tableOrder + "&categoryId=" + categoryId;

        } catch (err) {
            console.log(err);
            alert("Fail to create order!");
        }

        
    });

    renderCfmBtn();

}

main();