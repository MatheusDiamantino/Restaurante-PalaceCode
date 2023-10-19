const productContainers = [...document.querySelectorAll('.product-container')];
const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
const preBtn = [...document.querySelectorAll('.pre-btn')];

productContainers.forEach((item, i) => {
    let containerDimensions = item.getBoundingClientRect();
    let containerWidth = containerDimensions.width;

    nxtBtn[i].addEventListener('click', () => {
        item.scrollLeft += containerWidth;
    })

    preBtn[i].addEventListener('click', () => {
        item.scrollLeft -= containerWidth;
    })
})

function mesas(){
var mesas = ['mesa1', 'mesa2', 'mesa3', 'mesa4', 'mesa4' , 'mesa5', 'mesa6', 'mesa7', 'mesa8', 'mesa9']

array.forEach(mesas => {
    
});

}

function abrirc(){
    document.getElementById('cadastrom').style.display = "block";
}
function fecharc(){
    document.getElementById('cadastrom').style.display = "none";
}

function excluirm(){
    document.getElementById('excluirm').style.display = "block";
}
function fecharcm(){
    document.getElementById('excluirm').style.display = "none";
}