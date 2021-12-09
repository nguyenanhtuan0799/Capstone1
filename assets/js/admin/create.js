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
  let flag = true;
  let userName = document.querySelector("input[name='username']").value;
  let password = document.querySelector("input[name='password']").value;
  let type = document.querySelector("#type").value;
  const d = new Date();
  const day = d.getDate();
  const month = d.getMonth() + 1;
  const year = d.getFullYear();
  const date = `${day}/${month}/${year}`;
  // 1 username
  if (
    userName == "" ||
    userName.length < 5 ||
    !/^[a-zA-Z0-9]+$/.test(userName)
  ) {
    flag = false;
    alert("Please check again userName");
  }

  // 2. password
  if (password == "" || password.length < 6) {
    flag = false;
    alert("Please check again Password");
  }
  //type
  if (type != "1" && type != "2") {
    flag = false;
    alert("Please check again type");
  }

  if (flag) {
    let formData = {
      user_name: userName,
      password: password,
      role_id: type,
      createDate: date,
    };
    if (userName && password && type) {
      createEmployee(formData);
      alert("Create Account Successfully");
      document.querySelector("input[name='username']").value = "";
      document.querySelector("input[name='password']").value = "";
      document.querySelector("#type").value = "(Choose another Type)";
    }
  }
}
