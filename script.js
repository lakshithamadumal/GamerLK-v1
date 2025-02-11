function ChangeView() {
    var SignUpBox = document.getElementById("SignUpBox");
    var SignInBox = document.getElementById("SignInBox");

    SignUpBox.classList.toggle("d-none");
    SignInBox.classList.toggle("d-none");

}


const bar = document.getElementById('bar');
const nav = document.getElementById('navbar');
const close = document.getElementById('close');

if (bar) {
    bar.addEventListener('click', () => {
        nav.classList.add('active');
    })
}

if (close) {
    close.addEventListener('click', () => {
        nav.classList.remove('active');
    })
}


function signUp() {

    var fn = document.getElementById("fname");
    var ln = document.getElementById("lname");
    var e = document.getElementById("email");
    var pw = document.getElementById("password");
    var m = document.getElementById("mobile");
    var g = document.getElementById("gender");

    var f = new FormData();
    f.append("fname", fn.value);
    f.append("lname", ln.value);
    f.append("email", e.value);
    f.append("password", pw.value);
    f.append("mobile", m.value);
    f.append("gender", g.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {

                document.getElementById("msg").innerHTML = t;
                document.getElementById("msg").className = "alert alert-success";
                document.getElementById("msgdiv").className = "d-block";

            } else {

                document.getElementById("msg").innerHTML = t;
                document.getElementById("msgdiv").className = "d-block";

            }

        }
    }

    r.open("POST", "signUpProcess.php", true);
    r.send(f);

}

function signin() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberme = document.getElementById("rememberme");

    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "home.php";

            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "signinProcess.php", true);
    r.send(f);
}

var bm;
function forgotPassword() {

    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                var m = document.getElementById("forgotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();

            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();

}

function resetPassword() {
    var email = document.getElementById("email2");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");


    var f = new FormData();
    f.append("e", email.value);
    f.append("np", np.value);
    f.append("rnp", rnp.value);
    f.append("vc", vc.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {
                bm.hide();
                alert("Your Password has been Updated.")
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "resetPasswordProcess.php", true);
    r.send(f);




}
function showPassword() {
    var np = document.getElementById("np");
    var npb = document.getElementById("npb");

    if (np.type == "password") {
        np.type = "text";
        npb.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
    } else {
        np.type = "password";
        npb.innerHTML = '<i class="fa-solid fa-eye"></i>';

    }

}

function showPassword2() {
    var rnp = document.getElementById("rnp");
    var rnpb = document.getElementById("rnpb");

    if (rnp.type == "password") {
        rnp.type = "text";
        rnpb.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
    } else {
        rnp.type = "password";
        rnpb.innerHTML = '<i class="fa-solid fa-eye"></i>';

    }

}

function showPassword3() {
    var np = document.getElementById("pw");
    var npb = document.getElementById("pwb");

    if (np.type == "password") {
        np.type = "text";
        npb.innerHTML = '<i class="fa-solid fa-eye"></i>';
    } else {
        np.type = "password";
        npb.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';

    }

}


function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {

                window.location.reload();

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "signoutProcess.php", true);
    r.send();

}

function updateProfile() {


    var profile_img = document.getElementById("profileImage");
    var first_name = document.getElementById("fname");
    var last_name = document.getElementById("lname");
    var mobile_no = document.getElementById("mobile");
    var password = document.getElementById("pw");
    var email_address = document.getElementById("email");
    var contry = document.getElementById("contry");

    var f = new FormData();
    f.append("img", profile_img.files[0]);
    f.append("fn", first_name.value);
    f.append("ln", last_name.value);
    f.append("mn", mobile_no.value);
    f.append("pw", password.value);
    f.append("ea", email_address.value);
    f.append("p", contry.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                window.location = "userProfile.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "userProfileUpdateProcess.php", true);
    r.send(f);

}

function basicSearch(x) {
    var text = document.getElementById("kw").value;
    var select = document.getElementById("c").value;

    var f = new FormData();
    f.append("t", text);
    f.append("s", select);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
        }
    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);
}
function advancedSearch(x) {

    var txt = document.getElementById("t");
    var category = document.getElementById("c1");
    var brand = document.getElementById("b1");
    var from = document.getElementById("pf");
    var to = document.getElementById("pt");
    var sort = document.getElementById("s");

    var f = new FormData();

    f.append("t", txt.value);
    f.append("cat", category.value);
    f.append("b", brand.value);
    f.append("pf", from.value);
    f.append("pt", to.value);
    f.append("s", sort.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("view_area").innerHTML = t;
        }
    }

    r.open("POST", "advancedSearchProcess.php", true);
    r.send(f);

}

