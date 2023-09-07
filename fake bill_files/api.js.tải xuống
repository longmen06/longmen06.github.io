const defaultApiKey = 'demo-f5e14830-cab4-4d3a-93c7-926f937d5376a'
const defaultClientId = 'demo-dd58bc3f-7544-4d22-b8d6-ed77b03242baa'
loadXMLDoc()

function loadXMLDoc() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == XMLHttpRequest.DONE) { // XMLHttpRequest.DONE == 4
            if (xmlhttp.status == 200) {
                console.log(JSON.parse(xmlhttp.responseText))
                let data = JSON.parse(xmlhttp.responseText)
                document.getElementById("banks").innerHTML = data.data.map(item => {
                    return `<option value=${item.bin} data-thumbnail=${item.logo}>(${item.bin}) ${item.short_name}</option>`
                }).join('')
            } else if (xmlhttp.status == 400) {
                alert('There was an error 400');
            } else {
                alert('something else other than 200 was returned');
            }
        }
    };

    xmlhttp.open("GET", "https://api.vietqr.io/v2/banks", true);
    xmlhttp.send();
}

function findAccountName(accountNumber, bankId) {
    document.getElementById("container-loading").style.display = "flex"
    var xmlhttp = new XMLHttpRequest();
    let params = {
        accountNumber: accountNumber,
        bin: bankId
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == XMLHttpRequest.DONE) { // XMLHttpRequest.DONE == 4
            if (xmlhttp.status == 200) {
                console.log(JSON.parse(xmlhttp.responseText))
                let data = JSON.parse(xmlhttp.responseText)
                if (data.code == "00") {
                    document.getElementById("container-loading").style.display = "none";
                    document.getElementById("error").style.display = "none";
                    document.getElementById("accountName").value = data.data.accountName;
                } else {
                    document.getElementById("container-loading").style.display = "none";
                    document.getElementById("error").innerText = `${data.code} - ${data.desc}`;
                    document.getElementById("error").style.display = "block";
                    document.getElementById("accountName").value = '';
                }
            } else if (xmlhttp.status == 400) {
                alert('There was an error 400');
            } else {
                alert('something else other than 200 was returned');
            }
        }
    };

    xmlhttp.open("POST", "https://api.vietqr.io/v2/lookup", true);
    xmlhttp.setRequestHeader("Content-Type", "application/json");

    let identifyData = getCurrentLocalData()
    console.log(identifyData);
    xmlhttp.setRequestHeader("x-api-key", identifyData.apiKey);
    xmlhttp.setRequestHeader("x-client-id", identifyData.clientId);
    xmlhttp.send(JSON.stringify(params));
}


function init() {
    checkExistKey()
    let inputBankId = document.getElementById('banks');

    let inputAccountNumber = document.getElementById('accountNumber');
    inputAccountNumber.addEventListener('focusout', async function (e) {
        let value = e.target.value
        if (value.length > 0) {
            console.log(value, inputBankId.value);
            // await setTimeout(() => {
            //     document.getElementById("container-loading").style.display = "block"
            // }, 1500)

            findAccountName(value, inputBankId.value)
        }
    })
    document.getElementById('btn-api-key').addEventListener('click', () => {
        let apiKey = prompt('Nháº­p API-Key')
        if (apiKey) {
            saveData(apiKey)
            checkExistKey()
        }
    })
    document.getElementById('btn-client-id').addEventListener('click', () => {
        let clientId = prompt('Nháº­p Client-Id')
        if (clientId) {
            saveData(null, clientId)
            checkExistKey()
        }
    })
}
function saveData(apiKey = null, clientId = null) {
    let oldAPIKey = ''
    let oldClientId = ''
    let currentData = ''
    try {
        currentData = JSON.parse(localStorage.getItem('key-data'))
        handleData(currentData, oldAPIKey, oldClientId)
    } catch (error) {
        handleData(null, oldAPIKey, oldClientId)
    }
    function handleData(currentData = null, oldAPIKey, oldClientId) {
        console.log({ currentData, apiKey, clientId });
        if (currentData) {
            oldAPIKey = currentData.apiKey
            oldClientId = currentData.clientId
        }
        localStorage.setItem('key-data', JSON.stringify({
            apiKey: apiKey || oldAPIKey,
            clientId: clientId || oldClientId
        }))
    }
}
function getCurrentLocalData() {
    let currentData = ''
    try {
        currentData = JSON.parse(localStorage.getItem('key-data'))
        console.log(currentData);
        return handleData(currentData)
    } catch (error) {
        return handleData()
    }
    function handleData(data = null) {
        console.log(data);
        if (data) {
            return {
                apiKey: data.apiKey || defaultApiKey,
                clientId: data.clientId || defaultClientId
            }
        }
        return {
            apiKey: defaultApiKey,
            clientId: defaultClientId
        }
    }
}
function checkExistKey() {
    let data = getCurrentLocalData()
    if (data.apiKey == defaultApiKey && data.clientId == defaultClientId) {
        document.getElementById("exist-key").innerText = ''
    }
    else {
        if (data.apiKey != defaultApiKey && data.clientId == defaultClientId) {
            document.getElementById("exist-key").innerText = `Truy váº¥n sá»­ dá»¥ng API-key ${cutData(data.apiKey)}`
        } else if (data.apiKey == defaultApiKey && data.clientId != defaultClientId) {
            document.getElementById("exist-key").innerText = `Truy váº¥n sá»­ dá»¥ng Client-Id ${cutData(data.clientId)}`
        } else {
            document.getElementById("exist-key").innerText = `Truy váº¥n sá»­ dá»¥ng API-key ${cutData(data.apiKey)} vĂ  Client-Id ${cutData(data.clientId)}`
        }
    }
}
function cutData(data) {
    if (data.length < 5) {
        return data
    } else {
        let lastData = data.slice(data.length - 5, data.length)
        return `***${lastData}`
    }

}