let searchQuery = "";

class User {
  id;
  name;
  status;

  constructor(id, name, status) {
    this.id = id;
    this.name = name;
    this.status = Number.parseInt(status);
  }

  createListElement() {
    let row = document.createElement("tr");
    const statusRow = this.status == 1 ? "Activo" : "Inactivo";
    const statusRowClass = this.status == 1 ? "active-user" : "inactive-user";
    const buttonLabel = this.status == 1 ? "Desactivar" : "Activar";
    row.innerHTML = `
            <td class='name-cell'>${this.name}</td>
            <td class="${statusRowClass}">${statusRow}</td>
            <td><button type='button' onclick="changeStatus(${this.id},${this.status})">${buttonLabel}</button></td>
        `;
    return row;
  }
}

window.onload = (e) => {
  getUsers();
};

async function getUsers() {
  try {
    let response = await fetch("./Controllers/UserController.php", {
      // action: 'listar',
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ search: searchQuery }),
    });

    const json = [...(await response.json())];
    const users = json.map((e) => new User(e.ID, e.NombreCompleto, e.Estado));
    listUsers(users);
  } catch (error) {
    console.error(error);
  }
}

function listUsers(users) {
  const tableBody = document.getElementById("table");
  tableBody.innerHTML = "";
  users.forEach((user) => {
    tableBody.appendChild(user.createListElement());
  });
}

async function changeStatus(userId, oldStatus) {
  try {
    const newStatus = oldStatus == "1" ? "0" : "1";
    let response = await fetch("./Controllers/UserController.php", {
      // action: 'listar',
      method: "PUT",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id: userId, estado: newStatus }),
    });

    getUsers();
    // location.reload();
  } catch (error) {
    console.error(error);
  }
}

function searchUsers(e) {
    e.preventDefault();
  const input = document.getElementById("buscar-usuario");
  searchQuery = input.value;
  this.getUsers();
}
