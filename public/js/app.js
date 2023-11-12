// Initialize Ajax Request header
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// welcome carousel (index page)
let welcomeCarousel = $("#welcome-carousel");
if (welcomeCarousel[0]) {
    welcomeCarousel.owlCarousel({
        items: 1,
        loop: true,
        margin: 30,
        nav: false,
        dots: false,
    });

    // Owl carousel navigations
    let owlNavPrev = document.getElementById("welcome-carousel-prev-nav");
    owlNavPrev.addEventListener("click", function () {
        welcomeCarousel.trigger('prev.owl.carousel');
    });

    let owlNavNext = document.getElementById("welcome-carousel-next-nav");
    owlNavNext.addEventListener("click", function () {
        welcomeCarousel.trigger('next.owl.carousel');
    });
}

//products carousel
let productsCarousel = $("#products-carousel");
if (productsCarousel[0]) {
    productsCarousel.owlCarousel({
        loop: true,
        margin: 18,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
            },
            481: {
                items: 2,
                autoplay: true,
            },
            991: {
                items: 4,
                autoplay: false,
            }
        }
    });

    // Owl carousel navigations
    let owlNavPrev = document.getElementById("products-carousel-prev-nav");
    owlNavPrev.addEventListener("click", function () {
        productsCarousel.trigger('prev.owl.carousel');
    });

    let owlNavNext = document.getElementById("products-carousel-next-nav");
    owlNavNext.addEventListener("click", function () {
        productsCarousel.trigger('next.owl.carousel');
    });
}


//scroll top
document.getElementById("scroll-top").addEventListener("click", function () {
    document.body.scrollIntoView({ block: "start", behavior: "smooth" });
});


//filter selects
$('.filter-select').selectric({
    arrowButtonMarkup: '<button class="selectric-button" type="button"><span class="material-icons-outlined">chevron_right</span></button>',
    maxHeight: 260,
    nativeOnMobile: false,
    onInit: function (element) {
        toggleSelectricHighlight($(this).val(), element);
    },
    onChange: function (element) {
        $(element).change();
        toggleSelectricHighlight($(this).val(), element);
        ajaxGetProducts();
    }
});
//hightlight selectrics`s background if any value selected (except 0)
function toggleSelectricHighlight(value, element) {
    let wrapper = element.closest('.selectric-wrapper');
    let selectric = wrapper.getElementsByClassName('selectric')[0];

    if (value == '') {
        selectric.classList.remove('selectric--highlighted');
    } else {
        selectric.classList.add('selectric--highlighted');
    }
}
//filter products on selectric input
function ajaxGetProducts() {
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '/products/ajax-get',
        data: new FormData(document.getElementById('products-filter-form')),
        processData: false,
        contentType: false,
        //update inner HTML of products list container on success
        success: function (response) {
            document.getElementById('products-list-container').innerHTML = response;
        },
        error: function () {
            console.log('Ajax products filter failed !');
        }
    });
}


//search button
function showSearchResults() {
    $('#search-input').focus();
}
//submit search on input value change
function submitSearch(event) {
    $.ajax({
        type: 'POST',
        url: '/search',
        data: { keyword: event.target.value },
        success: function (response) {
            document.getElementById('search-results').innerHTML = response;
        },
        error: function () {
            console.log('Ajax search failed !');
        }
    })
}


//Mailing
let mailingForm = document.getElementById('mailing-form');
let mailingInput = document.getElementById('mailing-input');
let submitMailingIcon = document.getElementById('submit-mailing-icon');
let submitMailingButton = document.getElementById('submit-mailing-button');

//submit
function submitMailing(event) {
    event.preventDefault();

    $.ajax({
        type: 'POST',
        url: '/mailing/store',
        data: { email: mailingInput.value },
        success: function () {
            mailingForm.classList.add('mailing-form--success');
            mailingInput.value = 'Спасибо, подписка оформлена';
            submitMailingIcon.innerHTML = 'done';
            //disable form
            mailingInput.disabled = true;
            submitMailingButton.disabled = true;
        },
        error: function () {
            console.log('Ajax submit mailing failed !');
        }
    });
}

//cancel
function cancelMailing() {
    $.ajax({
        type: 'POST',
        url: '/mailing/destroy',
        success: function () {
            mailingForm.classList.remove('mailing-form--success');
            mailingInput.value = '';
            submitMailingIcon.innerHTML = 'email';
            //enable form
            mailingInput.disabled = false;
            submitMailingButton.disabled = false;
        },
        error: function () {
            console.log('Ajax cancel mailing failed !');
        }
    });
}


// Mobile menu toggling
let mobileMenu = document.querySelector('.mobile-menu');

document.querySelector('.mobile-menu-show').addEventListener('click', () => {
    mobileMenu.classList.add('mobile-menu--visible');
});

document.querySelector('.mobile-menu-hide').addEventListener('click', () => {
    mobileMenu.classList.remove('mobile-menu--visible');
});

document.addEventListener('click', function (evt) {
    targ = evt.target;

    // Check if event target is outside of active dropdown
    if (!targ.classList.contains('mobile-menu-show') && !mobileMenu.contains(targ)) {
        mobileMenu.classList.remove('mobile-menu--visible');
    }
});


// ********** Enabling and disable Owl Carousel for different devices **********
const TABLET_BREAKPOINT = 768;
const MOBILE_BREAKPOINT = 480;

const advantages = {
    selector: '.advantages',
    options: {
        items: 1,
        loop: true,
        margin: 20,
        nav: false,
        dots: true,
        autoHeight: true
    }
}

const laptopCarousels = [];
const tabletCarousels = [];
const mobileCarousels = [advantages];

function debounce(callback, timeoutDelay = 500) {
    let timeoutId;

    return (...rest) => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => callback.apply(this, rest), timeoutDelay);
    };
}

function startCarousels(carousels) {
    for (let carousel of carousels) {
        if (!document.querySelector(carousel.selector)) continue;

        document.querySelector(carousel.selector).classList.remove('owl-stoped');
        // Escape multiple load
        if (!document.querySelector(carousel.selector).classList.contains('owl-loaded')) {
            $(carousel.selector).owlCarousel(carousel.options);
        }
    }
}

function stopCarousels(carousels) {
    for (let carousel of carousels) {
        if (!document.querySelector(carousel.selector)) continue;

        document.querySelector(carousel.selector).classList.add('owl-stoped');
        // Escape multiple destroy
        if (document.querySelector(carousel.selector).classList.contains('owl-loaded')) {
            $(carousel.selector).trigger('destroy.owl.carousel');
        }
    }
}

function validateCarousels() {
    const windowWidth = window.innerWidth;

    // Laptop carousels
    if (windowWidth > TABLET_BREAKPOINT) {
        stopCarousels(tabletCarousels);
        stopCarousels(mobileCarousels);
        startCarousels(laptopCarousels);
    }

    // Tablet carousels
    else if (windowWidth <= TABLET_BREAKPOINT && windowWidth > MOBILE_BREAKPOINT) {
        stopCarousels(laptopCarousels);
        stopCarousels(mobileCarousels);
        startCarousels(tabletCarousels);
    }

    // Mobile carousels
    else if (windowWidth <= MOBILE_BREAKPOINT) {
        stopCarousels(laptopCarousels);
        stopCarousels(tabletCarousels);
        startCarousels(mobileCarousels);
    }
}

window.addEventListener('load', () => {
    validateCarousels();
});

window.addEventListener('resize', () => {
    debounce(validateCarousels())
});
