
let elmPicture =  document.querySelector("#picture");
let pictureName = "";

elmPicture.addEventListener("change", () => {
    pictureName = elmPicture.options[elmPicture.selectedIndex].text;
    console.log(pictureName);

    //nyní provedem AJAX
    $.ajax({
        type: "POST",
        url: "admin.php",
        data: {
            pictureSubmit: true,
            pictureName: pictureName}
    });

    window.location.reload();

});

