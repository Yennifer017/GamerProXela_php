
const button = document.getElementById('searchBtn');

const nameDisplay = document.getElementById('name');
const hallDisplay = document.getElementById('hall');
const currentIdInput = document.getElementById('currentExistences');
const codeDisplay = document.getElementById('code');

button.addEventListener('click', function() {
    var idProduct = document.getElementById('id').value;
    try {
        idProduct = parseInt(idProduct, 10)
    } catch (error) {
    }
    if(Number.isInteger(idProduct) && idProduct >= 0){
        var url = '../../controllator/ajax/GetHallStockProduct.php?id=' + idProduct;
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
                //update display
                codeDisplay.textContent = idProduct;
                nameDisplay.textContent = data.name;
                hallDisplay.textContent = data.hall;
            })
            .catch(error => {
                //console.log(error);
            });

    } else {
        alert('El id debe ser un numero entero positivo');
    }
});