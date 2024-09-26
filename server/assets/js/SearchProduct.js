const div= document.getElementById('productsTbody');

function addProduct(data){
    if(data.length === 0){
        alert('No se encontraron productos');
    } else{
        data.forEach(product => {
            const htmlContent = `
            <tr>
                <td>${product.id}</td>
                <td>${product.name}</td>
                <td>${product.price}</td>
                <td>${product.existences}</td>
                <td>${product.idSucursal}</td>
            </tr>
            `;
            div.innerHTML += htmlContent;
        });
    }
}

function handleFormSubmit(event) {
    event.preventDefault();

    const name = document.getElementById('name').value;

    var url = `../../controllator/ajax/GetProduct.php?name=${name}`;
    fetch(url)
        .then(response => {
            if (!response.ok) {
                return response.json().then(errorData => {
                    alert(errorData.error)
                    throw new Error(errorData.error);
                });
            }
            return response.json();
        })
        .then(data => {
            div.innerHTML = '';
            addProduct(data);
            console.log(data);
        })
        .catch(error => {
            console.log(error);
        });
}

// Agrega el evento submit al formulario
document.getElementById('videogameForm').addEventListener('submit', handleFormSubmit);