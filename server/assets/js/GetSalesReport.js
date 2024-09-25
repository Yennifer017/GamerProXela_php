const divSales = document.getElementById('topSalesTB');

function addSale(salesData){
    let index = 1;
    salesData.forEach(sale => {
        const htmlContent = `
        <tr>
            <td>${index}</td>
            <td>${sale.numberFactura}</td>
            <td>${sale.clientCompletName}</td>
            <td>${sale.cajeroUsername}</td>
            <td>${sale.total}</td>
            <td>${sale.dataExtended}</td>
        </tr>
        `;
        index++;
        divSales.innerHTML += htmlContent;
    });
}

function handleFormSubmit(event) {
    event.preventDefault();

    const initDate = document.getElementById('initSaleRep').value;
    const endDate = document.getElementById('endSaleRep').value;

    var url = `../../controllator/ajax/GetSalesReport.php?init=${initDate}&end=${endDate}`;
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
            divSales.innerHTML = '';
            addSale(data);
        })
        .catch(error => {
            console.log(error);
        });
}

// Agrega el evento submit al formulario
document.getElementById('salesForm').addEventListener('submit', handleFormSubmit);