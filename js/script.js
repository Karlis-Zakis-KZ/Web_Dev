
function cCheckBox() {
  let checkBox = document.getElementById("policy");
  let span2 = document.getElementById("error2");
  if (checkBox.checked == true) {
    span2.innerHTML = "";
    return true;
  } else {
    span2.innerHTML = "<li>You must accept the terms and conditions</li>";
    return false;
  }
}
function validateEmail() {
  let span = document.getElementById("error");
  let email = document.getElementById("email").value;
  if (
    /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(
      email
    )
  ) {
    let domain = email.substring(email.indexOf("."));
    if (domain == ".co") {
      span.innerHTML =
        "<li>We are not accepting subscriptions from Colombia emails </li>";
      return false;
    } else {
      span.innerHTML = "";
      return true;
    }
  }
  span.innerHTML = "<li>Please provide a valid e-mail address</li>";
  return false;
}

function submit() {
  let span = document.getElementById("error");
  let email = document.getElementById("email").value;
  if (email.length == 0) {
    span.innerHTML = "<li>Email address is required</li>";
    cCheckBox();
    return false;
  }
  let checkEmail = validateEmail();
  let checkBox = cCheckBox();
  if (checkBox && checkEmail) {
    document.getElementById("form").style.display = "none";
    document.getElementById("partOne").style.display = "none";
    document.getElementById("success").style.display = "inline";
    return true;
  }
}
