document.querySelector("#registrationForm").addEventListener("submit", (e) => {
  e.preventDefault();
  let form = document.querySelector("#validation_form");
  const data = new URLSearchParams();
  for (const p of new FormData(form)) {
    data.append(p[0], p[1]);
  }
  fetch("http://localhost/MyConstructor/formB.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.json())
    .then((response) => {
      if (response.result == true) {
        console.log(response.redirect);
        window.location.replace(response.redirect);
      } else {
        document.querySelector(".nameError").innerHTML =
          response.message["nameError"];
        document.querySelector(".surnameError").innerHTML =
          response.message["surnameError"];
        document.querySelector(".telephoneError").innerHTML =
          response.message["telephoneError"];
        document.querySelector(".emailError").innerHTML =
          response.message["emailError"];
        document.querySelector(".categoryError").innerHTML =
          response.message["categoryError"];
      }
    })
    .catch((error) => error);
});
