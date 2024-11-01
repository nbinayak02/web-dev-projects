const amount = document.querySelector("#ip-curr");
const dropdown = document.querySelectorAll("select");
const msg = document.querySelector(".msg");
const button = document.querySelector("button");
const fromCurrency = document.querySelector(".from select");
const toCurrency = document.querySelector(".to select");
const swapBtn = document.querySelector(".convert-icon img");

const exchangeURL =
  "https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/";

//show all currencies in dropdown
for (let select of dropdown) {
  //access all select

  for (let currency in countryList) {
    let code = countryList[currency];
    //create new <option> element
    let newOption = document.createElement("option");
    newOption.textContent = currency + "-" + code.CRY;
    newOption.value = currency;

    if (select.name === "from" && currency === "USD") {
      newOption.selected = "selected";
    }

    if (select.name === "to" && currency === "NPR") {
      newOption.selected = "selected";
    }

    select.appendChild(newOption);
  }

  //update flag
  select.addEventListener("change", (event) => {
    updateFlag(event.target);
  });
}

function updateFlag(target) {
  //target receives which select has been clicked
  let countrycode = countryList[target.value];
  console.log(countrycode);
  //selecting the image of parent element of target select tag
  const img = target.parentElement.querySelector("img");
  let flagURL = `https://flagsapi.com/${countrycode.CNTRY}/flat/64.png`;
  img.src = flagURL;
}

button.addEventListener("click", async (event) => {
  event.preventDefault();

  let amt = amount.value;
  if (amount.value === "" || amt < 1) {
    amt = 1;
  }

  let from = fromCurrency.value.toLowerCase();
  var to = toCurrency.value.toLowerCase();
  let exurl = `${exchangeURL}${from}.json`;
  const response = await fetch(exurl);
  const data = await response.json();
  let total = data[from][to] * amt;
  msg.innerHTML = `${amt} ${from} = ${total.toFixed(2)} ${to}`;
});