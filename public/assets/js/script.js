// const { get } = require("lodash");

window.addEventListener('load', function() {
    document.querySelector('.pre-loader').style.display = 'none';
    this.document.querySelector('.header').style.zIndex = 1000;

    let reloading = sessionStorage.getItem("reloading");
    if (reloading) {
        sessionStorage.removeItem("reloading");
        showCartSession();
    }
});

function showCartSession(){
    document.querySelector('.cart-session').classList.add('show-cart-session');
}

document.querySelector('.cart-ic i').addEventListener('click', function(e){
    e.preventDefault();
    document.querySelector('.cart-session').classList.add('show-cart-session');
    // document.querySelector('.overlay-cart').classList.add('active');
});

document.querySelector('.close-cart-session').addEventListener('click', function(){
    document.querySelector('.cart-session').classList.remove('show-cart-session');
    // document.querySelector('.overlay-cart').classList.remove('active');

})

const getPrice = document.querySelectorAll('.cart-item-price .price');
getPrice.forEach((el) =>{
    el.textContent = new Intl.NumberFormat('en-EN').format(el.textContent * el.parentElement.nextElementSibling.querySelector('input.quantity').value);
})


const updatePrice = function() {
    const price = document.querySelector('.cart-price .price');
    let priceDefault = 0;
    document.querySelectorAll('.cart-item').forEach((el, ind) => {
        const elPrice = el.querySelector('.cart-item-variant .cart-item-price .price').textContent;
        priceDefault += Number(elPrice.split(',').join(''));
        price.textContent = new Intl.NumberFormat('en-EN').format(priceDefault);
    });

    if(document.querySelectorAll('.cart-item').length < 1){
        price.textContent = `0đ`;
    }
}

const countItems = function() {
    const countCartItems = document.querySelector('.cart-ic p');
    countCartItems.textContent = document.querySelectorAll('.cart-item').length;
    if(countCartItems.textContent <= 0){
        countCartItems.style.display = 'none';
        document.querySelector('.cart-checkout a').style.opacity = 0.5;
        document.querySelector('.cart-checkout a').style.pointerEvents = 'none';
        document.querySelector('.cart-checkout a').style.cursor = 'default';
        document.querySelector('.cart-checkout a').style.userSelect = 'none';
    }else{
        countCartItems.style.display = 'block';
        document.querySelector('.cart-checkout a').style.opacity = 1;
        document.querySelector('.cart-checkout a').style.pointerEvents = 'all';
        document.querySelector('.cart-checkout a').style.cursor = 'pointer';
        document.querySelector('.cart-checkout a').style.userSelect = 'all';
    }
    const countCartItemsInCart = document.querySelector('.cart-session .title span');
    countCartItemsInCart.textContent = `(${document.querySelectorAll('.cart-item').length} sản phẩm)`;

    updatePrice();
}
countItems();

// // console.log(document.querySelectorAll('.cart-item').length);



// document.querySelector('.search a i').addEventListener('click', function(e){
 //     e.preventDefault();
//     document.querySelector('.search-inp').classList.toggle('active');
// })


document.querySelectorAll('.delete-cart-item').forEach(el => {
    el.addEventListener('click', function(){
        const cartId = el.parentElement.firstElementChild.value;
        if(document.querySelectorAll('.cart-item').length > 1){
            this.parentElement.remove();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/delete-cart-item/'+cartId,
                type: "POST",
                data: "",
                
                success:function(response) {
                    alert(response.status);      
                }
            });
        

            updatePrice();
            countItems();
        }
        else if(document.querySelectorAll('.cart-item').length == 1){
            this.parentElement.remove();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/delete-cart-item/'+cartId,
                type: "POST",
                data: "",
                
                success:function(response) {
                                          
                }
            });
            countItems();
            document.querySelector('.cart-price .price').textContent = 0;
        }
    });
});




document.querySelectorAll('.asc-quantity').forEach(function(el, ind) {
    const getPrice = document.querySelectorAll('.cart-item-price .price');
    const currPrice = Number(getPrice[ind].textContent.split(',').join('')) / getPrice[ind].parentElement.nextElementSibling.querySelector('input.quantity').value;
    el.addEventListener('click', function() {
        const quantity = document.querySelectorAll('.quantity');
        const cartId = el.closest('.cart-item').firstElementChild.value;
        console.log(cartId);
        if(this.nextElementSibling.value < this.nextElementSibling.getAttribute('max')){
            this.nextElementSibling.value = Number(this.nextElementSibling.value) + 1;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
            $.ajax({
                url: '/update-cart-item-quantity/'+cartId,
                type: "POST",
                data: "",
                success:function(response) {
                    // alert(response.status);
                }
            });
        }


        getPrice[ind].textContent = `${new Intl.NumberFormat('en-EN').format(currPrice * Number(this.nextElementSibling.value))}`;
        updatePrice(); 
    })
})

