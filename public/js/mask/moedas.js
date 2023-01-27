function formatarMoeda(el) {
    if (validandoMoeda(el.value)) {
        el.value = parseInt((el.value).replace(/[^0-9]/g, ''));
        el.value = contandoCasasDecimais('R$ ' + (parseInt(el.value) / 100).toString().replace(".", ","));
    } else {
        el.value = '';
    }
}

function validandoMoeda(el) {
    if (parseInt((el).replace(/[^0-9]/g, '')) || el.substr(-1, 1) == '0') {
        return true;
    }
}

function contandoCasasDecimais(el) {
    if (!el.includes(',')) {
        return el + ',00';
    }

    if (el.toString().split(',')[1].length == 1) {
        return el + '0';
    }
    return el;
}