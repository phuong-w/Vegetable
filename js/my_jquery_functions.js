// let num = 0;
// $(".next").on("click", function() {
//     if (num == -60) {
//         num = 0;
//     } else {
//         num += -20;
//         $(".s1").css("margin-left", num + "%");
//     }
// })

// var counter = 1;
// setInterval(function() {
//     $("#radio" + counter).prop("checked", true);
//     counter++;
//     if (counter > 4) {
//         counter = 1;
//     }
// }, 3000);


$("#click_login").on("click", function() {
    $(".login-form").css("display", "block");
    $(".register").css("display", "none");
})

$("#click_register").on("click", function() {
    $(".register").css("display", "block");
    $(".login-form").css("display", "none");
})

$(".close").on("click", function() {
    $(".login-form").css("display", "none");
    $(".register").css("display", "none");
})

// $(".btnSubmit").on("click", function(e) {
//     e.preventDefault();
// })