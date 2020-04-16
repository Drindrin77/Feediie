function profiles() {
    let id = [1, 2, 3, 4, 5];
    let pictures = ['https://1.bp.blogspot.com/_qEbjiFbQWGM/TCBVlN3mkYI/AAAAAAAADCM/7CjYqUHwbgY/s1600/workshop_modell_0126.jpg', 'http://static.stylemagazin.hu/medias/29280/Nem-ehezik-a-Women-of-the-Year-legjobb-modell-dijara-eselyes-szepseg_32fc7c86954a8847610499a0fc7261e2.jpg', 'http://w1nd.cc/promo/347.jpg', 'http://ell.h-cdn.co/assets/cm/15/01/54a769be3112d_-_elle-rata-insta-1-24375723.png', 'http://hircsarda.hu/wp-content/uploads/2016/03/orban1.jpeg'];
    let surname = ['Gertrude', 'Cunegonde', 'Mauricette', 'Germaine', 'Machine'];
    let age = [20, 35, 24, 44, 66];
    let description = ['tuo gravissimo et maximo. Ex quo profecto intellegis quanta in dato beneficio sit laus, cum in accepto sit tanta gloria.', 'paulo ante in omnibus, cum M. Marcellum senatui reique publicae concessisti, commemoratis praesertim offensionibus, te auctoritatem huius ordinis dignitatemque rei publicae', 'qamvis excellas, omnes tuos ad honores amplissimos perducere, ut Scipio P. Rupilium potuit consulem efficere, fratrem eius L. non potuit. Quod si etiam ', 'quantum ille quem diligas atque adiuves, sustinere. Non enim neque tu possis, quamvis excellas, omnes tuos ad honores amplissimos perducere, ut Scipio P. Rupiliu', 'commemoratis praesertim offensionibus, te auctoritatem huius ordinis dignitatemque rei publicae tuis vel doloribus vel'];
    return [id, pictures, surname, age, description];
}

function printCards() {
    let card = document.getElementById("card");
    let [id, pictures, surname, age, description] = profiles();
    for (let i = 0; i < id.length; i++) {
        card.innerHTML += '<div class=\"buddy\" style=\"display: block;\"> <div class=\"avatar\"style=\"display: block; background-image: url(' + pictures[i] + ')\"></div><div class=\"name\">' + surname[i] + ', ' + age[i] + '</div><div class=\"description\">' + description[i] + '</div></div>';
    }
}

$(document).ready(function () {

    $(".buddy").on("swiperight", function () {
        $(this).addClass('rotate-left').delay(700).fadeOut(1);
        $('.buddy').find('.status').remove();

        $(this).append('<div class="status like">Like!</div>');
        if ($(this).is(':last-child')) {
            $('.buddy:nth-child(1)').removeClass('rotate-left rotate-right').fadeIn(300);
        } else {
            $(this).next().removeClass('rotate-left rotate-right').fadeIn(400);
        }
    });

    $(".buddy").on("swipeleft", function () {
        $(this).addClass('rotate-right').delay(700).fadeOut(1);
        $('.buddy').find('.status').remove();
        $(this).append('<div class="status dislike">Dislike!</div>');

        if ($(this).is(':last-child')) {
            $('.buddy:nth-child(1)').removeClass('rotate-left rotate-right').fadeIn(300);
        } else {
            $(this).next().removeClass('rotate-left rotate-right').fadeIn(400);
        }
    });

});

function swipe() {
    let miam = document.getElementById("miam");
    let beurk = document.getElementById("beurk");

    beurk.onclick = function () {
        $('.buddy').addClass('rotate-right').delay(700).fadeOut(1);
        $('.buddy').find('.status').remove();
        $('.buddy').append('<div class="status dislike">Dislike!</div>');

        if ($('.buddy').is(':last-child')) {
            $('.buddy:nth-child(1)').removeClass('rotate-left rotate-right').fadeIn(300);
        } else {
            $('.buddy').next().removeClass('rotate-left rotate-right').fadeIn(400);
        }
    };
    miam.onclick = function () {
        $('.buddy').addClass('rotate-left').delay(700).fadeOut(1);
        $('.buddy').find('.status').remove();

        $('.buddy').append('<div class="status like">Like!</div>');
        if ($('.buddy').is(':last-child')) {
            $('.buddy:nth-child(1)').removeClass('rotate-left rotate-right').fadeIn(300);
        } else {
            $('.buddy').next().removeClass('rotate-left rotate-right').fadeIn(400);
        }
    }
}

swipe();
profiles();
printCards();