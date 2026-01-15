// Каталог - переключение таблица / карточки
const tableBtn = document.getElementById("tableViewBtn");
const gridBtn = document.getElementById("gridViewBtn");
const tableView = document.getElementById("tableView");
const gridView = document.getElementById("gridView");

tableBtn.addEventListener("click", () => {
    tableView.style.display = "block";
    gridView.style.display = "none";
});
gridBtn.addEventListener("click", () => {
    tableView.style.display = "none";
    gridView.style.display = "flex";
});

// Слайдер главной страницы
const slides = document.querySelectorAll(".slide");
const dots = document.querySelectorAll(".dot");
let current = 0;

function showSlide(index) {
    slides.forEach((slide,i)=>{
        slide.style.display = i===index?"block":"none";
        dots[i].classList.toggle("active", i===index);
    });
}
function nextSlide(){ current=(current+1)%slides.length; showSlide(current);}
function prevSlide(){ current=(current-1+slides.length)%slides.length; showSlide(current);}
document.querySelector(".next").addEventListener("click", nextSlide);
document.querySelector(".prev").addEventListener("click", prevSlide);
dots.forEach((dot,i)=>{dot.addEventListener("click",()=>{current=i; showSlide(current);});});
setInterval(nextSlide,3000);
showSlide(current);
