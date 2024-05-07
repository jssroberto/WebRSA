

document.querySelector("#encrypt").addEventListener("click", async function () {
    const public_key = document.querySelector("#pubkey").value;
    const encrypt = new JSEncrypt();
    encrypt.setPublicKey(public_key);
    const result = encrypt.encrypt(document.querySelector("#input").value);
    document.querySelector("#encrypted").value = result;
});

document.querySelector("#decrypt").addEventListener("click", async function () {
    const private_key = document.querySelector("#privkey").value;

    const decrypt = new JSEncrypt();
    decrypt.setPrivateKey(private_key);
    const text = decrypt.decrypt(document.querySelector("#encrypted").value);
    document.querySelector("#decrypted").value = text;
});


function generarClaves() {
    var encrypt = new JSEncrypt();

    encrypt.getKey();

    var publicKey = encrypt.getPublicKey();
    var privateKey = encrypt.getPrivateKey();

    document.getElementById('privkey').textContent = privateKey;
    document.getElementById('pubkey').textContent = publicKey;
}

generarClaves();