function changeMainImg(id) {

    var new_img = document.getElementById("product_img" + id).src;
    var main_img = document.getElementById("mainImg");

    main_img.style.backgroundImage = "url(" + new_img + ")";

}
function addToWatchlist(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "Added") {
                alert("Game added to the watchlist");
                window.location.reload();
            } else if (t == "Removed") {
                alert("Game removed from watchlist");
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "addWatchListProcess.php?id=" + id, true);
    r.send();

}
function removeFromWatchlist(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "Deleted") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "removeFromWatchListProcess.php?id=" + id, true);
    r.send();
}

function addToCart(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();
}


function removeFromCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "deleted") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "removeFromCartProcess.php?id=" + id, true);
    r.send();

}

function paynow(pid) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            if (obj.error) {
                alert(obj.error);
                window.location = "index.php";
                return;
            }

            var umail = obj["umail"];
            var amount = obj["amount"];

            payhere.onCompleted = function onCompleted(orderId) {
                console.log("Payment completed. OrderID:" + orderId);
                //alert("Payment completed. OrderID:" + orderId);
                saveInvoice(orderId, pid, umail, amount);            };

            payhere.onDismissed = function onDismissed() {
                console.log("Payment dismissed");
            };

            payhere.onError = function onError(error) {
                console.log("Error:" + error);
            };

            var payment = {
                "sandbox": true,
                "merchant_id": "1224279",
                "return_url": "http://localhost/gamerlk/singleProductView.php?id=" + pid,
                "cancel_url": "http://localhost/gamerlk/singleProductView.php?id=" + pid,
                "notify_url": "http://sample.com/notify",
                "order_id": obj["id"],
                "items": obj["item"],
                "amount": amount,
                "currency": obj["currency"],
                "hash": obj["hash"],
                "first_name": obj["fname"],
                "last_name": obj["lname"],
                "email": umail,
                "phone": obj["mobile"],
                "address": obj["address"], // Keep it empty
                "city": obj["city"], // Keep it empty
                "country": "Sri Lanka",
                "delivery_address": obj["address"], // Keep it empty
                "delivery_city": obj["city"], // Keep it empty
                "delivery_country": "Sri Lanka",
                "custom_1": "",
                "custom_2": ""
            };

            payhere.startPayment(payment);
        }
    }

    r.open("GET", "payNowProcess.php?id=" + pid, true);
    r.send();
}

function checkOut() {
    alert("ok");

   var f = new FormData();
   f.append("cart",true);

   var request = new XMLHttpRequest();
   request.onreadystatechange = function () {
       if (request.readyState == 4 && request.status == 200) {
           var responce = request.responseText;
           // alert(responce);
           var payment = JSON.parse(responce);
           doCheckout(payment, "checkoutProcess.php");
       }
   }

   request.open("POST","paymentProcess.php",true);
   request.send(f);
}

function doCheckout(payment, path) {
   payhere.onCompleted = function onCompleted(orderId) {
       console.log("Payment completed. OrderID:" + orderId);

       var f = new FormData();
       f.append("payment", JSON.stringify(payment));

       var request = new XMLHttpRequest();
       request.onreadystatechange = function () {
           if (request.readyState == 4 & request.status == 200) {
               var responce = request.responseText;
               var order = JSON.parse(responce);

               if (order.resp == "Success") {
                   console.log("Order completed with ID: " + order.order_id);
                   window.location = "invoice.php?orderId=" + order.order_id; // Fixed key name
               } else {
                   alert(responce);
               }
           }
       };

       request.open("POST", path, true);
       request.send(f);
   };

   // Payment window closed
   payhere.onDismissed = function onDismissed() {
       // Note: Prompt user to pay again or show an error page
       console.log("Payment dismissed");
   };

   // Error occurred
   payhere.onError = function onError(error) {
       // Note: show an error page
       console.log("Error:"  + error);
   };

   // Show the payhere.js popup, when "PayHere Pay" is clicked
   // document.getElementById('payhere-payment').onclick = function (e) {
       payhere.startPayment(payment);
   // };
}


