const employeeURL = "http://localhost/caps1/api/admin/viewEmployee.php";
// const employeeURL = "http://localhost/caps1/api/admin/viewManager.php";
const deleteURL = "http://localhost/caps1/api/admin/delete.php";
const createURL = "http://localhost/caps1/api/admin/create.php";
const resetURL = "http://localhost/caps1/api/admin/resetPassword.php";

// view employee

let tableContent = document.querySelector(".js-table-content");

function start() {
  getEmployee(renderEmployee);
}

start();

//get employee
function getEmployee(callback) {
  fetch(employeeURL)
    .then((response) => response.json())
    .then(callback);
}
//render employee
function renderEmployee({ data }) {
  let contentTable = `
            <tr>
                <th>ID</th>
                <th>Avatar</th>
                <th>Username</th>
                <th>Type</th>
                <th>Fullname</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Email</th>
                <th>Delete</th>
                <th>Reset</th>
            </tr>`;
  let htmls = data.map((item, i) => {
    return `<tr>
                <td>${i}</td>
                <td><img src="${item.avatar}" style="width: 80px;
    height: 80px;"></td>
                <td>${item.user_name}</td>
                <td>${item.role_id}</td>
                <td>${item.fullname}</td>
                <td>${item.phone_number}</td>
                <td>${item.address}</td>
                <td>${item.email}</td>
                <td>
                    <div onclick="handelDelete(${item.account_id})" class="button-wrap">
                      <a>Delete</a>
                    </div>
                </td>
                <td>
                 <div onclick="handleModal(${item.account_id},'${item.user_name}')"  
                      class="button-wrap js-btn">
                      <a>Reset</a>
                    </div>
                </td>
            </tr>`;
  });

  let htmlPlus = contentTable + htmls.join("");
  tableContent.innerHTML = htmlPlus;
}

// delete
function deleteEmployee(formData, callback) {
  let option = {
    method: "POST",
    header: {
      "Content-Type": "application/json",
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Credentials": true,
    },
    body: JSON.stringify(formData),
  };
  fetch(deleteURL, option)
    .then((response) => {
      response;
    })
    .then(callback)
    .catch((error) => console.log(error));
}
function handelDelete(id) {
  var r = confirm("Remove Account here!!");
  if (r == true) {
    let formData = {
      account_id: id,
    };
    deleteEmployee(formData, function () {
      getEmployee(renderEmployee);
    });
  }
}
//resetPassword employee
function resetPassword(formData, callback) {
  let option = {
    method: "PUT",
    header: {
      "Content-Type": "application/json",
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Credentials": true,
    },
    body: JSON.stringify(formData),
  };
  fetch(resetURL, option)
    .then((response) => {
      response;
    })
    .then(callback);
}
function handelReset(id) {
  let flag = true;
  let password = document.querySelector("input[name='password']").value;
  if (password == "" || password.length < 6) {
    flag = false;
    alert("Please check again Password");
  }
  let formData = {
    account_id: id,
    password: password,
  };
  if (flag) {
    if (password) {
      resetPassword(formData, getEmployee(renderEmployee));
      location.reload();
    }
  }
}

//modal
function handleModal(id, name) {
  const modalElement = document.querySelector(".js-modal");
  const modalContainerElement = document.querySelector(".js-modal-container");
  const modalCloseElement = document.querySelector(".js-modal-close");
  const inputUser = document.querySelector(".js-username");
  const snipElement = document.querySelector(".btn-wraper");
  modalElement.classList.add("open");

  //remove modal bằng nút X
  modalCloseElement.addEventListener("click", function () {
    modalElement.classList.remove("open");
  });
  //bấm ra ngoài remove modal
  modalElement.addEventListener("click", function () {
    modalElement.classList.remove("open");
  });
  //ngăn nổi bọt vào modalcontainer
  modalContainerElement.addEventListener("click", function (e) {
    e.stopPropagation();
  });

  inputUser.value = name;
  const html = `<button class="snip" onclick="handelReset(${id})">
  <p  class="submit-btn">Reset</p>
  </button>
  `;
  snipElement.innerHTML = html;
}
