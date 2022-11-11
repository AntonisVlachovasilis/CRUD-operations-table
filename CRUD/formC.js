fetch("http://localhost/MyConstructor/formC.php")
  .then((res) => res.json())
  .then((response) => {
    let out = "";

    response.forEach((element) => {
      out += `<tr>
      <td> ${element.id} </td>
       <td> ${element.firstname} </td>
        <td> ${element.lastname} </td>
         <td> ${element.telephone} </td>
          <td> ${element.email} </td>
           <td> ${element.category} </td>
           <td>
           <button class="btn btn-primary"><a href="update.php?updateid=${element.id}" class="text-light"> Ενημέρωση</a></button>
           <button class="btn btn-danger"><a href="delete.php?deleteid=${element.id}" class="text-light">Διαγραφή</a></button>
           </td>
      </tr>`;
    });
    document.querySelector(".tbody").innerHTML = out;
  })
  .catch((err) => console.log(err));
