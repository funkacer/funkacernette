let windowWidth = window.innerWidth;
let letterSize = 150;
if (windowWidth < 500) {
    letterSize = 80;
} else if (windowWidth < 700) {
    letterSize = 120;
} else {
    letterSize = 150;
}

let elmImgs = document.querySelectorAll(".pismeno");

window.addEventListener("resize", () => {
    windowWidth = window.innerWidth;
    //resize just happened, pixels changed
    if (windowWidth >= 700 && letterSize < 150) {
        letterSize = 150;
        for (img of elmImgs) {
            rnd = Math.floor(Math.random()*letterSize*1/3 + letterSize*2/3);
            img.style.height = rnd + "px";
        }
    }
    else if (windowWidth < 700 && letterSize > 120) {
        letterSize = 120;
        for (img of elmImgs) {
            rnd = Math.floor(Math.random()*letterSize*1/3 + letterSize*2/3);
            img.style.height = rnd + "px";
        }
    }
    else if (windowWidth >= 500 && letterSize < 120) {
        letterSize = 120;
        for (img of elmImgs) {
            rnd = Math.floor(Math.random()*letterSize*1/3 + letterSize*2/3);
            img.style.height = rnd + "px";
        }
    }
    else if (windowWidth < 500 && letterSize > 80) {
        letterSize = 80;
        for (img of elmImgs) {
            rnd = Math.floor(Math.random()*letterSize*1/3 + letterSize*2/3);
            img.style.height = rnd + "px";
        }
    }
});

//na zacatku random vyska pismen
for (img of elmImgs) {
    rnd = Math.floor(Math.random()*letterSize*1/3 + letterSize*2/3);
    img.style.height = rnd + "px";
}

//vyska pismen se zacne menit kazdych 10s
/*
funkacerInterval = setInterval(() => {
    for (img of elmImgs) {
        rnd = Math.floor(Math.random()*letterSize*1/3 + letterSize*2/3);
        img.style.height = rnd + "px";
    }
}, 10000);

//pokud chci vybrat polozku, prestanu menit vysku pismen
let elmLis = document.querySelectorAll(".menu li");
for (li of elmLis) {
    li.addEventListener("mouseover", (e) => {
        clearInterval(funkacerInterval);
    });
    li.addEventListener("mouseleave", (e) => {
        funkacerInterval = setInterval(() => {
            for (img of elmImgs) {
                rnd = Math.floor(Math.random()*letterSize*1/3 + letterSize*2/3);
                img.style.height = rnd + "px";
            }
        }, 10000);
    })
}
*/

//pokud kliknu na .funkacer, chci zmenit vysku pismen
for (img of elmImgs) {
    img.addEventListener("mouseover", (e) => {
        for (img of elmImgs) {
            rnd = Math.floor(Math.random()*letterSize*1/3 + letterSize*2/3);
            img.style.height = rnd + "px";
        }
    });
}


