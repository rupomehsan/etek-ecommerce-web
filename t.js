var c = [...c].map(e => {
    return {
        image: e.querySelector('img').src,
        title: e.querySelector('h6').innerText,
    }
});

var c = document.querySelectorAll('.product-view');
c = [...c].map(e => {
    return {
        image: e.querySelector('img').src,
        title: e.querySelector('.product-title').innerText,
        regular_price: e.querySelector('.regular-product')?.innerText,
        del_price: e.querySelectorAll('.del-price').length > 1 ? e.querySelectorAll('.del-price')[1]?.innerText : 0,
    }
});

///last one
const elements = document.querySelectorAll('.product-view');
const products = [...elements].map(e => {
    console.log(e);
    const popularProductImg = e.querySelector('.popular-product-img img');
    console.log('Popular product image element:', popularProductImg);
    return {
        image: popularProductImg ? popularProductImg.src : '',
        title: e.querySelector('.product-title')?.innerText || '',
        regular_price: e.querySelector('.regular-product')?.innerText || '',
        del_price: e.querySelectorAll('.del-price').length > 1 ? e.querySelectorAll('.del-price')[1]?.innerText || 0 : 0,
    };
});


console.log(products);
