const divProduct = document.getElementById('products');
const addBtn = document.getElementById('addProductBtn');

function getIdProduct() {
    let numero = prompt("Ingresar el id del producto:");
    if (numero !== null && !isNaN(numero)) {
        return numero;
    } else {
        alert("Entrada inválida");
        return -1;
    }
}

function addProduct(data){
    const htmlContent = `
        <div class="product-card">
            <div class="product-info">
                <input type="hidden" name="id[]" value="${data.id}">
                <h3>Nombre: ${data.name}</h3>
                <p>Precio: <span name="price[]">${data.price}</span></p>
                <p>Descuento: <span name="discount[]">${data.discount}</span></p>
                <p>Existencias <span>${data.existences}</span></p>
                <label for="quantity">Cantidad: </label>
                <input type="number" name="quantity[]">
            </div>
        </div>
    `;
    divProduct.innerHTML += htmlContent;
}

addBtn.addEventListener('click', function() {
    try {
        var idProduct = getIdProduct();
        idProduct = parseInt(idProduct, 10)
        if(idProduct>=0){
            var url = '../../controllator/ajax/GetOnSaleProd.php?id=' + idProduct;
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
                    addProduct(data);
                })
                .catch(error => {
                    //console.log(error);
                });
        }
    } catch (error) {}
});