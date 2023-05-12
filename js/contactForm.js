const fullName = document.querySelector("#name");
const email = document.querySelector("#email");
const message = document.querySelector("#message");
const submit = document.querySelector("#formSubmit");
const subject = document.querySelector("#subject");
const fullNameError = document.querySelector("#nameError");
const emailError = document.querySelector("#emailError");
const messageError = document.querySelector("#messageError");
const subjectError = document.querySelector("#subjectError");
const form = document.querySelector("#contactForm");
const formH1 = document.querySelector("#aboutH1");

function validFullName() {
  fullNameError.innerHTML = "Your submitted name is valid!";
  fullNameError.style.color = "green";
  fullNameError.style.opacity = "1";
  fullName.style.border = "1px solid green";
}

// FULL NAME
function invalidFullName() {
  nameError.innerHTML = "Please enter your full name (Min. 6 characters)";
  nameError.style.color = "red";
  nameError.style.opacity = "1";
  fullName.style.border = "1px solid red";
}

fullName.oninput = function () {
  if (fullName.value.length > 5) {
    validFullName();
  } else {
    nameError.style.opacity = "0";
  }
};

email.onclick = function () {
  if (fullName.value.length > 5) {
    validFullName();
  } else {
    invalidFullName();
  }
};

// EMAIL

function validateEmail(email) {
  const regEx = /\S+@\S+\.\S+/;
  const patternMatches = regEx.test(email);
  return patternMatches;
}

function validEmail() {
  emailError.innerHTML = "Your email is valid!";
  emailError.style.color = "green";
  emailError.style.opacity = "1";
  email.style.border = "1px solid green";
}

function invalidEmail() {
  emailError.innerHTML = "Please enter a valid email address";
  emailError.style.color = "red";
  emailError.style.opacity = "1";
  email.style.border = "1px solid red";
}

email.oninput = function () {
  const patternMatches = validateEmail(email.value);
  if (patternMatches) {
    validEmail();
  } else {
    emailError.style.opacity = "0";
  }
};

subject.onclick = function () {
  const patternMatches = validateEmail(email.value);
  if (patternMatches === false) {
    invalidEmail();
  } else {
    validEmail();
  }
};

// SUBJECT

function invalidSubject() {
  subjectError.innerHTML = "Please enter a subject (Min. 16 characters)";
  subjectError.style.color = "red";
  subjectError.style.opacity = "1";
  subject.style.border = "1px solid red";
}

function validSubject() {
  subjectError.innerHTML = "Your subject is valid!";
  subjectError.style.color = "green";
  subjectError.style.opacity = "1";
  subject.style.border = "1px solid green";
}

subject.oninput = function () {
  if (subject.value.length > 15) {
    validSubject();
  } else {
    subjectError.style.opacity = "0";
  }
};

message.onclick = function () {
  if (subject.value.length < 15) {
    invalidSubject();
  } else {
    subjectError.style.opacity = "1";
  }
};

// MESSAGE

function invalidMessage() {
  messageError.innerHTML = "Please enter a message (Min. 26 characters)";
  messageError.style.color = "red";
  messageError.style.opacity = "1";
  message.style.border = "1px solid red";
}

function validMessage() {
  messageError.innerHTML = "Your message is valid!";
  messageError.style.color = "green";
  messageError.style.opacity = "1";
  message.style.border = "1px solid green";
}

submit.onclick = function (event) {
  event.preventDefault();
  if (fullName.value.length < 6) {
    invalidFullName();
  }
  if (subject.value.length < 6) {
    invalidSubject();
  }
  if (!validateEmail(email.value)) {
    invalidEmail();
  }
  if (
    message.value.length > 25 &&
    subject.value.length > 15 &&
    validateEmail(email.value) &&
    fullName.value.length > 5
  ) {
    validMessage();
    validSubject();
    validEmail();
    validFullName();
    aboutH1.innerHTML = "Thank you for your message!";
    form.style.fontSize = "1.3rem";
    form.innerHTML = "We will get back to you as soon as possible!";
  } else if (message.value.length > 25) {
    validMessage();
  } else {
    invalidMessage();
  }
};

message.oninput = function () {
  if (message.value.length > 25) {
    validMessage();
  } else {
    messageError.style.opacity = "0";
  }
};
