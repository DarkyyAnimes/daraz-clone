function carausel(){
    var swiper = new Swiper(".mySwiper", {
        rewind: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
          },
        pagination: {
            el: ".swiper-pagination",
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });

    var yswiper = new Swiper(".yourSwiper", {
        rewind: true,
        slidesPerView: 5,
        spaceBetween: 10,
        allowTouchMove : true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
          },
        pagination: {
            el: ".swiper-pagination",
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });

}


function LetterLimit(elements, num){
    elements = Array.from(elements);

    elements.forEach(function(e) {
        let arrayOfWords = e.innerHTML.split(" ");

        if(arrayOfWords.length > num){
            arrayOfWords.length = num;     
            e.innerHTML = arrayOfWords.join(" ")   ;
            e.innerHTML += "..."
        }

    })
}

let titles = document.querySelectorAll('.item-card > .card-body > .title');

LetterLimit(titles, 5)





function helo(){

    
  let image = document.getElementById("main-image");
  let bigImage = document.getElementById("big-image");
  let sms = document.getElementById("b-im");

  image.addEventListener("mouseover", (e) => {
    sms.classList.add("active")
  })
  image.addEventListener("mouseout", (e) => {
    sms.classList.remove("active")
  })

}

function hii(){
  let imageArray = Array.from(document.querySelectorAll(".down-image"));

  imageArray.forEach((e, index) => {
    e.addEventListener("mouseover", () => {
      let source = e.firstElementChild.src;
      image.src = source
    })
    e.removeEventListener('mouseover')
  })
}



function date_product(){
  let dateVal = document.getElementById('date_product');

  let todayDate = new Date();
  let twoDaysLater = new Date(todayDate);
  twoDaysLater.setDate(todayDate.getDate() + 2);

  let daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
  let months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

  let todayFormatted =   todayDate.getDate()+ " " +months[todayDate.getMonth()];
  let twoDaysLaterFormatted = twoDaysLater.getDate()  + " " +months[twoDaysLater.getMonth()];

  todayFormatted + "-" + twoDaysLaterFormatted;
  dateVal.innerHTML = todayFormatted + "-" + twoDaysLaterFormatted;

}

try {  
  date_product()
} catch (error) {
  
}


try {
  hii()

} catch (error) {
  
}


carausel()