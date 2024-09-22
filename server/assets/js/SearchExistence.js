
const button = document.getElementById('searchBtn');

const nameDisplay = document.getElementById('name');
const hallDisplay = document.getElementById('hall');
const existencesDisplay = document.getElementById('currentExistences');
const currentIdInput = document.getElementById('currentExistences');
function updateDisplay(){

}

button.addEventListener('click', function() {
    var idProduct = document.getElementById('id').value;
    try {
        idProduct = parseInt(idProduct, 10)
    } catch (error) {
    }
    if(Number.isInteger(idProduct) && idProduct >= 0){
        var url = '../../controllator/ajax/GetExistence.php?id=' + idProduct;
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    alert('No se encontro el producto');
                }
                return response.json(); 
            })
            .then(data => {
                updateDisplay();
                alert('Respuesta exitosa:', data);
            })
            .catch(error => {
                alert(error);
            });

    } else {
        alert('El id debe ser un numero entero positivo');
    }
});