const calculateBtn = document.getElementById('calcTotalBtn');
const subTotalDisplay = document.getElementById('subtotal');
const subTotalWDDisplay = document.getElementById('subtotalWD');
const totalDisplay = document.getElementById('total');
const totalArtDisplay = document.getElementById('totalArt');


calculateBtn.addEventListener('click', function(){
    let subtotal = 0;
    let disc = 0;
    let totalArt = 0;
    
    const subtotalSpans = document.querySelectorAll('span[name="price[]"]');
    const subtotalWDSpans = document.querySelectorAll('span[name="discount[]"]');
    const totalArtInputs = document.querySelectorAll('input[name="quantity[]"]');

    for (let i = 0; i < totalArtInputs.length; i++) {
        let currentQuantity = parseInt(totalArtInputs[i].value) || 0;
        let priceTxt = subtotalSpans[i].textContent.substring(1);
        let currentPrice = parseFloat(priceTxt) || 0;
        let discTxt = subtotalWDSpans[i].textContent.substring(1);
        let currentDisc = parseFloat(discTxt) || 0;

        totalArt += currentQuantity;
        subtotal += currentQuantity * currentPrice;
        subtotal = parseFloat(subtotal.toFixed(2));
        disc += (currentPrice - currentPrice * currentDisc) * currentQuantity;
        disc = parseFloat(disc.toFixed(2));
    }

    console.log(totalArt);
    subTotalDisplay.textContent = subtotal;
    subTotalWDDisplay.textContent = disc;
    totalDisplay.textContent = disc;
    totalArtDisplay.textContent = totalArt;
});