document.querySelectorAll('.desc-quantity').forEach(function(el, ind) {
    const getPrice = document.querySelectorAll('.cart-item-price .price');
    const currPrice = Number(getPrice[ind].textContent.split(',').join('')) / getPrice[ind].parentElement.nextElementSibling.querySelector('input.quantity').value;
    const cartId = el.closest('.cart-item').firstElementChild.value;

    el.addEventListener('click', function() {
        const quantity = document.querySelectorAll('.quantity');
        if(this.previousElementSibling.value > this.previousElementSibling.getAttribute('min')){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
            $.ajax({
                url: '/update-desc-cart-item-quantity/'+cartId,
                type: "POST",
                data: "",
                success:function(response) {
                    // alert(response.status);
                }
            });
            this.previousElementSibling.value = Number(this.previousElementSibling.value) - 1;
        }

        

        getPrice[ind].textContent = `${new Intl.NumberFormat('en-EN').format(currPrice * Number(this.previousElementSibling.value))}`;
        updatePrice(); 
    })
});

const show = function() {
    document.querySelector('.cart-session').classList.toggle('show-cart-session');
}

function reloadAfterChangeSize() {
    sessionStorage.setItem("reloading", "true");
    document.location.reload();
}

document.querySelectorAll('select.change_size_cart').forEach(el => {
    el.addEventListener('change', function(){
        const cartID = this.closest('.cart-item').querySelector('.cart_item_hidden_id').value;
        const userID = this.closest('.cart-item').querySelector('.cart_item_hidden_user_id').value;
        const proID = this.closest('.cart-item').querySelector('.cart_item_hidden_product_id').value;
        const size = this.closest('.cart-item').querySelector('.cart_item_hidden_size').value;
        const newSize = this.value;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/update-cart-item-size/'+ cartID,
            type: "POST",
            data: {
                'userID': userID,
                'proID': proID,
                'size': size,
                'newSize': newSize
            },
            success:function(response) {
                // alert(response.status);
                reloadAfterChangeSize();
            }
        });
    })

    // document.querySelector('.cart-session').classList.toggle('show-cart-session');

   
});

document.querySelector('.search-ic i').addEventListener('click', function(){
    // console.log(this.lastElementChild);
    this.nextElementSibling.classList.toggle('show-search-form');
})

// document.querySelector('.search_product').addEventListener('click', function() {
//     document.querySelector('.drop-down-list').classList.add('show-dropdown');
// })



document.querySelector('.search_product').addEventListener('input', function() {
    const proName = this.value;
    // console.log(this.value);
    if(this.value){ 
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            url: '/find-product-name',
            type: "POST",
            data: {
                'proName': proName
            },
            success:function(response) {
                
                document.querySelector('.drop-down-list').style.display = 'block';
                document.querySelector('.drop-down-list').innerHTML = '';
                document.querySelector('.search_product').style.borderBottomLeftRadius = 0;

                response.forEach(el => {
                    const html = `<div class="drop-down-item">
                                    <a href="/product-detail/${el.id}">
                                    <div class="product-search-img">
                                        <img src="/upload/products/${el.img}" alt="">
                                    </div>
                                    <div class="product-search-name">
                                        <p>${el.name}</p>
                                    </div>
                                </a>
                            </div>`;
                    
                    document.querySelector('.drop-down-list').insertAdjacentHTML('afterbegin', html);
                    
                })
            }
        });

    }
    else if(document.querySelector('.search_product').value == ''){
        document.querySelector('.drop-down-list').style.display = 'none';
        this.style.borderBottomLeftRadius = '8px';

        // document.querySelector('.drop-down-list').classList.remove('show-dropdown');
    }

})









$(document).ready(function() {
    $('.slider').slick({
        dots: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 2000,
    });

    $('.sale-product .container .box').slick({
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 4,
        slidesToScroll: 4,
        prevArrow:"<button type='button' class='slick-prev pull-left'><i class='ph-arrow-left-light'></i></button>",
        nextArrow:"<button type='button' class='slick-next pull-right'><i class='ph-arrow-right-light'></i></button>",

        responsive: [
            {
              breakpoint: 1300,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
              }
            },

            {
                breakpoint: 978,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1,
                }
              },
        ]
    });

    $('.all-category .container .box').slick({
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 3,
        slidesToScroll: 1,
        prevArrow:"<button type='button' class='slick-prev pull-left'><i class='ph-arrow-left-light'></i></button>",
        nextArrow:"<button type='button' class='slick-next pull-right'><i class='ph-arrow-right-light'></i></button>",
    });

    // $('.product-new .box .container').owlCarousel({
    //     items: 4,
    //     loop: true,
    //     dots: false,
    //     nav: false,
    //     margin: 30,
    //     // navText: ['<i class="fas fa-chevron-left prev"></i>', '<i class="fas fa-chevron-right next"></i>'],
    //     autoplay: true,
    //     autoplayTimeout: 2000,
    //     // autoplayHoverPause: true,
    // });


    // $('.product-sale .box .container').owlCarousel({
    //     items: 4,
    //     loop: true,
    //     dots: false,
    //     nav: false,
    //     margin: 30,
    //     // navText: ['<i class="fas fa-chevron-left prev"></i>', '<i class="fas fa-chevron-right next"></i>'],
    //     autoplay: true,
    //     autoplayTimeout: 2000,
    //     // autoplayHoverPause: true,
    // });
});