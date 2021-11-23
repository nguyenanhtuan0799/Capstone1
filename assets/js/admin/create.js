const createURL = "http://localhost/caps1/api/admin/create.php";
let tableContent = document.querySelector(".js-table-content");

// create
function createEmployee(formData, callback) {
  let option = {
    method: "POST",
    header: {
      "Content-Type": "application/json",
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Credentials": true,
    },
    body: JSON.stringify(formData),
  };
  fetch(createURL, option)
    .then((response) => {
      response;
    })
    .then(callback)
    .catch((error) => console.log(error));
}
function handelCreate() {
  let userName = document.querySelector("input[name='username']").value;
  let password = document.querySelector("input[name='password']").value;
  let type = document.querySelector("#type").value;
  let formData = {
    user_name: userName,
    password: password,
    role_id: type,
  };
  if (userName && password && type) {
    createEmployee(formData);
    alert("Create Account Successfully");
    document.querySelector("input[name='username']").value = "";
    document.querySelector("input[name='password']").value = "";
    document.querySelector("#type").value = "(Choose another Type)";
  } else {
    alert("Please not be blank");
  }
}
