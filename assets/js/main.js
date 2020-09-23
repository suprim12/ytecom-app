const logform = document.querySelector("#log-form");
const regform = document.querySelector("#reg-form");
if (logform) {
  logform.addEventListener("submit", handlelogSubmit);
}
if (regform) {
  regform.addEventListener("submit", handleregSubmit);
}

// IsEmpty
function isEmpty(value) {
  var isEmptyObject = function (a) {
    if (typeof a.length === "undefined") {
      // it's an Object, not an Array
      var hasNonempty = Object.keys(a).some(function nonEmpty(element) {
        return !isEmpty(a[element]);
      });
      return hasNonempty ? false : isEmptyObject(Object.keys(a));
    }

    return !a.some(function nonEmpty(element) {
      // check if array is really not empty as JS thinks
      return !isEmpty(element); // at least one element should be non-empty
    });
  };
  return (
    value == false ||
    typeof value === "undefined" ||
    value == null ||
    (typeof value === "object" && isEmptyObject(value))
  );
}

function isEmail(email) {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email.toLowerCase());
}

// SetError
function setError(inputel, msg) {
  const formgroup = inputel.parentElement;
  const formerror = formgroup.querySelector(".form-error--feedback");
  if (!formgroup.classList.contains("error")) {
    formgroup.classList.add("error");
    formerror.innerHTML = msg;
  }
}

// Clear Error
function setErrorClear(inputel) {
  const formgroup = inputel.parentElement;
  const formerror = formgroup.querySelector(".form-error--feedback");
  if (formgroup.classList.contains("error")) {
    formgroup.classList.remove("error");
    formerror.innerHTML = null;
  }
}

const emptycheck = (el) => {
  if (isEmpty(el.value)) {
    setError(el, "All fields are Required.");
    return false;
  } else {
    setErrorClear(el);
    return true;
  }
};

const emailcheck = (el) => {
  if (!isEmail(el.value)) {
    setError(el, "Inavlid Email Address.");
    return false;
  } else {
    setErrorClear(el);
    return true;
  }
};

const matchPassword = (pass1, pass2) => {
  if (pass1.value === pass2.value) {
    setErrorClear(pass1);
    return true;
  } else {
    setError(pass1, "Password do not match.");
    return false;
  }
};

//  Handle Login Validation
function loginValidation() {
  const logusername = document.querySelector("#log-username");
  const logpassword = document.querySelector("#log-password");
  // Empty Check
  emptycheck(logusername);
  emptycheck(logpassword);
  if (emptycheck(logusername) && emptycheck(logpassword)) {
    return true;
  } else {
    return false;
  }
}
//  Handle Register Validation
function regValidation() {
  const regusername = document.querySelector("#reg-username");
  const regpassword = document.querySelector("#reg-password");
  const regemail = document.querySelector("#reg-email");
  const confirm_password = document.querySelector("#confirm_password");
  // Empty Check
  let validuser = emptycheck(regusername);
  let validpass = emptycheck(regpassword);
  let validemail = emptycheck(regemail);
  let validcpassword = emptycheck(confirm_password);
  if (validemail) {
    emailcheck(regemail);
  }
  if (validcpassword) {
    matchPassword(regpassword, confirm_password);
  }

  if (validuser && validpass && validemail && validcpassword) {
    return true;
  } else {
    return false;
  }
}

// Handle Login Submit
async function handlelogSubmit(e) {
  e.preventDefault();
  // handle Login validation
  let valid = await loginValidation();
  if (valid === true) {
    let url = ytecom_obj.ajax_url;
    let msg = document.querySelector("#logformEror");
    let data = {
      _wpnonce: document.querySelector("#_wpnonce").value,
      username: document.querySelector("#log-username").value,
      password: document.querySelector("#log-password").value,
      action: "ytecom_login_account",// IMPORTANT MUST BE SAME 
    };

    let formdata = new FormData();
    formdata.append("_wpnonce", data._wpnonce);
    formdata.append("username", data.username);
    formdata.append("password", data.password);
    formdata.append("action", data.action);

    try {
      let res = await fetch(url, {
        method: "post",
        body: formdata,
      });

      let resdata = await res.json();

      if (resdata.status === 2) {
        location.href = ytecom_obj.home_url;
      } else {
        msg.innerHTML = resdata.msg;
        msg.classList.add("error");
      }

      console.log(resdata);
    } catch (err) {
      console.error(err);
    }
  }
}

// Handle Register Submit
async function handleregSubmit(e) {
  e.preventDefault();
  let valid = await regValidation();
  // ALL CLIENT SIDE VALIDATION ARE TRUE THEN
  if (valid === true) {
    console.log(ytecom_obj);
    let url = ytecom_obj.ajax_url;
    let msg = document.querySelector("#regformEror");

    let data = {
      _wpnonce: document.querySelector("#_wpnonce").value,
      username: document.querySelector("#reg-username").value,
      email: document.querySelector("#reg-email").value,
      password: document.querySelector("#reg-password").value,
      confirm_password: document.querySelector("#confirm_password").value,
      action: "ytecom_create_account",
    };

    let formdata = new FormData();
    formdata.append("_wpnonce", data._wpnonce);
    formdata.append("username", data.username);
    formdata.append("email", data.email);
    formdata.append("password", data.password);
    formdata.append("confirm_password", data.confirm_password);
    formdata.append("action", data.action);

    try {
      let res = await fetch(url, {
        method: "post",
        body: formdata,
      });

      let resdata = await res.json();

      if (resdata.status === 2) {
        location.href = ytecom_obj.home_url;
      } else {
        msg.innerHTML = resdata.msg;
        msg.classList.add("error");
      }

      console.log(resdata);
    } catch (err) {
      console.error(err);
    }
  }
}
