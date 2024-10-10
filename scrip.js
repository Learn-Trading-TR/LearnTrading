var swiper = new Swiper('.swiper-container', {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    loop: true,
});

window.onload = function() {
    document.querySelector('.swiper-container').classList.add('fade-in');
};
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById("signinModal");
    var signinLink = document.querySelector(".spsn a");
    var signupLink = document.getElementById("switchToSignup");
    var switchToSigninLink = document.getElementById("switchToSignin");
    var signinBox = document.querySelector(".signin-box");
    var signupBox = document.querySelector(".signup-box");
    var closeModal = document.querySelector(".close");


    signinLink.addEventListener('click', function(e) {
        e.preventDefault();
        modal.style.display = "block";
        signinBox.style.display = "block";
        signupBox.style.display = "none";
    });


    signupLink.addEventListener('click', function(e) {
        e.preventDefault();
        signinBox.style.display = "none";
        signupBox.style.display = "block";
    });


    switchToSigninLink.addEventListener('click', function(e) {
        e.preventDefault();
        signinBox.style.display = "block";
        signupBox.style.display = "none";
    });


    closeModal.addEventListener('click', function() {
        modal.style.display = "none";
    });


    window.addEventListener('click', function(e) {
        if (e.target == modal) {
            modal.style.display = "none";
        }
    });
});


document.addEventListener("DOMContentLoaded", function() {
    const input = document.querySelector("#phone");
    window.intlTelInput(input, {
        initialCountry: "auto",
        geoIpLookup: function(callback) {
            fetch('https://ipinfo.io?token=YOUR_TOKEN', { method: 'GET' })
                .then(response => response.json())
                .then(data => callback(data.country))
                .catch(() => callback('us'));
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });
});
    


document.querySelector('.contact-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const name = document.querySelector('#name').value;
    const phone = document.querySelector('#phone').value;
    const email = document.querySelector('#email').value;
    const description = document.querySelector('#description').value;

    const mailtoLink = `mailto:info@learntrading-tr.com?subject=Contact%20Form%20Submission&body=Name:%20${encodeURIComponent(name)}%0D%0APhone:%20${encodeURIComponent(phone)}%0D%0AEmail:%20${encodeURIComponent(email)}%0D%0ADescription:%20${encodeURIComponent(description)}`;

    window.location.href = mailtoLink;

    document.querySelector('.contact-form').reset();
});



