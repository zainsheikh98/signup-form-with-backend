let messages = [];

function validate() {
  let firstName = document.querySelector("#firstName").value;
  let lastName = document.querySelector("#lastName").value;
  let email = document.querySelector("#email").value;
  let password = document.querySelector("#password").value;
  let confirmPassword = document.querySelector("#confirmPassword").value;
  const formData = new FormData();

  formData.append("firstName", firstName);
  formData.append("lastName", lastName);
  formData.append("email", email);
  formData.append("password", password);
  formData.append("confirmPassword", confirmPassword);

  axios
    .post("register.php", formData)
    .then((res) => alert(res.data))
    .catch((err) => console.log(err));

  return false;
}
