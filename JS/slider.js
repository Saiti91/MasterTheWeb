const slide = ["concert1.webp", "chanteur.webp", "chanteur1.webp", "concert2.webp"];
let num = 0;

function ChangeSlide(sens) {
    num = num + sens;
    if (num > 3)
        num = 0;
    if (num < 0)
        num = 3;
    document.getElementById("slide").src = "../asset/" + slide[num];

}

setInterval("ChangeSlide(1)", 5000);

