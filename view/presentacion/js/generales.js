window.onload = function () {
    var contenedor = document.getElementById('contenedor_carga');
    contenedor.style.visibility = 'hidden';
    contenedor.style.opacity = '0';
};

function aMayusculas(obj, id) {
    obj = obj.toUpperCase();
    document.getElementById(id).value = obj;
}

function validaNumericos(event) {
    if (event.charCode >= 48 && event.charCode <= 57) {
        return true;
    }
    return false;
}

if (!$('#vista_login').is(':visible')) {
    document.body.style.background='white';
}