function saveInvoice(orderId, pid, umail, amount) {

    var f = new FormData();
    f.append("o", orderId);
    f.append("i", pid);
    f.append("m", umail);
    f.append("a", amount);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {

                window.location = "invoice.php?id=" + orderId;

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveInvoiceProcess.php", true);
    r.send(f);

}

function printInvoice() {
    var restorepage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;
}

function printInvoice1() {
    window.print();
}




var m;
function addFeedback(id) {
    
    var feedbackModal = document.getElementById("feedbackModal" + id);
    m = new bootstrap.Modal(feedbackModal);
    m.show();
}

function saveFeedback(id) {

    var type;

    if (document.getElementById("type1").checked) {
        type = 1;
    } else if (document.getElementById("type2").checked) {
        type = 2;
    } else if (document.getElementById("type3").checked) {
        type = 3;
    }

    var feedback = document.getElementById("feed");

    var f = new FormData();
    f.append("pid", id);
    f.append("t", type);
    f.append("feed", feedback.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                alert("Feedback Added.");
                m.hide();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveFeedbackProcess.php", true);
    r.send(f);

}

var av;
function adminVerification() {
    var email = document.getElementById("e");

    var f = new FormData();
    f.append("e", email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                var adminVerificationModal = document.getElementById("verificationModal");
                av = new bootstrap.Modal(adminVerificationModal);
                av.show();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "adminVerificationProcess.php", true);
    r.send(f);
}

function verify() {
    var verification = document.getElementById("vcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                av.hide();
                window.location = "adminPanel.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "verificationProcess.php?v=" + verification.value, true);
    r.send();
}

function blockUser(email) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var txt = request.responseText;
            if (txt == "blocked") {
                document.getElementById("ub" + email).innerHTML = ".";
                document.getElementById("ub" + email).classList = "btn btn-danger";
                window.location.reload();

            } else if (txt == "unblocked") {
                document.getElementById("ub" + email).innerHTML = ".";
                document.getElementById("ub" + email).classList = "btn btn-success";
                window.location.reload();

            } else {
                alert(txt);
            }
        }
    }

    request.open("GET", "userBlockProcess.php?email=" + email, true);
    request.send();

}

function blockProduct(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var txt = request.responseText;
            if (txt == "blocked") {
                document.getElementById("pb" + id).innerHTML = ".";
                document.getElementById("pb" + id).classList = "btn btn-fuck ";
                window.location.reload();

            } else if (txt == "unblocked") {
                document.getElementById("pb" + id).innerHTML = ".";
                document.getElementById("pb" + id).classList = "btn btn-success";
                window.location.reload();

            } else {
                alert(txt);
            }
        }
    }

    request.open("GET", "productBlockProcess.php?id=" + id, true);
    request.send();

}

var mm;
function viewMsgModal(email) {
    var m = document.getElementById("userMsgModal" + email);
    mm = new bootstrap.Modal(m);
    mm.show();
}

var pm;
function viewProductModal(id) {
    var m = document.getElementById("viewProductModal" + id);
    pm = new bootstrap.Modal(m);
    pm.show();
}



var cm;
function addNewCategory() {
    var m = document.getElementById("addCategoryModal");
    cm = new bootstrap.Modal(m);
    cm.show();
}


var tm;
function addNewType() {
    var m = document.getElementById("addTypeModal");
    tm = new bootstrap.Modal(m);
    tm.show();
}

var vc;
var e;
var n;
function verifyCategory() {
    var ncm = document.getElementById("addCategoryVerificationModal");
    vc = new bootstrap.Modal(ncm);

    e = document.getElementById("e").value;
    n = document.getElementById("n").value;

    var f = new FormData();
    f.append("email", e);
    f.append("name", n);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                cm.hide();
                vc.show();
            } else {
                alert(t);
            }
        }
    }
    r.open("POST", "addNewCategoryProcess.php", true);
    r.send(f);
}



var tvc;
var type_email;
var type_name;
function verifyType() {
    var tncm = document.getElementById("addTypeVerificationModal");
    tvc = new bootstrap.Modal(tncm);

    type_email = document.getElementById("admin_email_t").value;
    type_name = document.getElementById("type_name").value;

    var f = new FormData();
    f.append("email", type_email);
    f.append("name", type_name);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                tm.hide();
                tvc.show();
            } else {
                alert(t);
            }
        }
    }
    r.open("POST", "addNewTypeProcess.php", true);
    r.send(f);
}


function removeC(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "Deleted") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "removeCProcess.php?id=" + id, true);
    r.send();
}


function removeT(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "Deleted") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "removeTProcess.php?id=" + id, true);
    r.send();
}


function saveCategory() {
    var txt = document.getElementById("txt").value;

    var f = new FormData();
    f.append("t", txt);
    f.append("e", e);
    f.append("n", n);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                vc.hide();
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "SaveCategoryProcess.php", true);
    r.send(f);
}


function saveType() {
    var txt = document.getElementById("v_code").value;

    var f = new FormData();
    f.append("t", txt);
    f.append("e", type_email);
    f.append("n", type_name);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                tvc.hide();
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "SaveTypeProcess.php", true);
    r.send(f);
}

