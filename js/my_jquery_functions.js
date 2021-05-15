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

//xu ly onlick name update on cart
$("#update").on("click", function() {
    // alert("Nhấp rồi");
    $("#form_cart").submit();
})

function viewDetail(id) {
    var str = '#table_content' + id;
    // alert(str);

    if ($(str).css('display') == 'none') {
        $(str).css('display', 'block');
    } else {
        $(str).css('display', 'none');
    }
}

// $(document).ready(function txtSearch(id, txt) {
//     var str = '#table_content' + id;
//     if (txt == ' ') {
//         $(str).css('display', 'block');
//     } else {
//         $(str).css('display', 'none');
//     }
// })

function proFileBlock(id) {
    var str = '#block-profile' + id;

    $(str).css('display', 'block');
}

function proFileNone(id) {
    var str = '#block-profile' + id;

    $(str).css('display', 'none');
}

//profile
function updatePassword() {
    $('#detail').css('display', 'none');
    $('#up-password').css('display', 'block');
}

function updateDetail() {
    $('#detail').css('display', 'none');
    $('#up-detail').css('display', 'block');
}

function packToDetail() {
    $('#detail').css('display', 'block');
    $('#up-password').css('display', 'none');
    $('#up-detail').css('display', 'none');
}

function submitForm() {
    if ($('#up-password').css('display') == 'block') {
        $('#form-password').submit();
    } else {
        $('#form-detail').submit();
    }
}