const textarea = document.querySelector("#conteudo");
const divListPubli = document.getElementById('list-posts');


divListPubli.addEventListener('click', () => {
    //console.log(getComputedStyle(divListPubli).left);

    if (getComputedStyle(divListPubli).left != '0px') {
        divListPubli.style.left = '0px';
    } else if (getComputedStyle(divListPubli).left === '0px') {
        divListPubli.style.left = '-390px';
    }
});


document.getElementById("list-uploads").addEventListener("change", function() {
    var selectedOption = this.options[this.selectedIndex];
    var selectedValue = selectedOption.value;
    var extensaoArquivo = selectedValue.substring(selectedValue.length - 3)
    var raiz = 'http://localhost/webinfo/blog'

    console.log(extensaoArquivo)

    switch (extensaoArquivo) {
        case 'pdf': textarea.value += `<a type="application/pdf" href="${raiz}/uploads/${selectedValue}">Veja o pdf aqui</a>`; break;

        case 'jpg' || 'png': textarea.value += `<img src="${raiz}/uploads/${selectedValue}">`; break;

        case 'mp4': textarea.value += `<video src="${raiz}/uploads/${selectedValue}" width="500" controls></video>`; break;
        
        case 'mp3': textarea.value += ` <audio src="${raiz}/uploads/${selectedValue}" controls></audio>`; break;

    }
});