function changeInvoiceStatus(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == 1) {
                document.getElementById("btn" + id).innerHTML = "Packing";
                document.getElementById("btn" + id).classList = "btn btn-warning fw-bold mt-1 mb-1";
            } else if (t == 2) {
                document.getElementById("btn" + id).innerHTML = "Dispatch";
                document.getElementById("btn" + id).classList = "btn btn-info fw-bold mt-1 mb-1";
            } else if (t == 3) {
                document.getElementById("btn" + id).innerHTML = "Shipping";
                document.getElementById("btn" + id).classList = "btn btn-primary fw-bold mt-1 mb-1";
            } else if (t == 4) {
                document.getElementById("btn" + id).innerHTML = "Delivered";
                document.getElementById("btn" + id).classList = "btn btn-danger fw-bold mt-1 mb-1 disabled";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "changeInvoiceStatusProcess.php?id=" + id, true);
    r.send();

}

function searchInvoiceId() {
    var txt = document.getElementById("searchtxt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("viewArea").innerHTML = t;

        }
    }

    r.open("GET", "searchInvoiceIdProcess.php?id=" + txt, true);
    r.send();
}

function findSellings() {

    var from = document.getElementById("from").value;
    var to = document.getElementById("to").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("viewArea").innerHTML = t;
        }
    }

    r.open("GET", "findSellingsProcess.php?f=" + from + "&t=" + to, true);
    r.send();

}

//var cam;
//function contactAdmin(email) {
//    var m = document.getElementById("contactAdmin");
//    cam = new bootstrap.Modal(m);
//    cam.show();
//}

function contactAdmin() {
    window.open("https://mail.google.com/mail/?view=cm&amp;to=gamerlk888@gmail.com&amp;su=New%20User&amp;body=Hello%2C%20I%20need%20help%20from%20you.", "_blank");

}

function contactAdminNotUser() {
    window.open("https://mail.google.com/mail/?view=cm&amp;to=gamerlk888@gmail.com&amp;su=New%20User&amp;body=Hello%2C%20I%20need%20help%20from%20you.", "_blank");
}

function sendAdminMsg() {
    var txt = document.getElementById("msgtxt").value;

    var f = new FormData();
    f.append("t", txt);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("POST", "sendAdminMessageProcess.php", true);
    r.send(f);
}

function sendAdminMsg(email) {
    var txt = document.getElementById("msgtxt").value;

    var f = new FormData();
    f.append("t", txt);
    f.append("r", email);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("POST", "sendAdminMessageProcess.php", true);
    r.send(f);
}


$('#printInvoice').click(function () {
    Popup($('.invoice')[0].outerHTML);
    function Popup(data) {
        window.print();
        return true;
    }
});


function removeP(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "Deleted") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "removePProcess.php?id=" + id, true);
    r.send();
}

function sendId(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "updateProduct.php";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "sendIdProcess.php?id=" + id, true);
    r.send();

}


function changeProductImage() {

    var images = document.getElementById("imageuploader");

    images.onchange = function () {

        var file_count = images.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);
                document.getElementById("i" + x).src = url;
            }

        } else {
            alert(file_count + " files uploaded. You are proceed to upload 03 or less than 03 files.");
        }

    }

}



function addProduct() {

    var category = document.getElementById("category");
    var game_type = document.getElementById("game_type");
    var title = document.getElementById("title");
    var link = document.getElementById("link");
    var cost = document.getElementById("cost");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("ca", category.value);
    f.append("b", game_type.value);
    f.append("t", title.value);
    f.append("gl", link.value);
    f.append("cost", cost.value);
    f.append("desc", desc.value);

    var file_count = image.files.length;
    for (var x = 0; x < file_count; x++) {
        f.append("img" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                alert("Game added successfully");
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "addProductProcess.php", true);
    r.send(f);

}

function updateProduct() {
    var title = document.getElementById("t");
    var price = document.getElementById("pr");
    var description = document.getElementById("d");
    var link = document.getElementById("gl");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("t", title.value);
    f.append("pr", price.value);
    f.append("d", description.value);
    f.append("gl", link.value);

    var file_count = image.files.length;
    for (var x = 0; x < file_count; x++) {
        f.append("i" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {

                window.location = "myProducts.php";
            } else if (t == "Invalid Image Count") {

                if (confirm("Don't you want to update Product Images?") == true) {
                    alert("Game Update successfully");

                    window.location = "myProducts.php";
                } else {
                    alert("Select images.");
                }
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateProductProcess.php", true);
    r.send(f);
}


const slider = document.querySelector('.slider');

function activate(e) {
    const items = document.querySelectorAll('.item');
    e.target.matches('.next') && slider.append(items[0])
    e.target.matches('.prev') && slider.prepend(items[items.length - 1]);
}

document.addEventListener('click', activate, false);

function download() {
    print()
}
